<?php

declare(strict_types=1);

namespace Api\Model\NewBaza\UseCase\Add;

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

    public $requestData;

    /**
     * @Assert\NotBlank()
     */
    public $created;

    public function __construct($model,$action,$data)
    {
        $this->model = $model;
        $this->action = $action;
        $this->data = $data['data'];
        $this->requestData = $data['requestData'];
        $this->created = time();
    }
}