<?php

declare(strict_types=1);

use Api\Http\Action;
use Api\Http\Middleware;
use Api\Http\Validator\Validator;
use Api\Model\NewBaza\Entity\NewBazaRepository;
use Api\Model\OldBaza\Entity\OldBazaRepository;
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

    Action\TelegramAction::class => function () {
        return new Action\TelegramAction();
    },


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
            $container->get(Api\Model\NewBaza\UseCase\Delete\Handler::class)
        );
    },

    Action\NewBaza\ClearAction::class => function(ContainerInterface $container) {
        return new Action\NewBaza\ClearAction(
            $container->get(NewBazaRepository::class)
        );
    },

    Action\OldBaza\AddAction::class => function(ContainerInterface $container) {
        return new Action\OldBaza\AddAction(
            $container->get(Api\Model\OldBaza\UseCase\Add\Handler::class)
        );
    },

    Action\OldBaza\CheckAction::class => function(ContainerInterface $container) {
        return new Action\OldBaza\CheckAction(
            $container->get(OldBazaRepository::class)
        );
    },

    Action\OldBaza\GetDataAction::class => function(ContainerInterface $container) {
        return new Action\OldBaza\GetDataAction(
            $container->get(OldBazaRepository::class)
        );
    },

    Action\OldBaza\DeleteAction::class => function(ContainerInterface $container) {
        return new Action\OldBaza\DeleteAction(
            $container->get(Api\Model\OldBaza\UseCase\Delete\Handler::class)
        );
    },

    Action\OldBaza\ClearAction::class => function(ContainerInterface $container) {
        return new Action\OldBaza\ClearAction(
            $container->get(OldBazaRepository::class)
        );
    },
];