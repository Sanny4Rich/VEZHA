<?php

namespace App\Repository;

use App\Entity\PartnersTranslations;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PartnersTranslations|null find($id, $lockMode = null, $lockVersion = null)
 * @method PartnersTranslations|null findOneBy(array $criteria, array $orderBy = null)
 * @method PartnersTranslations[]    findAll()
 * @method PartnersTranslations[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PartnersTranslationsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PartnersTranslations::class);
    }

    // /**
    //  * @return PartnersTranslations[] Returns an array of PartnersTranslations objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PartnersTranslations
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
