<?php

declare(strict_types=1);

namespace Api\Http\Action\OldBaza;

use Api\Http\WrongUrlExceptionTrait;
use Api\Model\OldBaza\UseCase\Add\Command;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Api\Model\OldBaza\UseCase\Add\Handler;

class AddAction implements RequestHandlerInterface
{
    use WrongUrlExceptionTrait;
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
        $data = $request->getParsedBody();
        $model = $request->getAttribute('model');
        $action = $request->getAttribute('action');
        
        $this->isModel($model);
        $this->isAction($action);

        $command = new Command($model, $action, $data);

        $this->handler->handle($command);

        return new JsonResponse([
            'type' => 'success'
        ],200,[],JSON_PRETTY_PRINT);
    }
}