<?php

namespace App\Service;

use App\Interface\MicroserviceFetcherInterface;
use App\Interface\RequestDataInterface;
use Override;
use ReflectionClass;
use Symfony\Contracts\HttpClient\HttpClientInterface;

abstract readonly class AbstractServiceFetcher implements MicroserviceFetcherInterface
{
    public function __construct(
        protected HttpClientInterface $httpClient
    ) {
    }

    #[Override]
    final public function getHeader(RequestDataInterface $requestData): array
    {
        if (!$requestData->getAuthorizationToken()) {
            return [];
        }

        return [
            'Authorization' => $requestData->getAuthorizationToken(),
        ];
    }

    #[Override]
    final public function getBody(RequestDataInterface $requestData): array
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
