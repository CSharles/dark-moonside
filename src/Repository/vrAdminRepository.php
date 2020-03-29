<?php
namespace VirtualRoom\Repository;

use Exception;
use PDOException;
use VirtualRoom\Repository\vrUserRepository;

/**
 * The class that represent the access to the database 
 * exclusive of the admin side of the application
 */
class vrAdminRepository extends vrUserRepository
{
    /**
     * Insert an Admin user with the nickname, password, name, lastname, status,
     * rol and email in the database.
     * @param array $adminData An array containing all the data for the admin
     * @return bool True if the admin is inserted correctly
     * @throws Exeption When the data in the array is not complete or correct
     */
    public function insertAdmin(array $adminData)
    {
        $count=0;
        $sql='INSERT INTO admon."vrUser" ("username", "password", "name", "lastname","active","role","email")
        VALUES(:un,:pwd,:nam,:lastn,:active,:rl,:email)';

        try {
            $args=[$adminData['nick'],
            password_hash($adminData['pwd'],PASSWORD_DEFAULT),
            $adminData['name'],
            $adminData['lastn'],
            isset($adminData['active'])?$adminData['active']:1,
            $adminData['role'],
            $adminData['email']];
            $count=$this->run($sql,$args)->rowCount();
        } catch (PDOException $e) {
            $this->fillError($e);
        } catch (Exception $e){
            throw new Exception($e->getMessage(),$e->getCode());
        }
        finally{
            return $count>0?true:false;
        }
    }
}