<?php

namespace App\Notification\Application\Handler;

use App\Notification\Domain\Entity\SendNotificationCommand;
use App\Notification\Domain\Service\SmsServiceInterface;

readonly class SendNotificationHandler
{
    public function __construct(
        private SmsServiceInterface $smsService,
    )
    {
    }

    public function handle(SendNotificationCommand $command): void
    {
        if ($command->sms) {
            $this->smsService->send($command->sms);
        }
    }
}
