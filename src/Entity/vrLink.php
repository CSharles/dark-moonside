<?php
class vrLink
{
    protected $Description;
    protected $URL;
    protected $ModuleID;
    protected $isActive;
    protected $isExam;

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
    public function isActive()
    {
        return $this->isActive;
    }
    public function isExam()
    {
        return $this->isExam;
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
    public function setActive($value)
    {
        $this->isActive=$value;
    }
    public function setExam($value)
    {
        $this->isExam=$value;
    }
}