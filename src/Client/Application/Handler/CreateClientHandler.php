<?php

namespace App\Client\Application\Handler;

use App\Client\Application\Command\CreateClientCommand;
use App\Client\Domain\Entity\Client;
use App\Client\Infrastructure\Repository\ClientRepository;

readonly class CreateClientHandler
{
    public function __construct(
        private ClientRepository $clientRepository
    )
    {
    }

    public function handle(CreateClientCommand $command): Client
    {
        $client = new Client();
        $client->setFirstName($command->firstName)
            ->setLastName($command->lastName)
            ->setAge($command->age)
            ->setSsn($command->ssn)
            ->setAddress($command->address)
            ->setEmail($command->email)
            ->setPhone($command->phone)
            ->setIncome($command->income)
            ->setState($command->state)
            ->setFico($command->fico);

        $this->clientRepository->save($client);

        return $client;
    }
}
