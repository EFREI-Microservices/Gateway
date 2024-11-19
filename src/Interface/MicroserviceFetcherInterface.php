<?php

namespace App\Interface;

use App\Simple\ResponseData;

interface MicroserviceFetcherInterface
{
    public function routeRequest(RequestDataInterface $requestData): ResponseData;

    public function getRoute(RequestDataInterface $requestData): string;
}
