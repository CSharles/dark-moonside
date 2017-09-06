<?php
class Course
{
    protected $title;
    protected $imagePath;
    protected $linksArray;
    protected $id;
    public function __construct($id=null)
    {
       $this->id=$id;
    }
    public function getId()
    {
        return $this->id;
    }
    public function getLinks()
    {
        return $total/$numRatings;
    }
    public function toArray()
    {
        $array= [
            'title'=> $this->getTitle(),
            'imagePath'=> $this->getImagePath(),
            'links'=>[],
        ];
        foreach ($this->getLinks() as $link) {
            $array['links'][]=$link->toArray();
        }
        return $array;
    }
    public function getTitle()
    {
        return $this->title;
    }
    public function setTitle($value)
    {
        $this->title=$value;
    }
    public function getImagePath()
    {
       if ($this->imagePath==null) {
           return '/images/placeholder.jpg';
       }
        return $this->imagePath;
    }
    public function setImagePath($value)
    {
        $this->imagePath=$value;
    }
    public function addLink($index,$guideLink)
    {
        $this->$linksArray[$index]=$guideLink;
    }
}