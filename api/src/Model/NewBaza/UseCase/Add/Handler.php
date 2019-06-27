<?php

declare(strict_types=1);

namespace Api\Model\NewBaza\UseCase\Add;

use Api\Model\NewBaza\Entity\NewBaza;
use Doctrine\ORM\EntityManagerInterface;

class Handler
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function handle(Command $command): void
    {

        $newBaza = NewBaza::create(
            $command->model,
            $command->action,
            $command->created,
            $command->data
        );
//        var_dump($newBaza);die();

        $this->em->persist($newBaza);

        $this->em->flush();
    }
}