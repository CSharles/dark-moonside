<?php
class vrLink
{
    protected $description;
    protected $URL;
    protected $moduleID;

    public function __construct()
    {

    }
    public function getDescription()
    {
        return $this->description;
    }
    public function getURL()
    {
        return $this->URL;
    }
    public function getModuleID()
    {
        return $this->moduleID;
    }
   
    public function toArray()
    {
        $array= [
            'description'=> $this->getDescription(),
            'URL'=> $this->getURL(),
            'moduleID'=>$this->getModuleID(),
        ];
        return $array;
    }
    public function setDescription($value)
    {
        $this->description=$value;
    }
    public function setURL($value)
    {
        $this->URL=$value;
    }
    public function setModuleID($value)
    {
        $this->moduleID=$value;
    }
}