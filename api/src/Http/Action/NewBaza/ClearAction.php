<?php

declare(strict_types=1);

namespace Api\Http\Action\NewBaza;

use Api\Model\NewBaza\Entity\NewBazaRepository;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ClearAction implements RequestHandlerInterface
{
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
        $this->repo->clear();

        return new JsonResponse([],200);
    }
}