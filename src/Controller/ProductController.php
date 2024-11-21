<?php

namespace App\Controller;

use App\Simple\RequestData\ProductRequestData;
use JsonException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

final class ProductController extends AbstractGatewayController
{
    /**
     * @throws JsonException
     */
    #[Route('productservice/{productId?}', name: 'product_service', methods: ['GET', 'POST', 'PATCH', 'DELETE'])]
    public function index(Request $request, ?string $productId = null): JsonResponse
    {
        $rawData = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);

        $requestData = (new ProductRequestData())
            ->setId($productId)
            ->setMethod($request->getMethod())
            ->setAuthorizationToken($request->headers->get('Authorization'))
            ->setName($rawData['name'] ?? null)
            ->setDescription($rawData['description'] ?? null)
            ->setPrice($rawData['price'] ?? null)
            ->setAvailable($rawData['available'] ?? null)
        ;

        return $this->manageRequest($requestData, $this->serviceFetcherFacade->getProductServiceFetcher());
    }
}
