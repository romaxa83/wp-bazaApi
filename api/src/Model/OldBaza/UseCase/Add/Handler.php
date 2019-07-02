<?php

declare(strict_types=1);

namespace Api\Model\OldBaza\UseCase\Add;

use Api\Model\OldBaza\Entity\OldBaza;
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
        $oldBaza = OldBaza::create(
            $command->model,
            $command->action,
            $command->created,
            $command->data,
            $command->requestData
        );
        
        $this->em->persist($oldBaza);

        $this->em->flush();
    }
}