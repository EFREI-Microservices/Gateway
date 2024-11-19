<?php

namespace App\Interface;

interface MicroserviceFetcherInterface
{
    public function routeRequest(RequestDataInterface $requestData): ResponseDataInterface;

    public function getHeader(RequestDataInterface $requestData): array;

    public function getBody(RequestDataInterface $requestData): array;
}
