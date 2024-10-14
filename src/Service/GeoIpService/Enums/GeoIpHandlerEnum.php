<?php

namespace App\Service\GeoIpService\Enums;

use App\Service\GeoIpService\Integrations\IpWhoIs;

enum GeoIpHandlerEnum: string
{
    case IP_WHO_IS_HANDLER = 'ip_who_is';

    public function mapHandlerToClass()
    {
        $class =  match ($this) {
            self::IP_WHO_IS_HANDLER => IpWhoIs::class,
        };

        return new $class;
    }
}
