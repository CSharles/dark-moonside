<?php 
namespace VirtualRoom\Repository;
use \PDO;
/**
 * Class that contain the conection to the database.
 */
class pdoWrapper extends PDO
{
    private $user;
    private $password;
    
    public function __construct($dsn=NULL,$user=NULL,$pass=NULL, $options=[], int $schema=1)
    {
       $dbopts = (parse_url(getenv('DATABASE_URL')?:'postgres://tycmizmiokoysg:fcd6108e8fa43b5e52bc2e304afbcf0c196f9331eeb821b663e6a3c8acf653fb@ec2-184-73-222-192.compute-1.amazonaws.com:5432/df1jk0soq5iv1p'));
       //$dbopts=array("host"=>"localhost","port"=>5432,"path"=>"/virtualroom"); 
       //$this->setSchemaAccess($schema);
       $this->user=$dbopts["user"];
       $this->password=$dbopts["pass"];
        $dsn = 'pgsql:
                host='.$dbopts["host"].';
                port='.$dbopts["port"].';
                dbname='.ltrim($dbopts["path"],"/");
        $default_options = [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ];
        //$options = array_replace($default_options, $options); 
        parent::__construct($dsn,$this->user,$this->password,$default_options);
    }
    private function setSchemaAccess(int $schemaiD){
        if($schemaiD==1){
            $this->user="vrAdmin";
            $this->password="vradmin23";
        }
        if($schemaiD==2){
            $this->user="vrUser";
            $this->password="@#regularuser#@";
        }
    }
}