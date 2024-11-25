<?php

namespace App\Notification\Application\MessageHandler;

use App\Notification\Application\Handler\SendNotificationHandler;
use App\Notification\Application\Message\Notification;
use App\Notification\Domain\Entity\SendNotificationCommand;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
readonly class NotificationHandler
{
    public function __construct(
        private SendNotificationHandler $sendNotificationHandler
    )
    {

    }

    public function __invoke(Notification $message)
    {
        $command = new SendNotificationCommand($message->getSms());

        $this->sendNotificationHandler->handle($command);
    }
}