<?php

namespace App\Service\ServiceFetcher;

use App\Helper\ErrorMessageTrimmer;
use App\Helper\RequestContentManager;
use App\Interface\MicroserviceFetcherInterface;
use App\Interface\RequestDataInterface;
use App\Simple\ResponseData;
use Override;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

abstract readonly class AbstractServiceFetcher implements MicroserviceFetcherInterface
{
    public function __construct(
        protected HttpClientInterface $httpClient
    ) {
    }

    #[Override]
    final public function routeRequest(RequestDataInterface $requestData): ResponseData
    {
        try {
            $response = $this->httpClient->request(
                $requestData->getMethod(),
                $this->getRoute($requestData),
                [
                    'headers' => RequestContentManager::getHeaders($requestData),
                    'json' => RequestContentManager::getBody($requestData),
                ]
            );

            return (new ResponseData())
                ->setResponseCode($response->getStatusCode())
                ->setResponseBody($response->toArray())
            ;

        } catch (TransportExceptionInterface|ClientExceptionInterface|RedirectionExceptionInterface|ServerExceptionInterface|DecodingExceptionInterface $exception) {
            return (new ResponseData())
                ->setResponseCode($exception->getCode())
                ->setResponseBody(['Error' => ErrorMessageTrimmer::trim($exception->getMessage())])
            ;
        }
    }
}
