<?php

namespace App\Notification\Domain\Entity;

class SendNotificationCommand
{
    public function __construct(
        public ?Sms $sms = null,
    ) {
    }
}
