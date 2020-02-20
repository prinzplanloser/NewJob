<?php

namespace App\Models\Tasks;

use App\Exceptions\InvalidArgumentException;
use App\Models\ActiveRecordEntity;

class Tasks extends ActiveRecordEntity
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

    public function __toString():string
    {
        return 'tasks';
    }

    protected static function getTableName(): string
    {
        return 'tasks';
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getAdminStatus(): ?string
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


    public static function create(array $taskData): Tasks
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


        $task = new Tasks();
        $task->name = $taskData['name'];
        $task->email = $taskData['email'];
        $task->text = $taskData['text'];
        $task->status = 'Не выполнена';
        $task->save();


        return $task;
    }


    public function updateFromArray(array $fields): Tasks
    {

        if (empty($fields['name'])) {
            throw new InvalidArgumentException('Не передано имя');
        }
        if (empty($fields['text'])) {
            throw new InvalidArgumentException('Не передан текст задачи');
        }

        if (empty($fields['email'])) {
            throw new InvalidArgumentException('Не передан email');
        }

        if (!preg_match('/^[a-zA-Zа-яёА-ЯЁ0-9]+$/u', $fields['name'])) {
            throw new \App\Exceptions\InvalidArgumentException('Имя может состоять только из букв и цифр');
        }


        if (!filter_var($fields['email'], FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('Email некорректен');
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

    public function checkTextDiff(string $inputText): array
    {
        if ($this->getText() !== $inputText) {
            $_POST['adminStatus'] = 'Отредактировано администратором';
        }

        return $_POST;
    }
}