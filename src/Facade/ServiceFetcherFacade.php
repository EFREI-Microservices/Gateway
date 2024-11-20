<?php

namespace App\Facade;

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

    public function getUserServiceFetcher(): UserServiceFetcher
    {
        return new UserServiceFetcher($this->httpClient);
    }

    public function getProductServiceFetcher(): ProductServiceFetcher
    {
        return new ProductServiceFetcher($this->httpClient);
    }

    public function getBasketServiceFetcher(): BasketServiceFetcher
    {
        return new BasketServiceFetcher($this->httpClient);
    }
}
