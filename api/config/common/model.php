<?php

declare(strict_types=1);

use Api\Infrastructure;
use Api\Model\Baza;
use Api\Model\NewBaza as NewBaza;
use Api\Model\OldBaza as OldBaza;
use Psr\Container\ContainerInterface;

return [
    NewBaza\UseCase\Add\Handler::class => function(ContainerInterface $container){
        return new NewBaza\UseCase\Add\Handler(
            $container->get(Doctrine\ORM\EntityManagerInterface::class)
        );
    },

    OldBaza\UseCase\Add\Handler::class => function(ContainerInterface $container){
        return new OldBaza\UseCase\Add\Handler(
            $container->get(Doctrine\ORM\EntityManagerInterface::class)
        );
    },

    Baza::class => function(){
        return new Baza();
    },

    NewBaza\Entity\NewBazaRepository::class => function(ContainerInterface $container){
        return new NewBaza\Entity\NewBazaRepository(
            $container->get(Doctrine\ORM\EntityManagerInterface::class)
        );
    },

    OldBaza\Entity\OldBazaRepository::class => function(ContainerInterface $container){
        return new OldBaza\Entity\OldBazaRepository(
            $container->get(Doctrine\ORM\EntityManagerInterface::class)
        );
    },

    'config' => [
        'auth' => [
            'signup_confirm_interval' => 'PT5M',
        ],
    ],
];