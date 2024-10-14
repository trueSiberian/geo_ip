<?php

namespace App\Service\GeoIpService\Enums;

use App\Service\GeoIpService\Excetions\GeoIpIntegrationNotFound;
use App\Service\GeoIpService\Integrations\IpWhoIs;

enum GeoIpHandlerEnum: string
{
    case IP_WHO_IS_HANDLER = 'ip_who_is';

    static function mapHandlerToClass(string $handler)
    {
        $class =  match ($handler) {
            self::IP_WHO_IS_HANDLER->value => IpWhoIs::class,
            default => IpWhoIs::class,
            // По хорошему выдавать ошибку что интеграции нет
            // default => throw new GeoIpIntegrationNotFound('Integration' . $handler . 'not found'),
        };

        return new $class;
    }
}
