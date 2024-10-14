<?php

namespace App\Service\GeoIpService;

use App\Entity\GeoIp;
use App\Repository\GeoIpRepository;
use App\Service\GeoIpService\Enums\GeoIpHandlerEnum;
use App\Service\GeoIpService\Excetions\GeoIpIntegrationNotFound;
use App\Service\GeoIpService\Interfaces\GeoIpDataInterface;
use Doctrine\ORM\EntityManagerInterface;
use Exception;

class GeoIpService
{
    protected GeoIpRepository $geoIpRepository;
    protected EntityManagerInterface $entityManager;

    public function __construct(GeoIpRepository $geoIpRepository, EntityManagerInterface $entityManager)
    {
        $this->geoIpRepository = $geoIpRepository;
        $this->entityManager = $entityManager;
    }

    public function findByIp(string $ip)
    {
        $geoIp = $this->geoIpRepository->findOneByIp($ip);
        if (empty($geoIp)) {
            $geoIpData = $this->hanlder('ip_who_is')->getIpData($ip);
            $geoIp = $this->save($geoIpData);
        }
        return $geoIp;
    }

    public function save(GeoIpDataInterface $geoIpData)
    {
        $geoIp = new GeoIp();
        $geoIp->setIp($geoIpData->getIp());
        $geoIp->setCountry($geoIpData->getCountry());
        $geoIp->setCity($geoIpData->getCity());
        $geoIp->setSource($geoIpData->getSource());

        $this->entityManager->persist($geoIp);
        $this->entityManager->flush();

        return $geoIp;
    }

    protected function hanlder(string $handler)
    {
        try {
            return GeoIpHandlerEnum::from($handler)->mapHandlerToClass();
        } catch (Exception $e) {
            throw new GeoIpIntegrationNotFound('Integration' . $handler . 'not found: '. $e->getMessage());
        }
    }
}
