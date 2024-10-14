<?php

namespace App\Service\GeoIpService\DataModels;

use App\Service\GeoIpService\Interfaces\GeoIpDataInterface;
use App\Trait\PropertyLoader;

class GeoIpData implements GeoIpDataInterface
{
    use PropertyLoader;

    protected string $ip;

    protected string $country;

    protected string $city;

    protected string $source;

    public function __construct(array $data)
    {
        $this->setProperty($data);
    }

    public function getIp(): string
    {
        return $this->ip;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getSource(): string
    {
        return $this->source;
    }
}
