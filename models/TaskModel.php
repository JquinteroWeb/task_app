<?php


class Task
{
    
    private $name;
    private $status;
    private $description;  

    public function __construct($name, $status, $description)
    {
        $this->name = $name;
        $this->status = $status;
        $this->description = $description;
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

    public function setStatus($status)
    {
        $this->status = $status;
    }
}
