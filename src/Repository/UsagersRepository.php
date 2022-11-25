<?php

namespace App\Repository;

use App\Entity\Usager;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Usager>
 *
 * @method Usager|null find($id, $lockMode = null, $lockVersion = null)
 * @method Usager|null findOneBy(array $criteria, array $orderBy = null)
 * @method Usager[]    findAll()
 * @method Usager[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UsagersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Usager::class);
    }

    public function add(Usager $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Usager $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return Usager[] Returns an array of Caracteristique objects
     */
    public function findByNum_Acc(string $num_acc): array
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.num_acc = :val')
            ->setParameter('val', $num_acc)
            ->getQuery()
            ->getResult();
    }

    /**
     * @return Usager[] Returns an array of Caracteristique objects
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
     * @return Usager[] Returns an array of Lieux objects
     */
    public function getPaginatedRecords($row_index): array
    {
        $entityManager = $this->getEntityManager();
        $entityManager->getConnection()->getConfiguration()->setSQLLogger(null);
        $entityManager->getConnection()->beginTransaction();
        try {
            $query = $entityManager->createQuery(
                'SELECT u
                FROM App\Entity\Usager u
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
}
