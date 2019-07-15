<?php

namespace App\Repository;

use App\Entity\ServicesImages;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ServicesImages|null find($id, $lockMode = null, $lockVersion = null)
 * @method ServicesImages|null findOneBy(array $criteria, array $orderBy = null)
 * @method ServicesImages[]    findAll()
 * @method ServicesImages[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ServicesImagesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ServicesImages::class);
    }

    // /**
    //  * @return ServicesImages[] Returns an array of ServicesImages objects
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
    public function findOneBySomeField($value): ?ServicesImages
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
