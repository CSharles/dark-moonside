<?php
namespace virtualRoom\Controller\Admon;

use VirtualRoom\Controller\baseController;
use VirtualRoom\Repository\vrUserRepository;
use VirtualRoom\Repository\pdoWrapper;

/**
 * Control the access of a user to the application
 */
class vrLoginController extends baseController
{
	protected $response = false;
	
	public function __construct($db = NULL)
	{
		if ($db == NULL) {
			$db = new pdoWrapper();
		}
		$this->repo = new vrUserRepository($db);
	}
	/**
	 * Control the request for session creation, if a user can log in successfully 
	 * a session will be created.
	 * @param mixed[] $request The data of a user and password to verify in json format.
	 * @return string True if a successful login, 2 if a user login for the first time, 
	 * 3 if does not exist users.
	 */
	public function actionHandler($request = NULL)
	{
		$data=$this->JSONRequestToArray($request['data']);

		if($data){
			if ($this->repo->hasUsers($data['role'])) {
				$user = $data['user'];
				$password = $data['password'];
				$existWhioutLogin = $this->repo->verifyUserFirstLogin($user);

				if ($existWhioutLogin) {
					$userId = $this->setSession($user, $password);

					if ($userId) {
						$this->repo->setFirstLogin($userId);
						$this->response = 2;
					}
				} 
				else {
					$userId = $this->setSession($user, $password);

					if ($userId) {
						$this->response = true;
					}
				}
			} else {
				$_SESSION['setup'] = true;
				$_SESSION['user'] = 0;
				$this->response = 3;
			}
		}

		return  $this->response;
	}
	/**
	 * Stablish the session parametters if a user log in successfully.
	 * @param string $user The user needed to recover the id of a user.
	 * @param string $password The password needed ti recover the id of a user.
	 * @return int The userid if the  user exist.
	 */
	private function setSession($user, $password)
	{
		$issession = false;
		$userId = $this->repo->getUserId($user, $password);
		
		if ($userId) {
			$this->repo->updateLastLogin($userId);
			$_SESSION['user'] = $userId;
			$_SESSION['last_acted_on'] = time();
		}

		return $userId;
	}
	/**
	 * Verify if the JSON request has the information expected and convert it to array
	 * @param array $json The JSON string that need to be analized
	 * @return array Array with the data properly set or false
	 */
	private function JSONRequestToArray(string $json)
	{
		$decoded = json_decode($json, true);
		$decoded  = filter_var_array($decoded, FILTER_SANITIZE_STRING);

		$loginKeys=['user','password','role'];

		return $this->arrayKeysExists($loginKeys,$decoded)? $decoded:false;
	}
}