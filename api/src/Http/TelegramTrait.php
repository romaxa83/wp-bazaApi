<?php

declare(strict_types=1);

namespace Api\Http;

trait TelegramTrait
{
    private function send($message)
    {
        $token = getenv('TELEGRAM_TOKEN');
        $chatId = getenv('CHAT_ID');

        $bot = new \TelegramBot\Api\BotApi($token);

        $bot->sendMessage($chatId,$message);
    }
}