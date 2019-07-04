<?php

declare(strict_types=1);

namespace Api\Http\Action;

use Api\Http\TelegramTrait;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;

class TelegramAction implements RequestHandlerInterface
{
    use TelegramTrait;

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $data = $request->getParsedBody();

        if($this->isError($data) && $this->isMessage($data)){
            $this->send($data['message']);

            return new JsonResponse([
                'type' => 'success'
            ],200,[],JSON_PRETTY_PRINT);

        }

        return new JsonResponse([
            'type' => 'error'
        ],500,[],JSON_PRETTY_PRINT);

    }

    private function isError($data)
    {
        return isset($data['status']) && $data['status'] == 'error';
    }

    private function isMessage($data)
    {
        return isset($data['message']) && !(empty($data['message']));
    }
}