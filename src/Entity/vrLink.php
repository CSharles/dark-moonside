<?php
class vrLink
{
    protected $Description;
    protected $URL;
    protected $ModuleID;

    public function __construct()
    {
    }
    public function getDescription()
    {
        return $this->Description;
    }
    public function getURL()
    {
        return $this->URL;
    }
    public function getModuleID()
    {
        return $this->ModuleID;
    }
   
    public function toArray()
    {
        $array= [
            'Description'=> $this->getDescription(),
            'URL'=> $this->getURL(),
            'ModuleID'=>$this->getModuleID(),
        ];
        return $array;
    }
    public function setDescription($value)
    {
        $this->Description=$value;
    }
    public function setURL($value)
    {
        $this->URL=$value;
    }
    public function setModuleID($value)
    {
        $this->ModuleID=$value;
    }
}