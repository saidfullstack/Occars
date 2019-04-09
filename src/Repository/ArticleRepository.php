<?php

namespace App\Repository;

use App\Entity\Article;
use App\Entity\ArticleSearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Article::class);
    }
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
    public function searchCar($criteria)
    {
        return $this->createQueryBuilder('c')
            ->where('c.marque = :marque')
            ->setParameter('marque', $criteria['marque'])
            ->andWhere('c.piece = :piece')
            ->setParameter('piece', $criteria['piece'])
            ->andWhere('c.energie = :energie')
            ->setParameter('energie', $criteria['energie'])
            ->andWhere('c.prix > :PrixMin')
            ->setParameter('PrixMin', $criteria['PrixMin'])
            ->andWhere('c.prix < :PrixMax')
            ->setParameter('PrixMax', $criteria['PrixMax'])
            ->getQuery()
            ->getResult();

    }

}
