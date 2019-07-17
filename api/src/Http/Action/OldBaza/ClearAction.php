<?php

declare(strict_types=1);

namespace Api\Http\Action\OldBaza;

use Api\Model\OldBaza\Entity\OldBazaRepository;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ClearAction implements RequestHandlerInterface
{
    /**
     * @var OldBazaRepository
     */
    private $repo;

    public function __construct(OldBazaRepository $repo)
    {

        $this->repo = $repo;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $this->repo->clear();

        return new JsonResponse([],200);
    }
}