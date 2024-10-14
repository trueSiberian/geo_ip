<?php

namespace App\Controller\Api;

use App\Component\Serializer;
use App\Service\GeoIpService\GeoIpService;
use Symfony\Component\HttpFoundation\Response;

class GeoIpController extends ApiController
{
    protected GeoIpService $geoIpService;
    protected Serializer $serializer;

    public function __construct(GeoIpService $geoIpService, Serializer $serializer)
    {
        $this->geoIpService = $geoIpService;
        $this->serializer = $serializer;
    }

    public function show(string $ip): Response
    {
        $geoIp = $this->geoIpService->findByIp($ip);
        return $this->success($this->serializer->serializeGeoIp($geoIp));
    }
}
