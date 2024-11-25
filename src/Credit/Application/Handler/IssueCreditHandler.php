<?php

namespace App\Credit\Application\Handler;

use App\Credit\Application\Command\IssueCreditCommand;
use App\Credit\Application\Query\ScoreCreditQuery;
use App\Credit\Domain\Entity\Issuance;
use App\Credit\Infrastructure\Repository\IssuanceRepository;
use App\Notification\Application\Message\Notification;
use App\Notification\Domain\Entity\Sms;
use Symfony\Component\Messenger\MessageBusInterface;

readonly class IssueCreditHandler
{
    public function __construct(
        private IssuanceRepository $issuanceRepository,
        private ScoreCreditHandler $scoreCreditHandler,
        private MessageBusInterface $bus,
    )
    {
    }

    public function handle(IssueCreditCommand $command): ?Issuance
    {
        $query = new ScoreCreditQuery($command->client, $command->credit);

        $scoring = $this->scoreCreditHandler->handle($query);

        $issuance = null;

        if ($scoring->isAllowed) {
            $issuance = $this->issuanceRepository->createFromScoring($scoring);
            $client = $command->client;

            $sms = new Sms($client->getPhone(), 'Credit issued');

            $this->bus->dispatch(new Notification($sms));
        }

        return $issuance;
    }
}
