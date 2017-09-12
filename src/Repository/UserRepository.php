<?php
   require __DIR__ ."/../../vendor/autoload.php";
    use Kreait\Firebase\Factory;
    use Kreait\Firebase\ServiceAccount;
    // use Kreait\Firebase;
    require __DIR__ ."/../Entity/User.php";
class UserRepository
{
    protected $pdo;

    public function __construct() 
    {
        $dbopts = parse_url(getenv('DATABASE_URL'));
        $this->pdo=new Csanquer\Silex\PdoServiceProvider\Provider\PDOServiceProvider('pdo',
        array(
        'pdo.server' => array(
            'driver'   => 'pgsql',
            'user' => $dbopts["user"],
            'password' => $dbopts["pass"],
            'host' => $dbopts["host"],
            'port' => $dbopts["port"],
            'dbname' => ltrim($dbopts["path"],'/')
            )
        ));
    }
    
    public function showUsers()
    {
        $statement = $this->pdo->prepare('SELECT * FROM users');
        $statement->execute();
        $game = $statement->fetchObject('User');
        return $game;
    }

    public function retriveUser($name, $password)
    {
        try {
       
        } catch(Exception $e) {
        
        }
        return $value;
    }

}


