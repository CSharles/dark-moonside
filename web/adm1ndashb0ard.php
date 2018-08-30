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
                <?php $controler->getModuleComponent(); ?>
                   

                    <article id="guides" class="row">
                        <header class="row">
                                <h1>Guias</h1>
                                <h2>Administrar las guias</h2>
                                <p>Vista general de las guias</p>
                        </header>
                        <div id="data" class="table-wrapper ">
                            <?php $controler->getLinksTable();?>
                        </div>
                        <aside class="controls ">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newLink">Nuevo enlace</button>
                            <button type="button" class="btn btn-info" id="editarEnlace" data-toggle="modal" data-target="#newLink">Editar enlace</button>
                            <button type="button" class="btn btn-danger" id="eliminarEnlace">Eliminar enlace</button>
                            <form action="" method="post" id="deleteLinkForm" class="d-none">
                                <input name="deleteLink" type="text" value='' />
                            </form>
                        </aside>
                        <!-- The Modal -->
                        <div class="modal fade" id="newCourse" tabindex="-1" role="dialog">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 data-id="modaltitle" class="modal-title">Nuevo enlace</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    
                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <form action="" method="post">
                                            <div class="form-group">
                                                <label for="course-name">Descripcion del enlace</label>
                                                <input name="description" id="link-description" value='' placeholder="Titulo del enlace" type="text" class="form-control" />
                                            </div>
                                            <div class="form-group">
                                                <label for="course-id"> URL del enlace</label>
                                                <input name="linkUrl" id="link-url" value='' placeholder="Id" type="text" class="form-control" />
                                            </div>
                                            <div class="form-group">
                                                <label for="course-id">Modulo al que pertenece</label>
                                                <input name="ModuleId" id="module-id" value='' placeholder="Id" type="text" class="form-control" />
                                            </div>
                                            <button name="sender" type="submit" id="add-update" class="btn btn-primary" value="link">Agregar</button>
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