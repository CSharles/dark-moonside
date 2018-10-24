<?php
class vrModule
{
    protected $Name;
    protected $ModuleID;
    protected $CourseID;
    protected $thumbnail;
    protected $active;
    protected $guides;
    protected $exams;

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
    public function getThumbnail()
    {
        return $this->thumbnail;
    }
    public function isActive()
    {
        return $this->Active;
    } 
    public function getGuides()
    {
        return $this->guides;
    }
    public function getExams()
    {
        return $this->exams;
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
    public function setActive(bool $value)
    {
        $this->Active=$value;
    }
    public function setThumbnail(string $value)
    {
        $this->thumbnail=$value;
    }
    public function setGuides($value)
    {
        $this->guides=$value;
    }
    public function setExams($value)
    {
        $this->exams=$value;
    }
    public function __destruct(){
        unset($this->guides);
        unset($this->exams);
    }
}