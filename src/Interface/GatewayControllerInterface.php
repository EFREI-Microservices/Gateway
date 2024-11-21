<?php

namespace App\Interface;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

interface GatewayControllerInterface
{
    public function manageRequest(RequestDataInterface $requestData, MicroserviceFetcherInterface $serviceFetcher): JsonResponse;

    public function index(Request $request): JsonResponse;
}
