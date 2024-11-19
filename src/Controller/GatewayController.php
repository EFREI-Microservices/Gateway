<?php

namespace App\Controller;

use App\Service\User\UserServiceFetcher;
use App\Simple\User\UserRequestData;
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
        private readonly UserServiceFetcher $userServiceFetcher
    ) {
    }

    #[Route('userservice/{userId?}', name: 'user_service', methods: ['GET', 'POST', 'PATCH', 'DELETE'])]
    public function userService(Request $request, ?string $userId = null): Response
    {
        try {
            $rawData = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);

            $requestData = (new UserRequestData())
                ->setId($userId)
                ->setMethod($request->getMethod())
                ->setEndpoint($rawData['endpoint'])
                ->setAuthorizationToken($request->headers->get('Authorization'))
                ->setUsername($rawData['username'] ?? null)
                ->setPassword($rawData['password'] ?? null)
                ->setRole($rawData['role'] ?? null)
            ;

            $responseData = $this->userServiceFetcher->routeRequest($requestData);

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
