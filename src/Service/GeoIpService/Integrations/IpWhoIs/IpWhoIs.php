<?php

namespace App\Service\GeoIpService\Integrations;

use App\Service\GeoIpService\DataModels\GeoIpData;
use App\Service\GeoIpService\Enums\GeoIpHandlerEnum;
use App\Service\GeoIpService\Excetions\GeoIpIntegrationRequestException;
use App\Service\GeoIpService\Integrations\IpWhoIs\DataModels\Responses\GetIpDataResponse;
use App\Service\GeoIpService\Interfaces\GeoIpDataInterface;
use App\Service\GeoIpService\Interfaces\GeoIpIntegrationInteface;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class IpWhoIs implements GeoIpIntegrationInteface
{
    private const URL = 'http://ipwho.is';

    public function getIpData(string $ip): GeoIpDataInterface
    {
        $ipDataResponse = new GetIpDataResponse($this->request('get', '/' . $ip));

        return new GeoIpData([
            'ip' => $ipDataResponse->ip,
            'country' => $ipDataResponse->country_code,
            'city' => $ipDataResponse->city,
            'source' => GeoIpHandlerEnum::IP_WHO_IS_HANDLER->value,
        ]);
    }

    protected function request(string $method, string $url): array
    {
        try {

            $client = new HttpClient();
            $request = $client->create()->request(strtoupper($method), self::URL . $url);
            $response = $request->getContent();
            $code = $request->getStatusCode();

            if (!in_array($code, [200])) {
                throw new GeoIpIntegrationRequestException('Ip Who Is: ' . $response);
            }

            $responseData = json_decode($response, true);
            if (json_last_error() != JSON_ERROR_NONE) {
                throw new GeoIpIntegrationRequestException('p Who Is json error: ' . $response);
            }
        } catch (TransportExceptionInterface $e) {
            throw $e;
        }

        return $responseData;
    }
}
