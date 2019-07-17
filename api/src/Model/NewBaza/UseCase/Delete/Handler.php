<?php

declare(strict_types=1);

namespace Api\Model\NewBaza\UseCase\Delete;

use Api\Model\NewBaza\Entity\NewBazaRepository;
use Doctrine\ORM\EntityManagerInterface;

class Handler
{
    private $em;
    /**
     * @var NewBazaRepository
     */
    private $repo;

    public function __construct(EntityManagerInterface $em,NewBazaRepository $repo)
    {
        $this->em = $em;
        $this->repo = $repo;
    }

    public function handle(Command $command): void
    {
        $newBaza = $this->repo->get($command->id);
        $newBaza->changeStatus();

        $this->em->persist($newBaza);

        $this->em->flush();
    }
}