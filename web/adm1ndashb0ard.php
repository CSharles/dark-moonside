<?php
session_start();
require __DIR__ ."/../src/Controller/vrAdmonController.php";
if(!isset($_SESSION["user"])):?>

    <!DOCTYPE html>
    <html lang="ES">
        <head>
            <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
            <link rel="stylesheet" href="../css/admindashboard.css">
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"	integrity="sha256-3edrmyuQ0w65f8gfBsqowzjJe2iM6n0nKciPUp8y+7E="	crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
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
            <aside id="side-panel" class="inline">
                <nav class="nav flex-column bg-dark">
                <p> Menu Control</p>
                    <a class="nav-link text-light" href="#content">Cotenido</a>
                    <a class="nav-link" href="#users">Usuarios</a>
                    <a class="nav-link" href="#analitics">Estadisticas</a>
                </nav> 
            </aside>
            <section id="content" class="inline">
                <article id="courses">
                    <header>
                        <h1>Cursos</h1>
                        <h2>Administrar los cursos</h2>
                        <p>Vista general de los cursos</p>
                    </header>
                    <div id="data" class="inline">
                        <?php echo $controler->getTable();?>
                    </div>
                    <aside class="controls inline">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newCourse">Nuevo curso</button>
                        <button type="button" id="editarCurso" class="btn btn-info" data-toggle="modal" data-target="#newCourse">Editar curso</button>
                        <a href="#" class="btn btn-danger">Eliminar curso</a>
                    </aside>
                    <!-- The Modal -->
                    <div class="modal fade" id="newCourse" tabindex="-1" role="dialog">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                            
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 data-id="modaltitle" class="modal-title">Nuevo curso</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                
                                <!-- Modal body -->
                                <div class="modal-body">
                                    <form action="" method="post">
                                        <div class="form-group">
                                            <label for="course-name">Nombre del curso</label>
                                            <input name="name" id="course-name" value='' placeholder="Nombre del curso" type="text" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label for="course-id">Id del curso</label>
                                            <input name="courseID" id="course-id" value='' placeholder="Id" type="text" class="form-control" />
                                        </div>
                                        <button type="submit" id="add-update" class="btn btn-primary">Agregar</button>
                                    </form>
                                </div>
                                
                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                </div>
                                
                            </div>
                        </div>
                    </div> 
                </article>
                <article id="modules">
                    <header>
                        <h1>Modulos</h1>
                        <p>Administrar los modulos</p>
                    </header>
                    <a href="#" class="btn btn-primary">Nuevo modulo</a>
                    <a href="#" class="btn btn-info">Editar modulo</a>
                    <a href="#" class="btn btn-danger">Eliminar modulo</a>
                </article>
                <article id="guides">
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