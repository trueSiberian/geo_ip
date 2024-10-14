<?php

namespace App\Component;


use App\Entity\GeoIp;

class Serializer
{
    /**
     * @param GeoIp $geoIp
     * @return array
     */
    public function serializeGeoIp(GeoIp $geoIp): array
    {
        return [
            'ip' => $geoIp->getIp(),
            'country' => $geoIp->getCountry(),
            'city' => $geoIp->getCity(),
            'source' => $geoIp->getSource(),
        ];
    }
}
