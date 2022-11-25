<?php

namespace App\Repository;

use App\Entity\Vehicule;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Vehicule>
 *
 * @method Vehicule|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vehicule|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vehicule[]    findAll()
 * @method Vehicule[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VehiculeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vehicule::class);
    }

    public function add(Vehicule $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Vehicule $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return Vehicule[] Returns an array of Caracteristique objects
     */
    public function findByNum_Acc(string $num_acc): array
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.num_acc = :val')
            ->setParameter('val', $num_acc)
            ->getQuery()
            ->getResult();
    }

    /**
     * @return Vehicule[] Returns an array of Caracteristique objects
     */
    public function insertVehicules($vehicules): array
    {
        $entityManager = $this->getEntityManager();
        $entityManager->getConnection()->getConfiguration()->setSQLLogger(null);
        $entityManager->getConnection()->beginTransaction();
        try {
            foreach ($vehicules as $vehicule) {
                $entityManager->persist($vehicule);
            }
            $entityManager->flush();
            $entityManager->getConnection()->commit();
        } catch (\Exception $e) {
            $entityManager->getConnection()->rollBack();
            throw $e;
        }
        return $vehicules;
    }
    /**
     * @return Vehicule[] Returns an array of Lieux objects
     */
    public function getPaginatedRecords($row_index): array
    {
        $entityManager = $this->getEntityManager();
        $entityManager->getConnection()->getConfiguration()->setSQLLogger(null);
        $entityManager->getConnection()->beginTransaction();
        try {
            $query = $entityManager->createQuery(
                'SELECT v
                FROM App\Entity\Vehicule v
                WHERE v.id > :row_index
                ORDER BY v.id ASC'
            )->setParameter('row_index', $row_index)
                ->setMaxResults(100);
            $vehicules = $query->getResult();
            $entityManager->getConnection()->commit();
        } catch (\Exception $e) {
            $entityManager->getConnection()->rollBack();
            throw $e;
        }
        return $vehicules;
    }


    //    /**
    //     * @return Vehicule[] Returns an array of Vehicule objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('v')
    //            ->andWhere('v.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('v.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Vehicule
    //    {
    //        return $this->createQueryBuilder('v')
    //            ->andWhere('v.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
