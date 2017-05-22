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

	$resultt = [];

	for ($i = 0; $i <= 4; $i++) {

		$qb = $em->createQueryBuilder();
		$query = $qb->select('s')
		    ->from('AdminBundle\Entity\Schedule', 's')
		    ->where('s.timeTo > :date_from and s.room = :room')
		    ->setParameter('date_from', $date, \Doctrine\DBAL\Types\Type::DATETIME)
		    ->setParameter('room', $i)
		    ->setMaxResults(3)
		    ->getQuery();

		$result = $query->getResult();

		$resultt = array_merge($resultt, $result);
	}

        return $resultt;
    }

    public function findByDay($day) 
    {
        if ($day == 1) {
            $dateStart = new \DateTime("2017-05-27");
            $dateEnd = new \DateTime("2017-05-28");
        } else {
            $dateStart = new \DateTime("2017-05-28");
            $dateEnd = new \DateTime("2017-05-29");
        }
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        $query = $qb->select('s')
            ->from('AdminBundle\Entity\Schedule', 's')
            ->where('s.timeTo >= :date_start and s.timeFrom < :date_end')
            ->orderBy('s.timeTo', 'ASC')
            ->setParameter('date_start', $dateStart, \Doctrine\DBAL\Types\Type::DATETIME)
            ->setParameter('date_end', $dateEnd, \Doctrine\DBAL\Types\Type::DATETIME)
            ->getQuery();
        
        $result = $query->getResult();

        return $result;
    }
}