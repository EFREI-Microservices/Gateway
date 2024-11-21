<?php

namespace App\Controller;

use App\Simple\RequestData\UserRequestData;
use JsonException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

final class UserController extends AbstractGatewayController
{
    /**
     * @throws JsonException
     */
    #[Route('userservice/{endpoint}/{userId?}', name: 'user_service', methods: ['GET', 'POST', 'PATCH', 'DELETE'])]
    public function index(Request $request, ?string $endpoint = null, ?string $userId = null): JsonResponse
    {
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

        return $this->manageRequest($requestData, $this->serviceFetcherFacade->getUserServiceFetcher());
    }
}
