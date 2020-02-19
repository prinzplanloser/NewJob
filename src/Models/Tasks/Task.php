<?php

namespace App\Models\Tasks;

use App\Exceptions\InvalidArgumentException;

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
    /** @var string */
    protected $status;
    /** @var string */
    protected $adminStatus;

    public function __toString()
    {
        return 'tasks';
    }

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

    public function getStatus()
    {
        return $this->status;
    }

    public function getText()
    {
        return $this->text;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getAdminStatus()
    {
        return $this->adminStatus;
    }

    public function setAdminStatus(string $adminStatus)
    {
        $this->adminStatus = $adminStatus;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function setText(string $text)
    {
        $this->text = $text;
    }

    public function setStatus(string $status)
    {
        $this->status = $status;
    }


    public static function create(array $taskData): Task
    {
        if (empty($taskData['name'])) {
            throw new InvalidArgumentException('Не передано имя');
        }
        if (empty($taskData['text'])) {
            throw new InvalidArgumentException('Не передан текст задачи');
        }

        if (empty($taskData['email'])) {
            throw new InvalidArgumentException('Не передан email');
        }

        if (!preg_match('/^[a-zA-Zа-яёА-ЯЁ0-9]+$/u', $taskData['name'])) {
            throw new \App\Exceptions\InvalidArgumentException('Имя может состоять только из букв и цифр');
        }


        if (!filter_var($taskData['email'], FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('Email некорректен');
        }


        $task = new Task();
        $task->name = $taskData['name'];
        $task->email = $taskData['email'];
        $task->text = $taskData['text'];
        $task->status = 'Не выполнена';
        $task->save();


        return $task;
    }


    public function updateFromArray(array $fields): Task
    {

        if (empty($fields['name'])) {
            throw new InvalidArgumentException('Не передано название статьи');
        }
        if (empty($fields['email'])) {
            throw new InvalidArgumentException('Не передан email');
        }
        if (empty($fields['text'])) {
            throw new InvalidArgumentException('Не передан текст статьи');
        }

        $this->setName($fields['name']);
        $this->setEmail($fields['email']);
        $this->setText($fields['text']);
        $this->setStatus($fields['status']);
        if ($fields['adminStatus']) {
            $this->setAdminStatus($fields['adminStatus']);
        }


        $this->save();

        return $this;
    }
}