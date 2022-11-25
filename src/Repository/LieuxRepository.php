<?php

namespace App\Repository;

use App\Entity\Lieux;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Lieux>
 *
 * @method Lieux|null find($id, $lockMode = null, $lockVersion = null)
 * @method Lieux|null findOneBy(array $criteria, array $orderBy = null)
 * @method Lieux[]    findAll()
 * @method Lieux[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LieuxRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Lieux::class);
    }

    public function add(Lieux $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Lieux $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    /**
     * @return Lieux[] Returns an array of Caracteristique objects
     */
    public function findByNum_Acc(string $num_acc): array
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.num_acc = :val')
            ->setParameter('val', $num_acc)
            ->getQuery()
            ->getResult();
    }
    /**
     * @return Lieux[] Returns an array of Caracteristique objects
     */
    public function insertLieux($lieux): array
    { {
            $entityManager = $this->getEntityManager();
            $entityManager->getConnection()->getConfiguration()->setSQLLogger(null);
            $entityManager->getConnection()->beginTransaction();
            try {
                foreach ($lieux as $lieu) {
                    $entityManager->persist($lieu);
                }
                $entityManager->flush();
                $entityManager->getConnection()->commit();
            } catch (\Exception $e) {
                $entityManager->getConnection()->rollBack();
                throw $e;
            }
            return $lieux;
        }
    }



    /**
     * @return Lieux[] Returns an array of Lieux objects
     */
    public function getPaginatedRecords($row_index): array
    {
        $entityManager = $this->getEntityManager();
        $entityManager->getConnection()->getConfiguration()->setSQLLogger(null);
        $entityManager->getConnection()->beginTransaction();
        try {
            $query = $entityManager->createQuery(
                'SELECT l
                FROM App\Entity\Lieux l
                WHERE l.id > :row_index
                ORDER BY l.id ASC'
            )->setParameter('row_index', $row_index)
                ->setMaxResults(100);
            $lieux = $query->getResult();
            $entityManager->getConnection()->commit();
        } catch (\Exception $e) {
            $entityManager->getConnection()->rollBack();
            throw $e;
        }
        return $lieux;
    }


    //    /**
    //     * @return Lieux[] Returns an array of Lieux objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('l')
    //            ->andWhere('l.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('l.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Lieux
    //    {
    //        return $this->createQueryBuilder('l')
    //            ->andWhere('l.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
