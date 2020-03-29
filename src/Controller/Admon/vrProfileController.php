<?php
namespace VirtualRoom\Controller\Admon;

use VirtualRoom\Controller\baseController;
use VirtualRoom\Repository\vrAdminRepository;
use VirtualRoom\Repository\pdoWrapper;

/**
 * Class controller for the Admin profile viw
 * Control the admin creation and the view that need to be displayed
 */
class vrProfileController extends baseController
{
    /**
     * @var bool $generalView Indicates when the general view is active
     */
    private $generalView=true;
    /**
     * @var bool $initialUserView Indicates when the initial user view is active
     */
    private $initialUserView=false;
    /**
     * @var vrUser $user Contains the user data of the actual session
     */
    private $user;
    /**
     * @var array $courses Contains a key/value pair array with the Name
     * and the active status
     */
    private $courses;
    /**
     * @var array $modules Contains a key/value pair array with the Name
     * and the active status
     */    
    private $modules;
    /**
     * @var array $links Contains a key/value pair array with the Description
     * and the active status
     */    
    private $links;
    /**
     * Create an instance of the vrProfileController it use an existing conection 
     * if given otherwise create its own connection.
     * @param $db [Optional] an active instance of the pdoWrapper as conection to 
     * the database
     * @return void
     */
    public function __construct($db=NULL){
        if ($db==NULL) {
            $db= new pdoWrapper();
        }
        $this->repo= new vrAdminRepository($db);
    }
#Region getters
    public function getUser(int $userId)
    {
        if(!$this->user)
            $this->user=$this->repo->getUserbyId($userId);

        return $this->user;
    }
    private function getCoursesData(int $userId){
        if(!$this->courses)
            $this->courses=$this->repo->getCoursesbyUserId($userId);

        return $this->modules;
    }
    private function getLinksData(int $userId){
        if(!$this->links)
        {
            $this->links= $this->repo->getGuidesbyUserId($userId);
            $this->links+= $this->repo->getExamsbyUserId($userId);
        }
        return $this->links;
    }
    private function getModulesData(int $userId){
        if(!$this->modules)
            $this->modules=$this->repo->getModulesbyUserId($userId);

        return $this->modules;
    }
    public function getGeneralView(){
        return $this->generalView;
    }
    public function getInitialUserView(){
        return $this->initialUserView;
    }
#End Region
    /**
     * Verify that the user data is correct and if there are no admin user
     * in order to register an admin user
     * @param array $user The array with the basic info of the admin.
     * @return bool True if the admin is registered corectly.
     */
    public function createAdmin(array $user){
        $userKeys=['nick','pwd','name','lastn','role','email'];
        $userOK=$this->arrayKeysExists($userKeys,$user);
        $created=null;
        if($userOK)
        {
            $usersCount=$this->repo->hasUsers();
            if($usersCount==0){
                $created=$this->repo->insertAdmin($user);
            }
        }
        return !$created?false:true;
    }
    /**
     * Change the corresponding view acording to the request
     * @param array $request Aray of keys indicating which view has the controller to set
     * @return void
     */
    public function actionHandler(array $request)
    {
        if (isset($request['editView']) xor isset($request['registrar'])) 
        {
            $this->generalView=false;
            $this->initialUserView=false;
        }

        if(isset($request['setup']) && isset($request['user'])){
            if($request['user']==0){
                $this->initialUserView=true;
                $this->generalView=false;
            }
        }
    }
    public function renderHeaderAndNav():void
    {
        require_once __DIR__."/../../View/adm1nHeader.php";
        require_once __DIR__."/../../View/adm1nNav.php";
    }
    public function renderFooter():void
    {
        require_once __DIR__."/../../View/adm1nFooter.php";
    }
    public function renderGeneralView(int $userId):void
    {
        $user= $this->getUser($userId);
        $courses= $this->getCoursesData($userId);
        $modules= $this->getModulesData($userId);
        $links=   $this->getLinksData($userId);

        require_once __DIR__."/../../View/adm1nAside.php";
        require_once __DIR__."/../../View/adm1nProfileBody.php";
    }
    public function renderInitialAdminView():void
    {
        require_once __DIR__."/../../View/initialAdm1nProfile.php";
    }
    public function renderEditView(int $userId):void
    {
        $user=$this->getUser($userId);
        require_once __DIR__."/../../View/editAdm1nProfileBody.php";
    }
}