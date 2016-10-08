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
            ->leftJoin('u.posts', 'p')
            ->where('p.id = :id')
            ->orderBy('u.firstName', 'ASC')
            ->setParameter('id', $id)
        ;

        return $q->getQuery()->getResult();
    }
}
