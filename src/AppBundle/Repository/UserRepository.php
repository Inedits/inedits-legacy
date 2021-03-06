<?php

namespace AppBundle\Repository;

/**
 * UserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserRepository extends \Doctrine\ORM\EntityRepository
{
    public function findUsersByTree($id, $limit)
    {
        $q = $this->createQueryBuilder('u');
        $q
            ->leftJoin('u.trees', 'p')
            ->where('p.id = :id')
            ->andWhere('u.postCount <> 0')
            ->setParameter('id', $id)
            ->setMaxResults($limit)
            ->orderBy('u.firstName')
        ;

        return $q->getQuery()->getResult();
    }

    public function findBestUsers($limit=3)
    {
        $q = $this->createQueryBuilder('u');
        $q
            ->where('u.postCount <> 0')
            ->orderBy('u.postCount', 'DESC')
            ->setMaxResults($limit)
        ;

        return $q->getQuery()->getResult();
    }

    public function findLastUsers($limit=3)
    {
        $q = $this->createQueryBuilder('u');
        $q
            ->leftJoin('u.userProfile', 'profile')
            ->where('u.enabled = 1')
            ->orderBy('u.createdAt', 'DESC')
            ->setMaxResults($limit)
        ;

        return $q->getQuery()->getResult();
    }
}
