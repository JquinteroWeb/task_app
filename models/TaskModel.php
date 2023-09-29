<?php 


class Task
{
    private $uid;
    private $name;
    private $status;
    private $description;
    private $dateCreated;

    public function __construct($uid, $name, $status, $description, $dateCreated)
    {
        $this->uid = $uid;
        $this->name = $name;
        $this->status = $status;
        $this->description = $description;
        $this->dateCreated = $dateCreated;
    }   

    public function getUid()
    {
        return $this->uid;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function jsonSerialize()
    {
        return [
            'uid' => $this->uid,
            'name' => $this->name,
            'status' => $this->status,
            'description' => $this->description,
            'dateCreated' => $this->dateCreated
        ];
    }
    
}
