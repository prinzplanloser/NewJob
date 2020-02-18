<?php

namespace App\Models\Tasks;

use App\Exceptions\InvalidArgumentException;
use App\Models\User\User;
use App\Models\ActiveRecordEntity;
use App\Services\Db;

class Task extends ActiveRecordEntity
{
    /** @var string */
    protected $name;
    /** @var string */
    protected $email;
    /** @var string */
    protected $text;


    protected static function getTableName(): string
    {
        return 'tasks';
    }

    public function getName()
    {
        return $this->name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getText()
    {
        return $this->text;
    }

    public static function getUserId(int $id): self
    {
        $db = Db::getInstance();
        $entities = $db->query(
            'SELECT * FROM `' . static::getTableName() . '` WHERE users_id=:id;',
            [':id' => $id],
            static::class
        );
        return $entities ? $entities[0] : null;
    }

    public static function create(array $taskData): Task
    {
        if (empty($taskData['name'])) {
            throw new InvalidArgumentException('Не передано имя');
        }
        if (empty($taskData['text'])) {
            throw new InvalidArgumentException('Не передано имя');
        }

        if (!preg_match('/[a-zA-Z0-9]+/', $taskData['name'])) {
            throw new \App\Exceptions\InvalidArgumentException('Имя может состоять только из символов латинского алфавита и цифр');
        }

        if (empty($taskData['email'])) {
            throw new InvalidArgumentException('Не передан email');
        }

        if (!filter_var($taskData['email'], FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('Email некорректен');
        }


        $task = new Task();
        $task->name = $taskData['name'];
        $task->email = $taskData['email'];
        $task->text = $taskData['text'];
        $task->save();

        return $task;
    }
}