<?php
class User
{
    protected $email;
    protected $id;
    protected $lastlogin;
    protected $lastname;
    protected $name;
    protected $password;
    protected $role;

    public function __construct($id=null)
    {
       $this->id=$id;
    }
    public function getId()
    {
        return $this->id;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getLastLogin()
    {
        return $this->lastlogin;
    }
    public function getLastname()
    {
        return $this->lastname;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function getRole()
    {
        return $this->role;
    }
    public function toArray()
    {
        $array= [
            'name'=> $this->getName(),
            'lastname'=> $this->getLastname(),
            'email'=>$this->getEmail(),
            'lastlogin'=>$this->getLastLogin(),
            'password'=>$this->getPassword(),
            'Role'=>$this->getRole(),
        ];
        return $array;
    }
    public function setId($value)
    {
        $this->id=$value;
    }
    public function setName($value)
    {
        $this->name=$value;
    }
    public function setLastname($value)
    {
        $this->lastname=$value;
    }
    public function setEmail($value)
    {
        $this->email=$value;
    }
    public function setLastLogin($value)
    {
        $this->lastlogin=$value;
    }
    public function setPassword($value)
    {
        $this->password=$value;
    }
    public function setRole($value)
    {
        $this->role=$value;
    }
}