<?php

declare(strict_types=1);

namespace Api\Model\OldBaza\UseCase\Add;

use Symfony\Component\Validator\Constraints as Assert;

class Command
{
    /**
     * @Assert\NotBlank()
     */
    public $action;

    /**
     * @Assert\NotBlank()
     */
    public $model;

    /**
     * @Assert\NotBlank()
     */
    public $data;

    /**
     * @Assert\NotBlank()
     */
    public $created;
    
    /**
     * @Assert\NotBlank()
     */
    public $requestData;

    public function __construct($model,$action,$data,$requestData)
    {
        $this->model = $model;
        $this->action = $action;
        $this->data = $data;
        $this->requestData = $requestData;
        $this->created = time();
    }
}