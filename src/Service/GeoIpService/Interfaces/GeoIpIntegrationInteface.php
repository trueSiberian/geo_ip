<?php

namespace App\Service\GeoIpService\Interfaces;

interface GeoIpIntegrationInteface
{
    public function getIpData(string $ip): GeoIpDataInterface;
}
