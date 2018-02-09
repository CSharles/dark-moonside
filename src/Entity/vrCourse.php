<?php
class vrCourse
{
    protected $Name;
    //protected $imagePath;
    protected $Modules;
    protected $CourseID;
    public function __construct($id=null)
    {
       $this->CourseID=$id;
    }
    public function getCourseID()
    {
        return $this->CourseID;
    }
    public function getModules()
    {
        return $Modules;
    }
    public function getName()
    {
        return $this->Name;
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
    // public function setCourseID($value)
    // {
    //     $this->courseID=$value;
    // }
    // public function getImagePath()
    // {
    //    if ($this->imagePath==null) {
    //        return '/images/placeholder.jpg';
    //    }
    //     return $this->imagePath;
    // }
    // public function setImagePath($value)
    // {
    //     $this->imagePath=$value;
    // }
    public function setModules($value)
    {
        $this->Modules=$value;
    }
}