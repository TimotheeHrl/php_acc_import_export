<?php

namespace App\Repository;

use App\Entity\Caracteristique;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Caracteristique>
 *
 * @method Caracteristique|null find($id, $lockMode = null, $lockVersion = null)
 * @method Caracteristique|null findOneBy(array $criteria, array $orderBy = null)
 * @method Caracteristique[]    findAll()
 * @method Caracteristique[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CaracteristiqueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Caracteristique::class);
    }

    public function add(Caracteristique $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Caracteristique $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    /**
     * @return Caracteristique[] Returns an array of Caracteristique objects
     */
    public function findByNum_Acc(int $num_acc): array
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.num_acc = :val')
            ->setParameter('val', $num_acc)
            ->getQuery()
            ->getResult();
    }
    /**
     * @return Caracteristique[] Returns an array of Caracteristique objects
     */
    public function insertCaracteristiques($caracteristiques): array
    {
        $entityManager = $this->getEntityManager();
        $entityManager->getConnection()->getConfiguration()->setSQLLogger(null);
        $entityManager->getConnection()->beginTransaction();
        try {
            foreach ($caracteristiques as $caracteristique) {
                $entityManager->persist($caracteristique);
            }
            $entityManager->flush();
            $entityManager->getConnection()->commit();
        } catch (\Exception $e) {
            $entityManager->getConnection()->rollBack();
            throw $e;
        }
        return $caracteristiques;
    }

    /**
     * @return Caracteristique[] Returns an array of Caracteristique objects
     */
    public function getPaginatedRecords($row_index): array
    {
        $entityManager = $this->getEntityManager();
        $entityManager->getConnection()->getConfiguration()->setSQLLogger(null);
        $entityManager->getConnection()->beginTransaction();
        try {
            $query = $entityManager->createQuery(
                'SELECT c
                FROM App\Entity\Caracteristique c
                WHERE c.id > :row_index
                ORDER BY c.id ASC'
            )->setParameter('row_index', $row_index)
                ->setMaxResults(50);
            $caracteristiques = $query->getResult();
            $entityManager->getConnection()->commit();
        } catch (\Exception $e) {
            $entityManager->getConnection()->rollBack();
            throw $e;
        }
        return $caracteristiques;
    }
    /**
     * @return Caracteristique[] Returns an array of Caracteristique objects
     */
    public function getPaginatedRecordsCsv($row_index): array
    {
        $entityManager = $this->getEntityManager();
        $entityManager->getConnection()->getConfiguration()->setSQLLogger(null);
        $entityManager->getConnection()->beginTransaction();
        try {
            $query = $entityManager->createQuery(
                'SELECT c
                FROM App\Entity\Caracteristique c
                WHERE c.id > :row_index
                ORDER BY c.id ASC'
            )->setParameter('row_index', $row_index)
                ->setMaxResults(100);
            $caracteristiques = $query->getResult();
            $entityManager->getConnection()->commit();
        } catch (\Exception $e) {
            $entityManager->getConnection()->rollBack();
            throw $e;
        }
        return $caracteristiques;
    }

    //    /**
    //     * @return Caracteristique[] Returns an array of Caracteristique objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('c.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Caracteristique
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
