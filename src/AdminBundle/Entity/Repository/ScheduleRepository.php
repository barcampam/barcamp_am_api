<?php

namespace AdminBundle\Entity\Repository;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;

class ScheduleRepository extends EntityRepository
{
    public function findActual($date)
    {
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        $query = $qb->select('s')
            ->from('AdminBundle\Entity\Schedule', 's')
            ->where('s.timeFrom > :date_from')
            ->where('s.timeTo < :date_from')
            ->setParameter('date_from', $date, \Doctrine\DBAL\Types\Type::DATETIME)
            ->setMaxResults(3)
            ->getQuery();
        
        $result = $query->getResult();

        return $result;
    }
}