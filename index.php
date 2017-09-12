<?php
require __DIR__ . "/src/Repository/UserRepository.php";
$UserRepo = new UserRepository();
$email="car";
$password="admin";
$users=$UserRepo->showUsers();
var_dump($users);
?>
<ul>
    <?php foreach ($users as $user):?>
        <li><span> <?php echo $user["email"];?> </span></li>
    <?php endforeach?>
</ul>