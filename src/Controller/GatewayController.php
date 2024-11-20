<?php

namespace App\Controller;

use App\Facade\ServiceFetcherFacade;
use App\Simple\RequestData\BasketRequestData;
use App\Simple\RequestData\ProductRequestData;
use App\Simple\RequestData\UserRequestData;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/gateway/')]
final class GatewayController extends AbstractController
{
    public function __construct(
        private readonly ServiceFetcherFacade $serviceFetcherFacade,
    ) {
    }

    #[Route('userservice/{endpoint}/{userId?}', name: 'user_service', methods: ['GET', 'POST', 'PATCH', 'DELETE'])]
    public function userService(Request $request, string $endpoint, ?string $userId = null): JsonResponse
    {
        try {
            $rawData = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);

            $requestData = (new UserRequestData())
                ->setId($userId)
                ->setMethod($request->getMethod())
                ->setEndpoint($endpoint)
                ->setAuthorizationToken($request->headers->get('Authorization'))
                ->setUsername($rawData['username'] ?? null)
                ->setPassword($rawData['password'] ?? null)
                ->setRole($rawData['role'] ?? null)
            ;

            $responseData = $this->serviceFetcherFacade->getUserServiceFetcher()->routeRequest($requestData);

        } catch (Exception $exception) {
            return new JsonResponse([
                'error' => $exception->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }

        return new JsonResponse(
            $responseData->getResponseBody(),
            $responseData->getResponseCode()
        );
    }

    #[Route('productservice/{productId?}', name: 'product_service', methods: ['GET', 'POST', 'PATCH', 'DELETE'])]
    public function productService(Request $request, ?string $productId = null): JsonResponse
    {
        try {
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

            $responseData = $this->serviceFetcherFacade->getProductServiceFetcher()->routeRequest($requestData);

        } catch (Exception $exception) {
            return new JsonResponse([
                'error' => $exception->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }

        return new JsonResponse(
            $responseData->getResponseBody(),
            $responseData->getResponseCode()
        );
    }

    #[Route('basketservice/{endpoint}', name: 'basket_service', methods: ['GET', 'POST', 'DELETE'])]
    public function basketService(Request $request, string $endpoint): JsonResponse
    {
        try {
            $rawData = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);

            $requestData = (new BasketRequestData())
                ->setMethod($request->getMethod())
                ->setEndpoint($endpoint)
                ->setAuthorizationToken($request->headers->get('Authorization'))
                ->setProductId($rawData['productId'] ?? null)
                ->setQuantity($rawData['quantity'] ?? null)
            ;

            $responseData = $this->serviceFetcherFacade->getBasketServiceFetcher()->routeRequest($requestData);

        } catch (Exception $exception) {
            return new JsonResponse([
                'error' => $exception->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }

        return new JsonResponse(
            $responseData->getResponseBody(),
            $responseData->getResponseCode()
        );
    }
}
