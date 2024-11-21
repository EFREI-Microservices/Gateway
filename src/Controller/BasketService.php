<?php

namespace App\Controller;

use App\Facade\ServiceFetcherFacade;
use App\Simple\RequestData\BasketRequestData;
use JsonException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

final class BasketService extends AbstractGatewayController
{
    public function __construct(
        private readonly ServiceFetcherFacade $serviceFetcherFacade,
    ) {
    }

    /**
     * @throws JsonException
     */
    #[Route('basketservice/{endpoint}', name: 'basket_service', methods: ['GET', 'POST', 'DELETE'])]
    public function index(Request $request, ?string $endpoint = null): JsonResponse
    {
        $rawData = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);

        $requestData = (new BasketRequestData())
            ->setMethod($request->getMethod())
            ->setEndpoint($endpoint)
            ->setAuthorizationToken($request->headers->get('Authorization'))
            ->setProductId($rawData['productId'] ?? null)
            ->setQuantity($rawData['quantity'] ?? null)
        ;

        return $this->manageRequest($requestData, $this->serviceFetcherFacade->getBasketServiceFetcher());
    }
}
