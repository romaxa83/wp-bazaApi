<?php

declare(strict_types=1);

namespace Api\Http\Action\NewBaza;

use Api\Http\TelegramTrait;
use Api\Http\WrongUrlExceptionTrait;
use Api\Model\NewBaza\Entity\NewBazaRepository;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class CheckAction implements RequestHandlerInterface
{
    use WrongUrlExceptionTrait,TelegramTrait;

    /**
     * @var NewBazaRepository
     */
    private $repo;

    public function __construct(NewBazaRepository $repo)
    {
        $this->repo = $repo;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $count = 0;
        $model = $request->getAttribute('model');
        $action = $request->getAttribute('action');

        if($model == null && $action == null){
            $count = $this->repo->CountData();
        }

        if($model && $action == null){
            $this->isModel($model);
            $count = $this->repo->CountData($model);
        }

        if($model && $action){
            $this->isModel($model);
            $this->isAction($action);
            $count = $this->repo->CountData($model,$action);
        }

        return new JsonResponse([
            'count' => $count
        ],200,[],JSON_PRETTY_PRINT);
    }
}