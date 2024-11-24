<?php

namespace App\Client\Application\Handler;

use App\Client\Application\Command\UpdateClientCommand;
use App\Client\Infrastructure\Repository\ClientRepository;

readonly class UpdateClientHandler
{
    public function __construct(
        private ClientRepository $clientRepository
    )
    {
    }

    public function handle(UpdateClientCommand $command): void
    {
        $client = $command->client;

        if ($command->firstName !== null) {
            $client->setFirstName($command->firstName);
        }
        if ($command->lastName !== null) {
            $client->setLastName($command->lastName);
        }
        if ($command->age !== null) {
            $client->setAge($command->age);
        }
        if ($command->ssn !== null) {
            $client->setSsn($command->ssn);
        }
        if ($command->address !== null) {
            $client->setAddress($command->address);
        }
        if ($command->email !== null) {
            $client->setEmail($command->email);
        }
        if ($command->phone !== null) {
            $client->setPhone($command->phone);
        }
        if ($command->fico !== null) {
            $client->setFico($command->fico);
        }
        if ($command->income !== null) {
            $client->setIncome($command->income);
        }
        if ($command->state !== null) {
            $client->setState($command->state);
        }

        // Сохранить изменения
        $this->clientRepository->save($client);
    }
}