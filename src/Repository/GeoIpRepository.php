<?php

namespace App\Repository;

use App\Entity\GeoIp;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<GeoIp>
 */
class GeoIpRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GeoIp::class);
    }

    //    /**
    //     * @return GeoIp[] Returns an array of GeoIp objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('g')
    //            ->andWhere('g.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('g.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    public function findOneByIp(string $ip): ?GeoIp
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.ip = :val')
            ->setParameter('val', $ip)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
