<?php
   require __DIR__ ."/../../vendor/autoload.php";
    use Kreait\Firebase\Factory;
    use Kreait\Firebase\ServiceAccount;
    // use Kreait\Firebase;
    require __DIR__ ."/../Entity/User.php";
class UserRepository
{
    private $database;

    public function __construct() 
    {
        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/darkmoonside-15dec-firebase-adminsdk-iu306-174f379fd0.json');
        $firebase = (new Factory)
            ->withServiceAccount($serviceAccount)
            ->create();
        $this->database = $firebase->getDatabase();
    }
    
    public function showUsers()
    {
     $data =$this->database->getReference('user');
     $users = $data->orderByChild('email');
     return $users;
    }

    public function retriveUser($name, $password)
    {
        try {
            $ch = curl_init();
        
            if (FALSE === $ch)
                throw new Exception('failed to initialize');
                
            curl_setopt($ch, CURLOPT_URL, 'https://darkmoonside-15dec.firebaseio.com/user.json?pasword?&email='.$name.'&password='.$password.'');
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);  
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HEADER, false); 
        
            $content = curl_exec($ch);
        
            if (FALSE === $content)
                throw new Exception(curl_error($ch), curl_errno($ch));
        
                $value=$content;
        } catch(Exception $e) {
        
            trigger_error(sprintf(
                'Curl failed with error #%d: %s',
                $e->getCode(), $e->getMessage()),
                E_USER_ERROR);
        
        }
        return $value;
    }

}


