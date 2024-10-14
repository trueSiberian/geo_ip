<?php

namespace App\Service\GeoIpService\Excetions;

use Exception;
use Throwable;

abstract class GeoIpException extends Exception
{
    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct('GeoIp service: ' . $message, $code, $previous);
    }

}