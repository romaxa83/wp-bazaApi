<?php

declare(strict_types=1);

namespace Api\Model\OldBaza\UseCase\Delete;

use Api\Model\OldBaza\Entity\OldBazaRepository;
use Doctrine\ORM\EntityManagerInterface;

class Handler
{
    private $em;
    /**
     * @var OldBazaRepository
     */
    private $repo;

    public function __construct(EntityManagerInterface $em,OldBazaRepository $repo)
    {
        $this->em = $em;
        $this->repo = $repo;
    }

    public function handle(Command $command): void
    {
        $oldBaza = $this->repo->get($command->id);
        $oldBaza->changeStatus();

        $this->em->persist($oldBaza);

        $this->em->flush();
    }
}