<?php

declare(strict_types=1);

namespace Api\Model\OldBaza\UseCase\Delete;

use Symfony\Component\Validator\Constraints as Assert;

class Command
{
    /**
     * @Assert\NotBlank()
     */
    public $id;

    public function __construct($id)
    {
        $this->id = $id;
    }
}