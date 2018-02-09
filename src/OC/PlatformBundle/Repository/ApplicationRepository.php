<?php

namespace OC\PlatformBundle\Repository;

/**
 * ApplicationRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ApplicationRepository extends \Doctrine\ORM\EntityRepository
{
    public function getApplicationWithAdvert($limit){
        $db = $this->createQueryBuilder('a');
        $db->leftJoin('a.advert', 'a')
            ->addSelect('a')
            ->setMaxResults($limit);

        return $db->getQuery()->getResult();

    }

    public function getLikeQueryBuilder($pattern){

    }
}
