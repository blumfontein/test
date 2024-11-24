<?php

namespace App\Credit\Application\MessageHandler;

use App\Credit\Application\Message\Notification;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class NotificationHandler
{
    public function __invoke(Notification $message)
    {
        if ($message->getClient()->getPhone()) {
            // call to SMS API
        }
    }
}