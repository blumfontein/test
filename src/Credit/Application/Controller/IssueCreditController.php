<?php

namespace App\Credit\Application\Controller;

use App\Client\Domain\Entity\Client;
use App\Credit\Application\Command\IssueCreditCommand;
use App\Credit\Application\Handler\IssueCreditHandler;
use App\Credit\Domain\Entity\Credit;
use App\Credit\Domain\Entity\Issuance;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class IssueCreditController
{
    private IssueCreditHandler $handler;

    public function __construct(IssueCreditHandler $handler)
    {
        $this->handler = $handler;
    }

    #[Route('/credits/{credit_id}/issuance/{client_id}', name: 'credit.issue', methods: 'POST')]
    public function create(
        #[MapEntity(id: 'client_id')] Client $client,
        #[MapEntity(id: 'credit_id')] Credit $credit,
    ): Response
    {
        $command = new IssueCreditCommand(
            $client,
            $credit,
        );

        $issuance = $this->handler->handle($command);

        $responseStatus = $issuance instanceof Issuance ? Response::HTTP_CREATED : Response::HTTP_OK;

        return new JsonResponse([
            'is_issued' => $issuance instanceof Issuance,
            'interest' => $issuance?->getInterest()
        ], $responseStatus);
    }
}
