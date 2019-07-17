<?php

declare(strict_types=1);

namespace Api\Http\Action\NewBaza;

use Api\Model\NewBaza\UseCase\Delete\Command;
use Api\Model\NewBaza\UseCase\Delete\Handler;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class DeleteAction implements RequestHandlerInterface
{
    /**
     * @var Handler
     */
    private $handler;

    public function __construct(Handler $handler)
    {
        $this->handler = $handler;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $id = $request->getParsedBody()['id'];
        $command = new Command($id);

        try {
            $this->handler->handle($command);

            return new JsonResponse([
                'type' => 'success'
            ],200,[],JSON_PRETTY_PRINT);
        } catch (\Exception $e) {

            return new JsonResponse([
                'type' => 'error',
                'message' => $e->getMessage()
            ],500,[],JSON_PRETTY_PRINT);
        }
    }
}