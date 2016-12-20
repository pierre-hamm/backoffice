<?php

namespace BackOfficeBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * ProductRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProductRepository extends EntityRepository
{
	public function getMyLastItem()
	{
		$qb = $this->createQueryBuilder('p');

		$qb->orderBy('p.createDate', 'DESC');
		$qb->setMaxResults(2);

		return $qb->getQuery()->getResult();
	}
}
