<?php

namespace App\Controller;

use App\Interface\GatewayControllerInterface;
use App\Interface\MicroserviceFetcherInterface;
use App\Interface\RequestDataInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

abstract class AbstractGatewayController extends AbstractController implements GatewayControllerInterface
{
    final public function manageRequest(RequestDataInterface $requestData, MicroserviceFetcherInterface $serviceFetcher): JsonResponse
    {
        try {
            $responseData = $serviceFetcher->routeRequest($requestData);
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
