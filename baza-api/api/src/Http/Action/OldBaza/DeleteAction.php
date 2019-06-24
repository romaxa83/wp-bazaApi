<?php

declare(strict_types=1);

namespace Api\Http\Action\OldBaza;

use Api\Model\OldBaza\Entity\OldBazaRepository;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class DeleteAction implements RequestHandlerInterface
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
        $data = $request->getParsedBody();

        $this->repo->Delete($data);

        return new JsonResponse([
            'type' => 'success',
            'data' => $data
        ],200,[],JSON_PRETTY_PRINT);
    }
}