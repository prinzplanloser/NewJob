<?php

namespace App\Services\Db;

use App\Exceptions\DbException;
use PDO;

class Db
{
    /** @var \PDO */
    private $pdo;
    private static $instance;

    private function __construct()
    {
        try {
            $this->pdo = new \PDO(
                'mysql:host=' . getenv('HOST') . ';dbname=' . getenv('DBNAME'),
                getenv('USER'),
                getenv('PASSWORD')
            );
            $this->pdo->exec('SET NAMES UTF8');
        } catch (\PDOException $e) {
            throw new DbException('Ошибка подключения к базе данных:' . $e->getMessage());
        }
    }

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;

    }

    public function getLastInsertId(): int
    {
        return (int)$this->pdo->lastInsertId();
    }

    public function simpleQuery(string $sql, $params = []): ?array
    {
        $sth = $this->pdo->prepare($sql);
        $result = $sth->execute($params);

        if (false === $result) {
            return null;
        }
        return $sth->fetch(PDO::FETCH_BOTH);
    }

    public function query(string $sql, $params = [], string $className = 'stdClass'): ?array
    {
        $sth = $this->pdo->prepare($sql);

        $result = $sth->execute($params);

        if (false === $result) {
            return null;
        }

        return $sth->fetchAll(\PDO::FETCH_CLASS, $className);
    }


    public function limit(string $sql, $params = [],string $className = 'stdClass'): ?array
    {
        $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
        $sth = $this->pdo->prepare($sql);
        $result = $sth->execute($params);
        $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,TRUE);

        if (false === $result) {
            return null;
        }

        return $sth->fetchAll(\PDO::FETCH_CLASS, $className);
    }
}