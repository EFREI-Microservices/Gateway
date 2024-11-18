<?php

namespace App\Enum;

enum UserServiceAuthenticationEndpointsEnum: string
{
    case LOGIN = 'login';
    case REGISTER = 'register';
    case CHECK_TOKEN = 'check-token';

    public static function isValidEndpoint(string $endpoint): bool
    {
        return in_array($endpoint, self::toArray(), true);
    }

    private static function toArray(): array
    {
        return array_map(static fn ($case) => $case->value, self::cases());
    }
}
