<?php

namespace App\Service\ServiceFetcher;

use App\Interface\RequestDataInterface;
use App\Simple\RequestData\ProductRequestData;
use Override;

final readonly class BasketServiceFetcher extends AbstractServiceFetcher
{
    /**
     * @param ProductRequestData $requestData
     */
    #[Override]
    public function getRoute(RequestDataInterface $requestData): string
    {
        $apiUrl = $_ENV['API_BASKET_SERVICE_URL'];

        return "{$apiUrl}/{$requestData->getEndpoint()}";
    }
}
