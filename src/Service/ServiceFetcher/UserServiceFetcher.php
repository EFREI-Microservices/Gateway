<?php

namespace App\Service\ServiceFetcher;

use App\Enum\UserServiceAuthenticationEndpointsEnum;
use App\Interface\RequestDataInterface;
use App\Simple\RequestData\UserRequestData;
use Override;

final readonly class UserServiceFetcher extends AbstractServiceFetcher
{
    /**
     * @param UserRequestData $requestData
     */
    #[Override]
    public function getRoute(RequestDataInterface $requestData): string
    {
        $apiUrl = $_ENV['API_USER_SERVICE_URL'];

        if (UserServiceAuthenticationEndpointsEnum::isValidEndpoint($requestData->getEndpoint())) {
            return "{$apiUrl}/auth/{$requestData->getEndpoint()}";
        }

        return "{$apiUrl}/{$requestData->getEndpoint()}/{$requestData->getId()}";
    }
}
