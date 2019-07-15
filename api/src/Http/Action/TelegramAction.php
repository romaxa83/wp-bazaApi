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

        if($this->isFull($data,'status') && $this->isFull($data,'message')){
            $this->send($data['message'] . PHP_EOL . $data['status']);

            return new JsonResponse([
                'type' => 'success'
            ],200,[],JSON_PRETTY_PRINT);

        }

        return new JsonResponse([
            'type' => 'error'
        ],500,[],JSON_PRETTY_PRINT);

    }
    
    private function isFull($data,$key)
    {
        return isset($data[$key]) && !(empty($data[$key]));    
    }
}