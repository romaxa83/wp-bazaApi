<?php

namespace Api\Model\OldBaza\Entity;

use Doctrine\ORM\EntityManagerInterface;

class OldBazaRepository
{
    /**
     * @var \Doctrine\ORM\EntityRepository
     */
    private $em;
    private $repo;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->repo = $em->getRepository(OldBaza::class);
    }

    /**
     * @return mixed
     */
    public function CountData($model = null, $action = null)
    {
        if($model && $action == null){
            return $this->repo->createQueryBuilder('o')
                ->select('COUNT(o.id)')
                ->andWhere('o.model = :model')
                ->setParameter(':model',$model)
                ->getQuery()
                ->getSingleScalarResult();
        }

        if($model && $action){
            return $this->repo->createQueryBuilder('o')
                ->select('COUNT(o.id)')
                ->andWhere('o.model = :model')
                ->andWhere('o.action = :action')
                ->setParameter(':model',$model)
                ->setParameter(':action',$action)
                ->getQuery()
                ->getSingleScalarResult();
        }

        return $this->repo->createQueryBuilder('o')
            ->select('COUNT(o.id)')
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function GetData($limit, $model = null, $action = null)
    {
        if($model && $action == null){
            return $this->repo->createQueryBuilder('o')
                ->select('o.id','o.model','o.action','o.data','o.requestData')
                ->andWhere('o.model = :model')
                ->setParameter(':model',$model)
                ->setMaxResults($limit)
                ->orderBy('o.id', 'ASC')
                ->getQuery()
                ->getResult();
        }

        if($model && $action){
            return $this->repo->createQueryBuilder('o')
                ->select('o.id','o.model','o.action','o.data','o.requestData')
                ->andWhere('o.model = :model')
                ->andWhere('o.action = :action')
                ->setParameter(':model',$model)
                ->setParameter(':action',$action)
                ->setMaxResults($limit)
                ->orderBy('o.id', 'ASC')
                ->getQuery()
                ->getResult();
        }

        return $this->repo->createQueryBuilder('o')
            ->select('o.id','o.model','o.action','o.data','o.requestData')
            ->setMaxResults($limit)
            ->orderBy('o.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function Delete($ids)
    {
//        $this->repo->create
//        $val = $this->em->getConnection()->createQueryBuilder()
//            ->delete('baza_old','o')
//            ->andWhere('o.id IN (:ids)')
//            ->setParameter(':ids', [2,3,4])
//            ->execute();

        $this->repo->createQueryBuilder('o')
            ->delete()
            ->andWhere('o.id IN (:ids)')
            ->setParameter(':ids', $ids)
            ->getQuery()
            ->execute();
    }
}