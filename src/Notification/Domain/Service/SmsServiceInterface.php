<?php

namespace App\Notification\Domain\Service;

use App\Notification\Domain\Entity\Sms;

interface SmsServiceInterface
{
    public function send(Sms $sms): bool;
}