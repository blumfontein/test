<?php

namespace App\Credit\Application\Handler;

use App\Credit\Application\Command\IssueCreditCommand;
use App\Credit\Application\Message\Notification;
use App\Credit\Application\Query\ScoreCreditQuery;
use App\Credit\Domain\Entity\Issuance;
use App\Credit\Infrastructure\Repository\IssuanceRepository;
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

            $this->bus->dispatch(new Notification(
                $command->client,
                'Credit issued'
            ));
        }

        return $issuance;
    }
}
