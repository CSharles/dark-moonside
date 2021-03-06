<?php
namespace VirtualRoom\Entity;

class vrCourse
{
    protected $CourseID;
    protected $Name;
    protected $Active;
    protected $AddedBy;
    protected $thumbnail;
    protected $modules;

    public function __construct($id=null)
    {
       $this->CourseID=$id;
    }
    public function getCourseID()
    {
        return $this->CourseID;
    }
    public function getName()
    {
        return $this->Name;
    }
    public function isActive()
    {
        return $this->Active;
    }
    public function getThumbnail()
    {
        return $this->thumbnail;
    }
    public function getModules()
    {
        return $this->modules;
    }
    public function toArray()
    {
        $array= [
            'Name'=> $this->getName(),
            'CourseID'=>$this->getCourseID(),
            //'imagePath'=> $this->getImagePath(),
            'links'=>[],
        ];
        foreach ($this->getLinks() as $link) {
            $array['links'][]=$link->toArray();
        }
        return $array;
    }
    public function setName($value)
    {
        $this->Name=$value;
    }
    public function setActive($value)
    {
        $this->Active=$value;
    }
    public function setModules($value)
    {
        $this->modules=$value;
    }
    public function __destruct(){
        unset($this->modules);
    }

    /**
     * Get the id of the user or admin who added the course
     */ 
    public function getAddedBy()
    {
        return $this->AddedBy;
    }

    /**
     * Set the id of the user or admin who added the course
     *
     */ 
    public function setAddedBy($value)
    {
        $this->AddedBy = $value;
    }
    /**
     * Set the url of the image used for the thumbnail
     *
     */
    public function setThumbnail($value)
    {
        $this->thumbnail=$value;
    }
}