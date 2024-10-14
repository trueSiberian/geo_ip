<?php

namespace App\Service\GeoIpService\Integrations\IpWhoIs\DataModels\Responses;

use App\Trait\PropertyLoader;


class GetIpDataResponse 
{
    use PropertyLoader;

    public string $ip;
    public string $country_code;
    public string $city;

    public function __construct(array $data)
    {
        $this->setProperty($data);
    }
}
