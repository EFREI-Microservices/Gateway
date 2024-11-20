<?php

namespace App\Helper;

use App\Interface\RequestDataInterface;
use ReflectionClass;

final readonly class RequestContentManager
{
    /**
     * @return array<string, string>
     */
    public static function getHeaders(RequestDataInterface $requestData): array
    {
        if (!$requestData->getAuthorizationToken()) {
            return [];
        }

        return [
            'Authorization' => $requestData->getAuthorizationToken(),
        ];
    }

    /**
     * @return array<string, int|string|bool>
     */
    public static function getBody(RequestDataInterface $requestData): array
    {
        $reflectionClass = new ReflectionClass($requestData);
        $properties = $reflectionClass->getProperties();

        $data = [];
        foreach ($properties as $property) {
            $name = $property->getName();
            $value = $property->getValue($requestData);

            if ($value !== null) {
                $data[$name] = $value;
            }
        }

        return $data;
    }
}
