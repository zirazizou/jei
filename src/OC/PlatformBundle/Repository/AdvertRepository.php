<?php

namespace OC\PlatformBundle\Repository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * AdvertRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AdvertRepository extends \Doctrine\ORM\EntityRepository
{
    public function advertFindOne($id){
        $query = $this->createQueryBuilder('a');

        $query->where("a.id = :id")
            ->setParameter($id);

        return $query->getQuery()->getResult();
    }

    public function getAdverts($page, $nbPerPage ){

        $qr = $this->createQueryBuilder('a')
            ->leftJoin('a.image','i')
            ->addSelect('i')
            ->leftJoin('a.categories','c')
            ->addSelect('c')
            ->orderBy('a.date','desc')
            ->getQuery();

        $qr->setFirstResult(($page - 1) * $nbPerPage)
            ->setMaxResults($nbPerPage);

        return new Paginator($qr, true);
    }


    public function findByAuthorAndDate($author, $year){
        $qr = $this->createQueryBuilder('a');

        $qr->where("a.author = :author")
            ->setParameter("author", $author)
            ->andWhere("a.date < :year")
            ->setParameter("year", $year)
            ->orderBy("a.date","DESC");

        return $qr->getQuery()->getResult();
    }

    public function whereCurrentYear(QueryBuilder $qr){
        $qr->andWhere('a.date BETWEEN :start AND :end')
            ->setParameter("start", new \DateTime(date('Y')."-01-01"))
            ->setParameter("end", new \DateTime(date('Y')."-12-31"));
    }

    public function advertFind($author){

        $qr = $this->createQueryBuilder('a');

        $qr->where("a.author = :v author")
            ->setParameter("author", $author);
        $this->whereCurrentYear($qr);
        $qr->orderBy("a.date", "DESC");

        return $qr->getQuery()->getResult();

    }
    public function getAdvertWithApplications(){

        $qr = $this->createQueryBuilder('a')
            ->leftJoin('a.applications','app')
            ->addSelect('app');

        return $qr->getQuery()->getResult();
    }

    public function getAdvertWithCategory(Array $categoryNames){
        $qr = $this->createQueryBuilder('a');

        $qr->leftJoin('a.categories','cat')
            ->addSelect('cat')
            ->where($qr->expr()->in('cat.name', $categoryNames));

        return $qr->getQuery()->getResult();
    }

    public function getAdvert(){
        $qr = $this->createQueryBuilder('a')
            ->orderBy('a.date','DESC');

        return $qr->getQuery()->getResult();
    }
}
