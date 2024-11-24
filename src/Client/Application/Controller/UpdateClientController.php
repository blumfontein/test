<?php

namespace App\Client\Application\Controller;

use App\Client\Application\Command\UpdateClientCommand;
use App\Client\Application\Handler\UpdateClientHandler;
use App\Client\Domain\Entity\Client;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

class UpdateClientController
{
    private UpdateClientHandler $updateHandler;

    public function __construct(UpdateClientHandler $updateHandler)
    {
        $this->updateHandler = $updateHandler;
    }

    #[Route('/client/{id}', name: 'client.update', methods: 'PATCH')]
    public function update(
        #[MapRequestPayload] UpdateClientCommand $command,
        #[MapEntity] Client $client
    ): Response
    {
        $command->client = $client;

        $this->updateHandler->handle($command);

        return new JsonResponse(['status' => 'Client updated'], Response::HTTP_OK);
    }
}
