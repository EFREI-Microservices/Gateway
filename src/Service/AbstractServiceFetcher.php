<?php

namespace App\Service;

use App\Interface\MicroserviceFetcherInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

abstract readonly class AbstractServiceFetcher implements MicroserviceFetcherInterface
{
    public function __construct(
        private HttpClientInterface $httpClient
    ) {}
}
