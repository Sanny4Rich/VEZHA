<?php

namespace App\Repository;

use App\Entity\ProductsTranslations;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ProductsTranslations|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductsTranslations|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductsTranslations[]    findAll()
 * @method ProductsTranslations[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductsTranslationsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ProductsTranslations::class);
    }

    // /**
    //  * @return ProductsTranslations[] Returns an array of ProductsTranslations objects
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
    public function findOneBySomeField($value): ?ProductsTranslations
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
