<?php

namespace App\Service\ServiceFetcher;

use App\Interface\RequestDataInterface;
use App\Simple\RequestData\ProductRequestData;
use Override;

final readonly class ProductServiceFetcher extends AbstractServiceFetcher
{
    /**
     * @param ProductRequestData $requestData
     */
    #[Override]
    public function getRoute(RequestDataInterface $requestData): string
    {
        $apiUrl = $_ENV['API_PRODUCT_SERVICE_URL'];

        $id = $requestData->getId() ? "/{$requestData->getId()}" : '';

        return "{$apiUrl}/products{$id}";
    }
}
