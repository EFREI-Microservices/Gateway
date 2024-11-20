<?php

namespace App\Facade;

use App\Interface\MicroserviceFetcherInterface;
use App\Service\ServiceFetcher\BasketServiceFetcher;
use App\Service\ServiceFetcher\ProductServiceFetcher;
use App\Service\ServiceFetcher\UserServiceFetcher;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final readonly class ServiceFetcherFacade
{
    public function __construct(
        private HttpClientInterface $httpClient,
    ) {
    }

    public function getUserServiceFetcher(): MicroserviceFetcherInterface
    {
        return new UserServiceFetcher($this->httpClient);
    }

    public function getProductServiceFetcher(): MicroserviceFetcherInterface
    {
        return new ProductServiceFetcher($this->httpClient);
    }

    public function getBasketServiceFetcher(): MicroserviceFetcherInterface
    {
        return new BasketServiceFetcher($this->httpClient);
    }
}
