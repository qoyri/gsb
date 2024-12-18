<?php

namespace App\Repository;

use App\Entity\FicheFrais;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<FicheFrais>
 */
class FicheFraisRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FicheFrais::class);
    }

    // src/Repository/FicheFraisRepository.php

    public function findTop10VisitorsByMonth(\DateTimeInterface $mois): array
    {
        return $this->createQueryBuilder('f')
            ->join('f.visitor', 'u')
            ->select('u.nom', 'u.prenom', 'SUM(f.montantValid) as totalMontantValid')
            ->andWhere('f.mois = :mois')
            ->setParameter('mois', $mois)
            ->groupBy('u.id')
            ->orderBy('totalMontantValid', 'DESC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();
    }

//    /**
//     * @return FicheFrais[] Returns an array of FicheFrais objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('f.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?FicheFrais
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
