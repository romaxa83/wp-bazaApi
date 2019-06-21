<?php

declare(strict_types=1);

namespace Api\Http\Action\NewBaza;

use Api\Http\WrongUrlExceptionTrait;
use Api\Model\NewBaza\Entity\NewBazaRepository;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class GetDataAction implements RequestHandlerInterface
{
    use WrongUrlExceptionTrait;

    public const LIMIT = 10;

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
        $limit = self::LIMIT;
        if(($query = $request->getQueryParams()) && array_key_exists('limit',$query)){
            $limit = $query['limit'];
        }
        $model = $request->getAttribute('model');
        $action = $request->getAttribute('action');

        if($model == null && $action == null){
            $data = $this->repo->GetData($limit);
        }

        if($model && $action == null){
            $this->isModel($model);
            $data = $this->repo->GetData($limit,$model);
        }

        if($model && $action){
            $this->isModel($model);
            $this->isAction($action);
            $data = $this->repo->GetData($limit,$model,$action);
        }

        return new JsonResponse([
            'data' => $data
        ],200,[],JSON_PRETTY_PRINT);
    }
}