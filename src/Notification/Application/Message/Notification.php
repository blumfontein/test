<?php

namespace App\Notification\Application\Message;

use App\Notification\Domain\Entity\Sms;

readonly class Notification
{
    public function __construct(
        private Sms $sms,
    ) {
    }

    public function getSms(): Sms
    {
        return $this->sms;
    }
}