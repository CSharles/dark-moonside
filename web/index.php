<?php
 //require __DIR__ . "/src/Repository/UserRepository.php";
// $UserRepo = new UserRepository();
// $email="car";
// $password="admin";
// $users=$UserRepo->showUsers();
// var_dump($users);
//require __DIR__ ."/vendor/autoload.php";

//$app = new Silex\Application();
//$app['debug'] = true;
//$dbopts = parse_url(getenv('DATABASE_URL'));
// $app->register(new Csanquer\Silex\PdoServiceProvider\Provider\PDOServiceProvider('pdo'),
//                array(
//                 'pdo.server' => array(
//                    'driver'   => 'pgsql',
//                    'user' => $dbopts["user"],
//                    'password' => $dbopts["pass"],
//                    'host' => $dbopts["host"],
//                    'port' => $dbopts["port"],
//                    'dbname' => ltrim($dbopts["path"],'/')
//                    )
//                )
// );
//In the same file, add a new handler to query the database:

// $app->get('/db/', function() use($app) {
//   $st = $app['pdo']->prepare('SELECT name FROM test_table');
//   $st->execute();

//   $names = array();
//   while ($row = $st->fetch(PDO::FETCH_ASSOC)) {
//     $app['monolog']->addDebug('Row ' . $row['name']);
//     $names[] = $row;
//   }

//   return $app['twig']->render('database.twig', array(
//     'names' => $names
//   ));
// });
// $app->run();


//require_once("vrAdmin.php");

 //nombre base de datos
 
  
  $dbh;

$dsn = "pgsql:host=$host;port=5432;dbname=$db;user=$user;password=$pass";
 
try{
	// create a PostgreSQL database connection
	$conn = new PDO($dsn);
}catch (PDOException $e){
	// report error message
	echo $e->getMessage();
}
 ?>



 
