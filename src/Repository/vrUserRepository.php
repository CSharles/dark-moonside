<?php
namespace VirtualRoom\Repository;   

use PDO;
use VirtualRoom\Repository\baseRepository;
use VirtualRoom\Entity\vrUser;

/**
 * The class that represent the access to the database 
 * of the user of the application
 */
class vrUserRepository extends baseRepository
{
    public function __construct($db)
    {
        parent::__construct($db);
    } 
#region getters
    /**
     * Atempts to retrive a user from the database using the id provided
     * @param int $id the id of the user 
     * @return vrUser A user with all its values or false.
    */
    public function getUserbyId(int $id){
        $sql= 'SELECT active, email, firstlogin, id, lastlogin, lastname, name, profilepic, role, username 
        FROM admon."vrUser" 
        WHERE id= ? AND active=true';
        $args=[$id];

        return $this->run($sql,$args)->fetchObject(vrUser::class,[$id]);
    }
    /**
     * Atempts to retrive all the guides from the database that match the user id
     * @param int $id the id of the user 
     * @return array All the guides that match the given id or false.
    */
    public function getGuidesbyUserId(int $id){
        $sql= 'SELECT "Description", "Active" 
               FROM admon."vrLink" 
               WHERE "Exam"= false AND "AddedBy"=?';
        $args=[$id];

        $array= $this->run($sql,$args)->fetchAll(PDO::FETCH_KEY_PAIR);

       return  $array?$array:false;
    }
    /**
     * Atempts to retrive all the exams from the database that match the user id
     * @param int $id the id of the user 
     * @return array All the exam that match the given id or false.
    */
    public function getExamsbyUserId(int $id){
        $sql= 'SELECT "Description","Active" 
               FROM admon."vrLink" 
               WHERE "Exam"=true AND "AddedBy"=?;';
        $arg=[$id];

        $array=$this->run($sql,$arg)->fetchAll(PDO::FETCH_KEY_PAIR);

       return  $array?$array:false;
    }
    /**
     * Atempts to retrive all the courses from the database that match the user id
     * @param int $id the id of the user 
     * @return array All the courses that match the given id or false.
    */
    public function getCoursesbyUserId(int $id){
        $sql= 'SELECT "Name", "Active" 
               FROM admon."vrCourse" 
               WHERE "AddedBy"=?';
        $arg=[$id];

        $array=$this->run($sql,$arg)->fetchAll(PDO::FETCH_KEY_PAIR);

       return  $array?$array:false;
    }
    /**
     * Atempts to retrive all the modules from the database that match the user id
     * @param int $id the id of the user 
     * @return array All the modules that match the given id.
    */
    public function getModulesbyUserId(int $id){
        $sql= 'SELECT "Name", "Active" 
               FROM admon."vrModule" 
               WHERE "AddedBy"=?';
        $arg=[$id];

        $array=$this->run($sql,$arg)->fetchALL(PDO::FETCH_KEY_PAIR);

        return $array?$array:false;
    }
    #endregion

#region LoginLogic 
	/**
     * Return the id of the user if a given user and pasword combination match the database
     * @param string $user An username or email.
     * @param string $password The user password.
     * @return int The user id or 0 if user not exist or incorrect.
     */
	public function getUserId(string $user, string $password){
		$id=0;

		$sql= 'SELECT id, password FROM admon."vrUser" WHERE username=:user OR email=:email AND active=true';
		$args=["user"=>$user,"email"=>$user];
		
		$idAndPass= $this->run($sql,$args)->fetch();
		
		if ($idAndPass&&password_verify($password,$idAndPass['password'])) {
				$id=$idAndPass['id'];
		}
		
		return $id;
	}
	
	/**
     * Count the number of users in the backend of the app.
     * @param string $role The role of the user
     * @return int The number of existing users, 0 if empty.
     */
	public function hasUsers(string $role='usr'){
        $usersCount=0;
        $arg=[$role];
		
		$sql='SELECT count(*) FROM admon."vrUser" WHERE active=true AND role=?';
		$usersCount=$this->run($sql,$arg)->fetchColumn();

		return (int)$usersCount;
	}

	/**
     * Updates the last Login date after every succesful log into the app.
     * @param $id The id of the user that has logged in.
	 * @return bool True if the user is updated otherwise false.
     */
	public function updateLastLogin(int $id){
		$time=date('Y/m/d');
		
		$sql = 'UPDATE admon."vrUser" SET lastlogin=:logintime WHERE id=:id';
		$args=['id'=>$id,'logintime'=>$time];

		$updated=$this->run($sql,$args)->rowCount();
		
		return $updated>0?true:false;
	}
    /**
     * Verify if a user exist in the database withoutlogin
     * @param string $user The username or email.
	 * @return bool True if the user never logged in, otherwise false
     */
	public function verifyUserFirstLogin(string $user){
		$exist=false;

		$sql= 'SELECT firstlogin FROM admon."vrUser" 
        WHERE username= :user OR email=:email AND active=true';
		$args=["user"=>$user,"email"=>$user];

		$firstLogin= $this->run($sql,$args)->fetchColumn();

		if($firstLogin== null){
			$exist=true;
		}

		return $exist;
    }
    /**
     * Set the date when the user login for the first time
     * @param int $id The username or email.
	 * @return void
     */
    public function setFirstLogin(int $id):void
    {
		$time=date('Y/m/d');
		
		$sql = 'UPDATE admon."vrUser" SET firstlogin=:logintime WHERE id=:id';
		$args=['id'=>$id,'logintime'=>$time];

		$this->run($sql,$args)->rowCount();
    }
#end region
}