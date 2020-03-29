<?php 
namespace VirtualRoom\Repository;

use PDOException;
/**
 * Base class for all Repositories in the app
 */
class baseRepository
{
    /**
     * @var string $error The error code
     */
    protected $error;
    /**
     * @var array $errorDb The error with its code and message
     */
    protected $errorDb;
    /**
     * @var pdoWrapper $pdo The pdo conection
     */
    protected $pdo;
    public function __construct(pdoWrapper $aPdo)
    {
        $this->pdo=$aPdo;
    }
    /**
     * Collect an fill the variables with the error code an the message provided by a PDOException
     * @param PDOException $e An exception caught during the interaction with the database
     * @return void
     */
    protected function fillError(PDOException $e)
    {
        $this->error= $e->getCode();
        $this->errorDb['code']=$e->getCode();
        $this->errorDb['message']=$e->getMessage();
    }
   // private function fillError($e)
   // {
   //     if(strstr($e->getMessage(), 'SQLSTATE[')) {              
   //         $match= preg_match("/SQLSTATE\[(\w+)\]:(.*):(.*)/", $e->getMessage(), $matches);
   //          if($match>0){
    //             $code = ($matches[1] == 'HT000' ? $matches[2] : $matches[1]);
   //              $message = $matches[3];
   //              $this->errorDb=array("message"=>$message,"code"=>$code);
   //          }
   //      }
   // }
    /**
     * Execute a given query with the provided arguments
     * @param string $sql A string of the SQL querry to execute
     * @param array $args [optional] An array with the values for the query
     * @return PDOStatement The result of execute the query
     */
    protected function run(string $sql, array $args=NULL)
    {
        if (!$args)
        {
            return $this->pdo->query($sql);
        }
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    }

    #region errorhandling
    public function hasError()
    {
        return ($this->error!=null?true:false);
    }
    public function hasErrorDb()
    {
        return ($this->errorDb!=null?true:false);        
    }
    public function getError()
    {
        return $this->error;
    }
    public function getErrorDb(string $element=null)
    {
        switch ($element){
            case "code":
            return $this->errorDb["code"];
            case "message":
            return $this->errorDb["message"];
           default:
            return $this->errorDb;
        }        
    }
#endregion
}