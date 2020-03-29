<?php
namespace VirtualRoom\Test;

use Exception;
use VirtualRoom\Repository\vrAdminRepository;
use VirtualRoom\Repository\pdoWrapper;
use PHPUnit\Framework\TestCase;


class vrAdminRepositoryTest extends TestCase
{
    public function testInsertAdmin_ReturnTrue()
    {
        $euser=['nick'=>'admin$255',
        'name'=>'Juan',
        'lastn'=>'Serio',
        'pwd'=>'admin331040',
        'role'=>'adm',
        'email'=>"admin@value.com"];

        $repo = new vrAdminRepository(new pdoWrapper());
        $inserted = $repo->insertAdmin($euser);
        
        $this->assertTrue($inserted);
    }

    public function testInsertAdmin_WithWrongData_ReturnFalse()
    {
        $euser=['nick'=>'admin$255',
        'name'=>'Juan',
        'lastn'=>'Serio',
        'pwd'=>'admin331040',
        'role'=>'adm'];

        $repo = new vrAdminRepository(new pdoWrapper());
        try{
            $inserted = $repo->insertAdmin($euser);
        }
        catch(Exception $e){}
        $this->assertFalse($inserted);
    }

/*    public function testInsertAdmin_WithWrongData_ThrowException()
    {
        $euser=['nick'=>'admin$255',
        'name'=>'Juan',
        'lastn'=>'Serio',
        'pwd'=>'admin331040',
        'role'=>'adm'];

        $repo = new vrAdminRepository(new pdoWrapper());
            
            $this->expectException(Exception::class);
            $inserted = $repo->insertAdmin($euser);
    }
*/
}
 ?>