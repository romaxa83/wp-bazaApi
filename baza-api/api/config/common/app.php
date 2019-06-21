<?php

declare(strict_types=1);

use Api\Http\Action;
use Api\Http\Middleware;
use Api\Http\Validator\Validator;
use Api\Model\NewBaza\Entity\NewBazaRepository;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Psr\Container\ContainerInterface;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

return [
    ValidatorInterface::class => function () {
        AnnotationRegistry::registerLoader('class_exists');
        return Validation::createValidatorBuilder()
            ->enableAnnotationMapping()
            ->getValidator();
    },
    Validator::class => function (ContainerInterface $container) {
        return new Validator(
            $container->get(ValidatorInterface::class)
        );
    },
    Middleware\BodyParamsMiddleware::class => function () {
        return new Middleware\BodyParamsMiddleware();
    },

    Middleware\DomainExceptionMiddleware::class => function () {
        return new Middleware\DomainExceptionMiddleware();
    },

    Middleware\ValidationExceptionMiddleware::class => function () {
        return new Middleware\ValidationExceptionMiddleware();
    },

    Action\HomeAction::class => function () {
        return new Action\HomeAction();
    },

//    Action\NewBaza\CreateAction::class => function(ContainerInterface $container) {
//        return new Action\NewBaza\CreateAction(
//            $container->get(Api\Model\NewBaza\UseCase\Add\Handler::class)
//        );
//    },

    Action\NewBaza\AddAction::class => function(ContainerInterface $container) {
        return new Action\NewBaza\AddAction(
            $container->get(Api\Model\NewBaza\UseCase\Add\Handler::class)
        );
    },

    Action\NewBaza\CheckAction::class => function(ContainerInterface $container) {
        return new Action\NewBaza\CheckAction(
            $container->get(NewBazaRepository::class)
        );
    },

    Action\NewBaza\GetDataAction::class => function(ContainerInterface $container) {
        return new Action\NewBaza\GetDataAction(
            $container->get(NewBazaRepository::class)
        );
    },

    Action\NewBaza\DeleteAction::class => function(ContainerInterface $container) {
        return new Action\NewBaza\DeleteAction(
            $container->get(NewBazaRepository::class)
        );
    }

];