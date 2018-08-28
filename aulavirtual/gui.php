<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Plataforma de cursos en linea. Cursos de Inglés, Ofimática, Diseño Gráfico, Diseño Web y más. ">
        <meta name="keywords" content="Inglés,Programación,Santa,Ana,Computación,Diseño,Web,Gráfico,Curso,Niveles,Basico,Intermedio,Avanzado,Office,El,Salvador">
        <meta name="author" content="Csharls">
        <title>englishcomputer - Cursos de Inglés y computación - </title>
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <link href="../css/freelancer.min.css" rel="stylesheet">
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
        <link href='http://fonts.googleapis.com/css?family=Lato:400' rel='stylesheet' type='text/css'>
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <style>
        .img-responsive{
            float:left;
            width: 50px;
            height: 50px;
        }
        </style>
    </head>
    <body id="page-top" class="index">
        <header>
        	<h1 class="hidden">englishcomputer</h1>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <img class="img-responsive" src="../img/profile.png" alt="imagen estudiante">
                        <div class="intro-text">
                            <span class="name">Examenes Activos</span>
                            <hr class="star-light">
                            <span class="name">Guias</span>
                            <hr class="star-light">
                            <?php
                            require __DIR__ ."/vendor/autoload.php";
                            require __DIR__ . "/src/Repository/UserRepository.php";
                             
                            $UserRepo = new vrAdmonRepository();
                            $links=$UserRepo->getLinksByModuleID('GUI101');

                                
                                foreach ($links as $link):?>
                                <p><a href="<?php echo $link->getURL();?>"><?php echo $link->getDescription();?></a></p>
                            <?php endforeach?>
                            <p><a href="https://docs.google.com/document/d/1HBupuGHhVI7f7eC5R8GVkFAuhYyH2gNGKRiI2dyUCac/edit?usp=sharing">GUI - Interfaces de Usuario</a></p>
                            <p><a href="https://docs.google.com/document/d/1ncTNzlQYkZYwK2BoXrzPMTTmMKJYZ0KCPd4cQiIjqCM/edit?usp=sharing">GUI - Múltiples ventanas</a></p>
                            <p><a href="https://docs.google.com/document/d/1_pjFl3EJp5tQ4V10XRVwtbsCZY6EOGQdLuM26QQZRoo/edit?usp=sharing">GUI - Delegados y Eventos</a></p>
                            <p><a href="https://docs.google.com/document/d/1TIHNJ8lcWAXVaDTYCWvZQ2j9If-n8DG1OJgf0UAHNAY/edit?usp=sharing">GUI - Hilos y multihilos</a></p>
                            <p><br/></p>
                            <span class="name">Recursos para prácticas</span>
                            <hr class="star-light">
                            <p><a href="https://www.tutorialspoint.com/compile_csharp_online.php">Compilador de C#</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <nav class="navbar navbar-default navbar-fixed-top">
        	<h2 class="hidden">menú de navegación</h2>
            <div class="container-fluid">
                <div class="navbar-header page-scroll">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Activar navegación</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="..">
                        <img style="max-width:10em; margin-top: -0.45em;"src="../img/logo.svg" alt="Logo de englishcomputer.tk"></a>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="hidden">
                            <a href="#page-top"></a>
                        </li>
                        <li class="page-scroll">
                            <a href="../#portfolio">Cursos</a>
                        </li>
                        <li class="page-scroll">
                            <a href="../#about">Acerca de</a>
                        </li>
                        <!--<li class="page-scroll">
                            <a href="#login">Acceder</a>
                        </li>-->
                        <li class="page-scroll">
                        	<a href="/aulavirtual">
                                <span class="btn-aula">Aula Virtual</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <footer class="text-center">
            <div class="footer-above">
                <div class="container">
                    <div class="row">
                        <div class="footer-col col-md-4">
                            <!--<p><a href="#"><i class="fa fa-lg fa-sign-in"></i> Registrase</a></p>-->
                        </div>
                        <div class="footer-col col-md-4">
                            <span>CURSOS</span>
                            <ul class="list-inline">
                                <li>
                                    <p>Inglés</p>
                                </li>
                                <li>
                                    <p>Computación</p>
                                </li>
                                <li>
                                    <p>Diseño gráfico</p>
                                </li>
                                <li>
                                    <p>Diseño web</p>
                                </li>
                            </ul>            
                        </div>
                        <div class="footer-col col-md-4">
                          <!--  <p><a href="/avirtual/login"><i class="fa fa-lg fa-user"></i> Iniciar Sesión</a></p>-->
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-below">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            Copyright &copy; <span id="year"> </span>  <cite>englishcomputer</cite>  - Admin by <a href="csharlescode.wordpress.com">Csharls</a>.
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <div class="scroll-top page-scroll visible-xs visible-sm">
            <a class="btn btn-primary" href="#page-top">
                <i class="fa fa-chevron-up"></i>
            </a>
        </div>
        <script src="../js/jquery.js"></script>
         <script src="../js/utils.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
        <script src="../js/classie.js"></script>
        <script src="../js/cbpAnimatedHeader.min.js"></script>
        <script src="../js/freelancer.js"></script>
    </body>
</html>