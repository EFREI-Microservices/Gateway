<?php

namespace App\Controller;

use App\Simple\UserRequestData;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/gateway/')]
final class GatewayController extends AbstractController
{
    /**
     * @throws \JsonException
     */
    #[Route('userservice/{userId?}', name: 'user_service', methods: ['GET', 'POST', 'PATCH','DELETE'])]
    public function userService(Request $request, ?int $userId = null): Response
    {
        try {
            $rawData = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);

            $requestData = new UserRequestData();

            $requestData->setMethod($request->getMethod())
                ->setRouteName($rawData['routeName'])
                ->setAuthorizationToken($request->headers->get('Authorization'))
                ->setUserId($userId);
        } catch (Exception $exception) {
            return new JsonResponse([
                'error' => $exception->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }

        return new JsonResponse([
            $requestData->getRouteName() => $requestData->getMethod(),
            $requestData->getUserId() => $requestData->getAuthorizationToken(),
        ]);
    }
}
