<?php

declare(strict_types=1);

use Slim\App;
use Api\Http\Action;
use Api\Http\Middleware;
use Psr\Container\ContainerInterface;
use Api\Infrastructure\Framework\Middleware\CallableMiddlewareAdapter as CM;

return function (App $app, ContainerInterface $container)
{
     $app->add(new CM($container, Middleware\BodyParamsMiddleware::class));
     $app->add(new CM($container, Middleware\DomainExceptionMiddleware::class));
     $app->add(new CM($container, Middleware\ValidationExceptionMiddleware::class));

	 $app->get('/',Action\HomeAction::class . ':handle');

	 $app->group('/api',function(){
//	     $this->get('',Action\Test\TestAction::class . ':handle');
//	     $this->post('/create',Action\NewBaza\CreateAction::class . ':handle');
//	     $this->get('/create',Action\NewBaza\CreateAction::class . ':handle');
     });

    $app->group('/api/new-baza',function(){
        $this->get('/check',Action\NewBaza\CheckAction::class . ':handle');
        $this->get('/check/{model}',Action\NewBaza\CheckAction::class . ':handle');
        $this->get('/check/{model}/{action}',Action\NewBaza\CheckAction::class . ':handle');

        $this->get('/get-data',Action\NewBaza\GetDataAction::class . ':handle');
        $this->get('/get-data/{model}',Action\NewBaza\GetDataAction::class . ':handle');
        $this->get('/get-data/{model}/{action}',Action\NewBaza\GetDataAction::class . ':handle');

        $this->post('/delete',Action\NewBaza\DeleteAction::class . ':handle');

        $this->post('/add/{model}/{action}',Action\NewBaza\AddAction::class . ':handle');
    });

};