<?php

namespace App\Notification\Domain\Entity;

class Sms
{
    public function __construct(
        private readonly string $phone,
        private readonly string $text,
    )
    {

    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getText(): string
    {
        return $this->text;
    }
}