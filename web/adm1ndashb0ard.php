<?php
session_start();
require __DIR__ ."/../src/Controller/vrAdmonController.php";
if(isset($_SESSION["user"])):
    require __DIR__ ."/../src/View/adm1nHeader.php";?>
        <body>
            <?php require __DIR__ ."/../src/View/adm1nNav.php"; 
                  require __DIR__ ."/../src/View/adm1nAside.php";  ?>
            <main class="col-md">
                <section id="content" class="row">
                <?php //$controler->getGuideComponent();
               // $controler->getCourseComponent();
               //$controler->getModuleComponent();
                //$controler->getExamComponent(); ?>
                   


                </section>
                <section id="users" class="d-none">
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
                <section id="analitics" class="d-none">
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
            </main>
</div>
</div>
</div>

<?php
 require __DIR__ ."/../src/View/adm1nFooter.php";  
 else: ?>
    <h1>Sesion no iniciada.</h1>
<?php endif?>