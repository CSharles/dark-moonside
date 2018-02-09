<?php
class vrModule
{
    protected $Name;
    protected $ModuleID;
    protected $CourseID;

    public function __construct()
    {
    }
    public function getName()
    {
        return $this->Name;
    }
    public function getCourseID()
    {
        return $this->CourseID;
    }
    public function getModuleID()
    {
        return $this->ModuleID;
    }  
    public function toArray()
    {
        $array= [
            'Name'=> $this->getName(),
            'ModuleID'=> $this->getModuleID(),
            'CourseID'=>$this->getCourseID(),
        ];
        return $array;
    }
    public function setName($value)
    {
        $this->Name=$value;
    }
    public function setModuleID($value)
    {
        $this->ModuleID=$value;
    }
    public function setCourseID($value)
    {
        $this->CourseID=$value;
    }
}