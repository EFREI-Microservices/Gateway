<?php

namespace App\Controller;

use App\Facade\ServiceFetcherFacade;
use App\Interface\GatewayControllerInterface;
use App\Interface\MicroserviceFetcherInterface;
use App\Interface\RequestDataInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

abstract class AbstractGatewayController extends AbstractController implements GatewayControllerInterface
{
    public function __construct(
        protected readonly ServiceFetcherFacade $serviceFetcherFacade,
    ) {
    }

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
