<?php 
class Session
{
    private static  $adapter;
    public static function init(SessionAdapter $ada)
    {
        self::$adapter = $ada;
    }
    public static function get($var)
    {
        return self::$adapter->get($var);
    }
    public static function set($var, $value)
    {
        return self::$adapter->set($var, $value);
    }
}

interface SessionAdapter
{
    public function get($var);
    public function set($var, $value);
}

class PhpSessionAdapter implements SessionAdapter
{
    public function get($var)
    {
        return isset($_SESSION[$var]) ? $_SESSION[$var] : null;
    }
    public function set($var, $value)
    {
        $_SESSION[$var] = $value;
    }
}

class MemorySessionAdapter implements SessionAdapter
{
    private $session = array();
    public function get($var)
    {
        return isset($this->session[$var]) ? $this->session[$var] : null;
    }
    public function set($var, $value)
    {
        $this->session[$var] = $value;
    }
}