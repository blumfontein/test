<?php

namespace App\Credit\Application\Controller;

use App\Client\Domain\Entity\Client;
use App\Credit\Application\Handler\ScoreCreditHandler;
use App\Credit\Application\Query\ScoreCreditQuery;
use App\Credit\Domain\Entity\Credit;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ScoreCreditController
{
    private ScoreCreditHandler $handler;

    public function __construct(ScoreCreditHandler $handler)
    {
        $this->handler = $handler;
    }

    #[Route('/credits/{credit_id}/scoring/{client_id}', name: 'credit.scoring', methods: 'POST')]
    public function create(
        #[MapEntity(id: 'client_id')] Client $client,
        #[MapEntity(id: 'credit_id')] Credit $credit,
    ): Response
    {
        $query = new ScoreCreditQuery(
            $client,
            $credit,
        );

        $scoring = $this->handler->handle($query);

        return new JsonResponse(['is_allowed' => $scoring->isAllowed], Response::HTTP_OK);
    }
}
