<?php

namespace App\Repository;

use App\Entity\CategoriesTranslations;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CategoriesTranslations|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategoriesTranslations|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategoriesTranslations[]    findAll()
 * @method CategoriesTranslations[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoriesTranslationsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CategoriesTranslations::class);
    }

    // /**
    //  * @return CategoriesTranslations[] Returns an array of CategoriesTranslations objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CategoriesTranslations
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
