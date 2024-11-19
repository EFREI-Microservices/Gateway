<?php

namespace App\Service\User;

use App\Helper\User\UserServiceRouteSwitcher;
use App\Interface\RequestDataInterface;
use App\Service\AbstractServiceFetcher;
use App\Simple\ResponseData;
use App\Simple\User\UserRequestData;
use Exception;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

final readonly class UserServiceFetcher extends AbstractServiceFetcher
{
    /**
     * @param UserRequestData $requestData
     *
     * @throws Exception
     */
    public function routeRequest(RequestDataInterface $requestData): ResponseData
    {

        try {
            $response = $this->httpClient->request(
                $requestData->getMethod(),
                UserServiceRouteSwitcher::switchRoute($requestData->getEndpoint(), $requestData->getId()),
                [
                    'headers' => $this->getHeader($requestData),
                    'json' => $this->getBody($requestData),
                ]
            );

            if ($response->getStatusCode() !== Response::HTTP_OK) {
                throw new Exception($response->getContent());
            }

            return (new ResponseData())
                ->setResponseCode($response->getStatusCode())
                ->setResponseBody($response->toArray())
            ;

        } catch (TransportExceptionInterface|ClientExceptionInterface|RedirectionExceptionInterface|ServerExceptionInterface|DecodingExceptionInterface $exception) {
            throw new Exception($exception->getMessage());
        }
    }
}
