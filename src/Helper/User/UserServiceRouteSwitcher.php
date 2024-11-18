<?php

namespace App\Helper\User;

use App\Enum\UserServiceAuthenticationEndpointsEnum;

final readonly class UserServiceRouteSwitcher
{
    public static function switchRoute(string $endpoint, ?string $urlParameter = null): string
    {
        $apiUrl = $_ENV['API_USER_SERVICE_URL'];

        if (UserServiceAuthenticationEndpointsEnum::isValidEndpoint($endpoint)) {
            return "{$apiUrl}/auth/{$endpoint}";
        }

        return "{$apiUrl}/{$endpoint}/{$urlParameter}";
    }
}
