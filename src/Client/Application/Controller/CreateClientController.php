<?php

namespace App\Client\Application\Controller;

use App\Client\Application\Command\CreateClientCommand;
use App\Client\Application\Handler\CreateClientHandler;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

class CreateClientController
{
    private CreateClientHandler $handler;

    public function __construct(CreateClientHandler $handler)
    {
        $this->handler = $handler;
    }

    #[Route('/client', name: 'client.create', methods: 'POST')]
    public function create(#[MapRequestPayload] CreateClientCommand $command): Response
    {
        $client = $this->handler->handle($command);

        return new JsonResponse([
            'id' => $client->getId(),
        ], Response::HTTP_CREATED);
    }
}
