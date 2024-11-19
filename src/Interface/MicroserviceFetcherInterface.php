<?php

namespace App\Interface;

use App\Simple\ResponseData;

interface MicroserviceFetcherInterface
{
    public function routeRequest(RequestDataInterface $requestData): ResponseData;

    public function getHeader(RequestDataInterface $requestData): array;

    public function getBody(RequestDataInterface $requestData): array;
}
