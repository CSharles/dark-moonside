<?php
session_start();
require __DIR__ ."/../src/Repository/vrAdmonRepository.php";
if(!isset($_SESSION["user"])):?>
    <!DOCTYPE html>
    <html lang="ES">
        <head>
            <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"	integrity="sha256-3edrmyuQ0w65f8gfBsqowzjJe2iM6n0nKciPUp8y+7E="	crossorigin="anonymous"></script>    
            <link rel="stylesheet" href="../css/admindashboard.css">
            <script src="../js/adminDashboard.js"></script>
            <!--[if lt IE 9]>
                <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
                <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
            <![endif]-->
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Englishcomputer - Dashboard - </title>
            <meta name="author" content="Csharls">
        </head>
        <body>
            <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item"><a class="active nav-link" href="#">Cotenido</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Usuarios</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Estadisticas</a></li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a class="nav-link" href="#">Salir</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Mi cuenta</a>
                </ul>
            </nav>
            <aside>
                <nav class="nav flex-column bg-dark">
                <p> Menu Control</p>
                    <a class="nav-link text-light" href="#content">Cotenido</a>
                    <a class="nav-link" href="#users">Usuarios</a>
                    <a class="nav-link" href="#analitics">Estadisticas</a>
                </nav> 
            </aside>
            <section id="content">
                <article>
                    <header>
                        <h1>Cursos</h1>
                        <p>Administrar los cursos</p>
                    </header>
                    <div id="data" class="inline">
                    <table class="table table-striped table-dark table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>Nombre</th>
                                <th>Id</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $repo= new vrAdmonRepository("vrAdmin","vradmin23");
                            if(!$repo->hasError()):
                            $data = $repo->run('select * from admon."vrCourse"');
                            foreach( $data as $course):?>
                            <tr>
                                <td><?php echo $course["Name"] ;?></td>
                                <td><?php echo $course["CourseID"];?></td>
                               
                            </tr>
                            <?php endforeach;
                            else:
                                echo "nada";
                            endif;?>
                        </tbody>
                    </table>    
                    </div>
                        <aside class="controls inline">
                        <a href="#" class="btn btn-primary">Nuevo curso</a>
                        <a href="#" class="btn btn-info">Editar curso</a>
                        <a href="#" class="btn btn-danger">Eliminar curso</a>
                    </aside>
                    
                </article>
                <article>
                    <header>
                        <h1>Modulos</h1>
                        <p>Administrar los modulos</p>
                    </header>
                    <a href="#" class="btn btn-primary">Nuevo modulo</a>
                    <a href="#" class="btn btn-info">Editar modulo</a>
                    <a href="#" class="btn btn-danger">Eliminar modulo</a>
                </article>
                <article>
                    <header>
                        <h1>Guias</h1>
                        <p>Administrar las guias</p>
                    </header>
                    <a href="#" class="btn btn-primary">Nuevo guia</a>
                    <a href="#" class="btn btn-info">Editar guia</a>
                    <a href="#" class="btn btn-danger">Eliminar guia</a>
                </article>
            </section>
            <section id="users" class="occult">
                <article>
                    <header>
                        <h1>Usuarios</h1>
                        <p>Administrar los usuarios</p>
                    </header>
                    <a href="#" class="btn btn-primary">Nuevo usuario</a>
                    <a href="#" class="btn btn-info">Editar usuario</a>
                    <a href="#" class="btn btn-danger">Eliminar usuario</a>
                </article>
                <article>
                    <header>
                        <h1>Lista de usuarios</h1>
                        <p>usuarios registrados</p>
                    </header>
                    <table>
                    </table>
                </article>
            </section>
            <section id="analitics" class="occult">
                <article>
                    <header>
                        <h1>Estadisticas</h1>
                        <p>Graficas</p>
                    </header>
                    <a href="#" class="btn btn-primary">Nuevo usuario</a>
                    <a href="#" class="btn btn-info">Editar usuario</a>
                    <a href="#" class="btn btn-danger">Eliminar usuario</a>
                </article>
                <article>
                    <header>
                        <h1>Lista de usuarios</h1>
                        <p>usuarios registrados</p>
                    </header>
                    <table>
                    </table>
                </article>
            </section>
        </body>
    </html>
<?php else: ?>
    <h1>Sesion no iniciada.</h1>
<?php endif?>