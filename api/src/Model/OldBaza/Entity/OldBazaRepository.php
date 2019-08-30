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
            return $this->repo->createQueryBuilder('o')
                ->select('COUNT(o.id)')
                ->andWhere('o.model = :model')
                ->andWhere('o.status = :status')
                ->setParameter(':model',$model)
                ->setParameter(':status',OldBaza::STATUS_ACTIVE)
                ->getQuery()
                ->getSingleScalarResult();
        }

        if($model && $action){
            return $this->repo->createQueryBuilder('o')
                ->select('COUNT(o.id)')
                ->andWhere('o.model = :model')
                ->andWhere('o.action = :action')
                ->andWhere('o.status = :status')
                ->setParameter(':model',$model)
                ->setParameter(':action',$action)
                ->setParameter(':status',OldBaza::STATUS_ACTIVE)
                ->getQuery()
                ->getSingleScalarResult();
        }

        return $this->repo->createQueryBuilder('o')
            ->select('COUNT(o.id)')
            ->andWhere('o.status = :status')
            ->setParameter(':status',OldBaza::STATUS_ACTIVE)
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function GetData($limit, $model = null, $action = null)
    {
        if($model && $action == null){
            return $this->repo->createQueryBuilder('o')
                ->select('o.id','o.model','o.action','o.data','o.requestData','o.status')
                ->andWhere('o.model = :model')
                ->andWhere('o.status = :status')
                ->setParameter(':model',$model)
                ->setParameter(':status',OldBaza::STATUS_ACTIVE)
                ->setMaxResults($limit)
                ->orderBy('o.id', 'ASC')
                ->getQuery()
                ->getResult();
        }

        if($model && $action){
            return $this->repo->createQueryBuilder('o')
                ->select('o.id','o.model','o.action','o.data','o.requestData','o.status')
                ->andWhere('o.model = :model')
                ->andWhere('o.action = :action')
                ->andWhere('o.status = :status')
                ->setParameter(':model',$model)
                ->setParameter(':action',$action)
                ->setParameter(':status',OldBaza::STATUS_ACTIVE)
                ->setMaxResults($limit)
                ->orderBy('o.id', 'ASC')
                ->getQuery()
                ->getResult();
        }

        return $this->repo->createQueryBuilder('o')
            ->select('o.id','o.model','o.action','o.data','o.requestData','o.status')
            ->andWhere('o.status = :status')
            ->setParameter(':status',OldBaza::STATUS_ACTIVE)
            ->setMaxResults($limit)
            ->orderBy('o.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

//    public function Delete($ids)
//    {
//        $this->repo->createQueryBuilder('o')
//            ->delete()
//            ->andWhere('o.id IN (:ids)')
//            ->setParameter(':ids', $ids)
//            ->getQuery()
//            ->execute();
//    }

    public function Clear()
    {
        $this->repo->createQueryBuilder('o')
            ->delete()
            ->andWhere('o.status = :status')
            ->andWhere('o.created >= '.strtotime('+3 day', time()))
            ->setParameter(':status',OldBaza::STATUS_DELETE)
            ->getQuery()
            ->execute();
    }
}