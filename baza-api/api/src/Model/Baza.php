<?php

declare(strict_types=1);

namespace Api\Model;

class Baza
{
    public const ACTION_CREATE = 'create';
    public const ACTION_UPDATE = 'update';
    public const ACTION_DELETE = 'delete';

    public const MODEL_REQUEST = 'request';
    public const MODEL_PRODUCT = 'product';
    public const MODEL_TRANSACTION = 'transaction';

    public function isModel($model): bool
    {
        return self::MODEL_PRODUCT === $model
            || self::MODEL_TRANSACTION === $model
            || self::MODEL_REQUEST === $model;
    }

    public function isAction($action): bool
    {
        return self::ACTION_CREATE === $action
            || self::ACTION_DELETE === $action
            || self::ACTION_UPDATE === $action;
    }
}