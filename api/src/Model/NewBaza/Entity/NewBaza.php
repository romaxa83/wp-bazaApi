<?php

namespace Api\Model\NewBaza\Entity;

use Api\Model\Baza;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="baza_new")
 */
class NewBaza extends Baza
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string",length=20)
     */
    private $action;

    /**
     * @ORM\Column(type="string",length=20)
     */
    private $model;

    /**
     * @ORM\Column(type="integer")
     */
    private $created;

    /**
     * @ORM\Column(type="json")
     */
    private $data;

    /**
     * @ORM\Column(type="json", name="request_data")
     */
    private $requestData;

    /**
     * @ORM\Column(type="smallint", name="status", options={"default:1"})
     */
    private $status;

    public static function create(
        $model,
        $action,
        $time,
        $data,
        $requestData
    ): self
    {
        $baza = new self();
        $baza->model = $model;
        $baza->action = $action;
        $baza->created = $time;
        $baza->data = $data;
        $baza->requestData = $requestData;
        $baza->status = self::STATUS_ACTIVE;

        return $baza;
    }

    public function changeStatus()
    {
        if($this->isActive()) {
            $this->status = self::STATUS_DELETE;
        }

        throw new \Exception('Status delete is already');
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param mixed $action
     */
    public function setAction($action)
    {
        $this->action = $action;
    }

    /**
     * @return mixed
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param mixed $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param mixed $model
     */
    public function setModel($model)
    {
        $this->model = $model;
    }

    /**
     * @return mixed
     */
    public function getRequestData()
    {
        return $this->requestData;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function isActive(): bool
    {
        return $this->status === self::STATUS_ACTIVE;
    }

    public function isDelete(): bool
    {
        return $this->status === self::STATUS_DELETE;
    }
}