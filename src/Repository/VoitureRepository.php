<?php

namespace App\Repository;

use App\Entity\Voiture;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Voiture|null find($id, $lockMode = null, $lockVersion = null)
 * @method Voiture|null findOneBy(array $criteria, array $orderBy = null)
 * @method Voiture[]    findAll()
 * @method Voiture[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VoitureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Voiture::class);
    }


    /**
     * @return Voiture[]
     */
    public function findAllGreaterThanPub($pubvoiture): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT p
            FROM App\Entity\Voiture p
            WHERE p.pubvoiture = :pubvoiture'
        )->setParameter('pubvoiture', $pubvoiture);

        // returns an array of Voiture objects
        return $query->getResult();
    }

    /**
     * @return Voiture[]
     */
    public function findAllGreaterThanPub2($pubvoiture): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT p
            FROM App\Entity\Voiture p
            WHERE p.pubvoiture = :pubvoiture'
        )->setParameter('pubvoiture', $pubvoiture);

        // returns an array of Voiture objects
        return $query->getResult();
    }

    /**
     * @return Voiture[]
     */
    public function findAll1($nom,$prix)
    {

        
        $entityManager = $this->getEntityManager();
        $queryBuilder=$entityManager->getRepository('App\Entity\Voiture')->createQueryBuilder('v');

        $queryBuilder->where('v.nom LIKE :nom and v.prixparjour LIKE :prix and v.disponible = 1 and v.pubvoiture <> 1')
        ->setParameter('nom','%'. $nom . '%')
        ->setParameter('prix', '%'.$prix. '%');
    
       
       return $queryBuilder->getQuery();

    }
//$entityManager = $this->getDoctrine()->getManager();
      /*  $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT p
            FROM App\Entity\Voiture p
            Where p.disponible = 1'
        );

        // returns an array of Voiture objects
        return $query->getResult();*/



    /**
     * @return Voiture[]
     */
    public function findAll2()
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT p
            FROM App\Entity\Voiture p
            Where p.disponible = 1 and p.pubvoiture <> 1 '
        )->setMaxResults(6);

        // returns an array of Voiture objects
        return $query->getResult();
    }

     
     /**
     * @return Voiture[]
     */
    public function findAllCount()
    {
        $entityManager = $this->getEntityManager();
        $repository = $entityManager->getRepository('App\Entity\Voiture');
        $qb = $repository->createQueryBuilder('t');
        return $qb
            ->select('count(t.id)')
            ->andWhere('t.disponible = 1')
            ->getQuery()
            ->getSingleScalarResult();
    }




    // /**
    //  * @return Voiture[] Returns an array of Voiture objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Voiture
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
