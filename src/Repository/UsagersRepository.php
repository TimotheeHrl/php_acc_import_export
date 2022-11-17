<?php

namespace App\Repository;

use App\Entity\Usagers;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Usagers>
 *
 * @method Usagers|null find($id, $lockMode = null, $lockVersion = null)
 * @method Usagers|null findOneBy(array $criteria, array $orderBy = null)
 * @method Usagers[]    findAll()
 * @method Usagers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UsagersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Usagers::class);
    }

    public function add(Usagers $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Usagers $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return Usagers[] Returns an array of Caracteristique objects
     */
    public function findByNum_Acc(string $num_Acc): array
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.num_Acc = :val')
            ->setParameter('val', $num_Acc)
            ->getQuery()
            ->getResult();
    }

    /**
     * @return Usagers[] Returns an array of Caracteristique objects
     */
    public function insertUsagers($usagers): array
    {
        $entityManager = $this->getEntityManager();
        $entityManager->getConnection()->getConfiguration()->setSQLLogger(null);
        $entityManager->getConnection()->beginTransaction();
        try {
            foreach ($usagers as $usager) {
                $entityManager->persist($usager);
            }
            $entityManager->flush();
            $entityManager->getConnection()->commit();
        } catch (\Exception $e) {
            $entityManager->getConnection()->rollBack();
            throw $e;
        }
        return $usagers;
    }

    /**
     * @return Usagers[] Returns an array of Lieux objects
     */
    public function getPaginatedRecords($row_index): array
    {
        $entityManager = $this->getEntityManager();
        $entityManager->getConnection()->getConfiguration()->setSQLLogger(null);
        $entityManager->getConnection()->beginTransaction();
        try {
            $query = $entityManager->createQuery(
                'SELECT u
                FROM App\Entity\Usagers u
                WHERE u.id > :row_index
                ORDER BY u.id ASC'
            )->setParameter('row_index', $row_index)
                ->setMaxResults(100);
            $usagers = $query->getResult();
            $entityManager->getConnection()->commit();
        } catch (\Exception $e) {
            $entityManager->getConnection()->rollBack();
            throw $e;
        }
        return $usagers;
    }
    //    /**
    //     * @return Usagers[] Returns an array of Usagers objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('u')
    //            ->andWhere('u.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('u.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Usagers
    //    {
    //        return $this->createQueryBuilder('u')
    //            ->andWhere('u.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
