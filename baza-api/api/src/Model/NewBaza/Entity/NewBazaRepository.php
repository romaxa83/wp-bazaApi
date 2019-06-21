<?php

namespace Api\Model\NewBaza\Entity;

use Doctrine\ORM\EntityManagerInterface;

class NewBazaRepository
{
    /**
     * @var \Doctrine\ORM\EntityRepository
     */
    private $em;
    private $repo;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->repo = $em->getRepository(NewBaza::class);
    }

    /**
     * @return mixed
     */
    public function CountData($model = null, $action = null)
    {
        if($model && $action == null){
            return $this->repo->createQueryBuilder('n')
                ->select('COUNT(n.id)')
                ->andWhere('n.model = :model')
                ->setParameter(':model',$model)
                ->getQuery()
                ->getSingleScalarResult();
        }

        if($model && $action){
            return $this->repo->createQueryBuilder('n')
                ->select('COUNT(n.id)')
                ->andWhere('n.model = :model')
                ->andWhere('n.action = :action')
                ->setParameter(':model',$model)
                ->setParameter(':action',$action)
                ->getQuery()
                ->getSingleScalarResult();
        }

        return $this->repo->createQueryBuilder('n')
            ->select('COUNT(n.id)')
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function GetData($limit, $model = null, $action = null)
    {
        if($model && $action == null){
            return $this->repo->createQueryBuilder('n')
                ->select('n.id','n.model','n.action','n.data')
                ->andWhere('n.model = :model')
                ->setParameter(':model',$model)
                ->setMaxResults($limit)
                ->getQuery()
                ->getResult();
        }

        if($model && $action){
            return $this->repo->createQueryBuilder('n')
                ->select('n.id','n.model','n.action','n.data')
                ->andWhere('n.model = :model')
                ->andWhere('n.action = :action')
                ->setParameter(':model',$model)
                ->setParameter(':action',$action)
                ->setMaxResults($limit)
                ->getQuery()
                ->getResult();
        }

        return $this->repo->createQueryBuilder('n')
            ->select('n.id','n.model','n.action','n.data')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    public function Delete($ids)
    {
        $val = $this->em->getConnection()->createQueryBuilder()
            ->delete('baza_new','n')
            ->andWhere('n.id IN (:ids)')
            ->setParameter(':ids', $ids)
            ->execute();
    }
}