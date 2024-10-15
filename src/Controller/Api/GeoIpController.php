<?php

namespace App\Controller\Api;

use App\Component\Serializer;
use App\Service\GeoIpService\GeoIpService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;
use Symfony\Component\RateLimiter\RateLimiterFactory;

class GeoIpController extends ApiController
{
    protected GeoIpService $geoIpService;
    protected Serializer $serializer;

    public function __construct(GeoIpService $geoIpService, Serializer $serializer)
    {
        $this->geoIpService = $geoIpService;
        $this->serializer = $serializer;
    }

    public function show(Request $request, string $ip, RateLimiterFactory $anonymousApiLimiter): Response
    {
        $limiter = $anonymousApiLimiter->create($request->getClientIp());
        if (false === $limiter->consume(1)->isAccepted()) {
            throw new TooManyRequestsHttpException();
        }

        if(!filter_var($ip, FILTER_VALIDATE_IP)){
            return $this->fail('Ip address not valid', 400);
        }
        $geoIp = $this->geoIpService->findByIp($ip);
        return $this->success($this->serializer->serializeGeoIp($geoIp));
    }
}
