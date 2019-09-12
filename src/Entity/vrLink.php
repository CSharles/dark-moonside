<?php
namespace VirtualRoom\Entity;
class vrLink
{
    protected $Description;
    protected $URL;
    protected $ModuleID;
    protected $Active;
    protected $Exam;
    protected $AddedBy;

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
        return $this->Active;
    }
    public function isExam()
    {
        return $this->Exam;
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
        $this->Active=$value;
    }
    public function setExam($value)
    {
        $this->Exam=$value;
    }

    /**
     * Get the id of the user admin who add the link
     */ 
    public function getAddedBy()
    {
        return $this->AddedBy;
    }

    /**
     * Set the id of the user admin who add the link
     *
     */ 
    public function setAddedBy($value)
    {
        $this->AddedBy = $value;
    }
}