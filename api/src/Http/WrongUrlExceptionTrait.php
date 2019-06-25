<?php

declare(strict_types=1);

namespace Api\Http;

use Api\Model\Baza;

trait WrongUrlExceptionTrait
{
    private function isModel($model)
    {
        if(!(new Baza())->isModel($model)){
            throw  new \Exception('Model \''.$model.'\' is not found');
        }
    }

    private function isAction($action)
    {
        if(!(new Baza())->isAction($action)){
            throw  new \Exception('Action \''.$action.'\' is not found');
        }
    }
}