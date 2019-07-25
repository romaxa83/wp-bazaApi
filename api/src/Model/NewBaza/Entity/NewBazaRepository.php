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

    public function get($id)
    {
        if($data = $this->repo->find($id)){
            return $data;
        }
        throw new \Exception('Not found data by id '.$id);
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
                ->andWhere('n.status = :status')
                ->setParameter(':model',$model)
                ->setParameter(':status',NewBaza::STATUS_ACTIVE)
                ->getQuery()
                ->getSingleScalarResult();
        }

        if($model && $action){
            return $this->repo->createQueryBuilder('n')
                ->select('COUNT(n.id)')
                ->andWhere('n.model = :model')
                ->andWhere('n.action = :action')
                ->andWhere('n.status = :status')
                ->setParameter(':model',$model)
                ->setParameter(':action',$action)
                ->setParameter(':status',NewBaza::STATUS_ACTIVE)
                ->getQuery()
                ->getSingleScalarResult();
        }

//        $qb = $this->repo->createQueryBuilder('n')
//            ->select('COUNT(n.id)')
//            ->andWhere('n.status = :status')
//            ->setParameter(':status',NewBaza::STATUS_ACTIVE)
//            ->getQuery();
////            ->getSingleScalarResult();
//
//        var_dump($qb->getSQL());die();

        return $this->repo->createQueryBuilder('n')
            ->select('COUNT(n.id)')
            ->andWhere('n.status = :status')
            ->setParameter(':status',NewBaza::STATUS_ACTIVE)
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function GetData($limit, $model = null, $action = null)
    {
        if($model && $action == null){
            return $this->repo->createQueryBuilder('n')
                ->select('n.id','n.model','n.action','n.data','n.request_data')
                ->andWhere('n.model = :model')
                ->andWhere('n.status = :status')
                ->setParameter(':model',$model)
                ->setParameter(':status',NewBaza::STATUS_ACTIVE)
                ->setMaxResults($limit)
                ->orderBy('o.id', 'ASC')
                ->getQuery()
                ->getResult();
        }

        if($model && $action){
            return $this->repo->createQueryBuilder('n')
                ->select('n.id','n.model','n.action','n.data','n.request_data')
                ->andWhere('n.model = :model')
                ->andWhere('n.action = :action')
                ->setParameter(':status',NewBaza::STATUS_ACTIVE)
                ->setParameter(':model',$model)
                ->setParameter(':action',$action)
                ->setParameter(':status',NewBaza::STATUS_ACTIVE)
                ->setMaxResults($limit)
                ->orderBy('o.id', 'ASC')
                ->getQuery()
                ->getResult();
        }

        return $this->repo->createQueryBuilder('n')
            ->select('n.id','n.model','n.action','n.data','n.request_data')
            ->andWhere('n.status = :status')
            ->setParameter(':status',NewBaza::STATUS_ACTIVE)
            ->setMaxResults($limit)
            ->orderBy('o.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

//    public function Delete($ids)
//    {
//        $this->repo->createQueryBuilder('n')
//            ->delete()
//            ->andWhere('n.id IN (:ids)')
//            ->setParameter(':ids', $ids)
//            ->getQuery()
//            ->execute();
//    }

    public function Clear()
    {
        $this->repo->createQueryBuilder('n')
            ->delete()
            ->andWhere('n.status = :status')
            ->setParameter(':status',NewBaza::STATUS_DELETE)
            ->getQuery()
            ->execute();
    }
}