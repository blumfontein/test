<?php

namespace App\Notification\Infrastructure\Service;

use App\Notification\Domain\Entity\Sms;
use App\Notification\Domain\Service\SmsServiceInterface;

class SmsService implements SmsServiceInterface
{
    public function send(Sms $sms): bool
    {
        // call SMS gateway API

        return true;
    }
}