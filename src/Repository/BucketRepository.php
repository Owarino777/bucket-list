<?php

namespace App\Repository;

use App\Entity\Bucket;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Bucket>
 *
 * @method Bucket|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bucket|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bucket[]    findAll()
 * @method Bucket[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BucketRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bucket::class);
    }

    public function findBestBucket()
    {
        /*
        //en DQL
        $entityManager = $this->getEntityManager();
        $dql = "
            SELECT s 
            FROM App\Entity\Bucket s 
            WHERE s.popularity > 100
            AND s.vote > 8
            ORDER BY s.popularity DESC
        ";
        $query = $entityManager->createQuery($dql);
        */


        //version QueryBuilder
        $queryBuilder = $this->createQueryBuilder('s');

        $queryBuilder->leftJoin('s.seasons', 'seas')
            ->addSelect('seas');


        $queryBuilder->andWhere('s.popularity > 100');
        $queryBuilder->andWhere('s.vote > 8');
        $queryBuilder->addOrderBy('s.popularity', 'DESC');
        $query = $queryBuilder->getQuery();


        $query->setMaxResults(50);

        $paginator = new Paginator($query);


        return $paginator;
    }
}
    //    /**
    //     * @return Bucket[] Returns an array of Bucket objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('b')
    //            ->andWhere('b.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('b.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Bucket
    //    {
    //        return $this->createQueryBuilder('b')
    //            ->andWhere('b.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
