<?php

namespace App\Service\GeoIpService\Interfaces;

interface GeoIpDataInterface
{
    public function getIp(): string;
    public function getCountry(): string;
    public function getCity(): string;
    public function getSource() : string;
}
