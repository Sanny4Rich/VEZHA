<?php

namespace App\Repository;

use App\Entity\StaticTranslations;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method StaticTranslations|null find($id, $lockMode = null, $lockVersion = null)
 * @method StaticTranslations|null findOneBy(array $criteria, array $orderBy = null)
 * @method StaticTranslations[]    findAll()
 * @method StaticTranslations[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StaticTranslationsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, StaticTranslations::class);
    }

    // /**
    //  * @return StaticTranslations[] Returns an array of StaticTranslations objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?StaticTranslations
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
