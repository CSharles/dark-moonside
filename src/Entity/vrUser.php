<?php
namespace VirtualRoom\Entity;
class vrUser
{
    protected $id;
    protected $email;
    protected $username;
    protected $firstlogin;
    protected $lastlogin;
    protected $lastname;
    protected $name;
    protected $password;
    protected $role;
    protected $active;
    protected $profilepic;

    public function __construct($id=null)
    {
       $this->id=$id;
    }
#region getters
    public function getId()
    {
        return $this->id;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getUserName()
    {
        return $this->username;
    }
    public function getFirstLogin()
    {
        return $this->firstlogin;
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
    public function isActive()
    {
        return $this->active;
    }
    public function getProfilePic()
    {
        return $this->profilepic;
    }
#endregion
#region setters
public function setId($value)
{
    $this->id=$value;
}
public function setEmail($value)
{
    $this->email=$value;
}
public function setUserName($value)
{
    $this->username=$value;
}
public function setFirstLogin($value)
{
    $this->firstlogin=$value;
}
public function setLastLogin($value)
{
    $this->lastlogin=$value;
}
public function setLastname($value)
{
    $this->lastname=$value;
}
public function setName($value)
{
    $this->name=$value;
}
public function setPassword($value)
{
    $this->password=$value;
}
public function setRole($value)
{
    $this->role=$value;
}
public function setActive(bool $value)
{
    $this->active=$value;
}
public function setProfilePic($value)
{
    $this->profilepic=$value;
}
#endregion
    public function toArray()
    {
        $array= [
            'name'=> $this->getName(),
            'lastname'=> $this->getLastname(),
            'username'=>$this->getUserName(),
            'email'=>$this->getEmail(),
            'firstlogin'=>$this->getFirstLogin(),
            'lastlogin'=>$this->getLastLogin(),
            'password'=>$this->getPassword(),
            'Role'=>$this->getRole(),
            'Profilepic'=>$this->getProfilePic(),
        ];
        return $array;
    }
}