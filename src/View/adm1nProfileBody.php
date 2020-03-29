<body>
    <main class="col-md">
        
        <div class="row">
            <header id="page-header" class="col-12">
                <h1>Perfil de Usuario</h1>
            </header>
        </div>

        <div class="row">

            <aside id="user-resume" class="col-md-3 bk-color-1 px-2">
                <figure class="mt-5">
                    <img src="<?php echo $user->getProfilePic(); ?>" class="figure-img img-fluid rounded" alt="profile picture">
                    <figcaption>
                        <form method="post">
                            <button type="submit" name="editView" class="btn btn-warning btn-sm d-block mx-auto">Cambiar imagen</button>
                        </form>
                    </figcaption>
                </figure>
                <h2><?php echo $user->getUserName(); ?></h2>
                <h4 class="main-text"><?php echo $user->getRole(); ?></h4>
                <hr>
                <div class="d-flex flex-row">
                <label for="last-login" class="badge">Ultimo inicio de sesión</label>
                <p id="last-login" class="main-text"><?php echo $user->getLastLogin(); ?></p>
                </div>
            </aside>

            <section class="col-md">
                <article id="user-info" class="row align-items-center mx-0 pl-4 bk-color-1">
                    <header class="px-3 my-3 col-md-10">
                        <span class="fas fa-user fa-2x d-inline mr-1" aria-hidden="true"></span>
                        <h3 class="d-inline text-uppercase">Información</h3>
                    </header>
                    <form method="post">
                    <button type="submit" name="editView" class="btn btn-warning btn-sm ml-auto m-3"><i class="fas fa-pencil-alt fa-sm mr-1"></i>Editar</button>
                    </form>
                    <div class="container">
                        <div class="row">
                            <div class="col-md">
                                <div class="row">
                                    <label for="user-name" class="col-sm-2 badge">Nombre</label>
                                    <p id="user-name" class="col-sm main-text"><?php echo $user->getName(); ?></p>
                                </div>
                                <div class="row">
                                    <label for="user-lastname" class="col-sm-2 badge">Apellido</label>
                                    <p id="user-lastname" class="col-sm main-text"><?php echo $user->getLastname(); ?></p>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="row">
                                    <label for="user-nickname" class="col-sm-2 badge">Usuario</label>
                                    <p id="user-nickname" class="col-sm main-text"><?php echo $user->getUserName(); ?></p>
                                </div>
                                <div class="row">
                                    <label for="user-email" class="col-sm-2 badge">Correo</label>
                                    <p id="user-email" class="col-sm main-text"><?php echo $user->getEmail(); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
                <article id="user-activity" class="row mx-0 pl-4 bk-color-1">
                    <header class="px-3 my-3 col-md-12">
                    <hr>
                        <span class="fas fa-file-alt fa-2x d-inline mr-1"></span>
                        <h3 class="d-inline text-uppercase">Actividad</h3>
                    </header>
                    <div class="d-inline-flex flex-column justify-content-center m-3">
                        <h4>Cursos </h4>
                        <ul class="fa-ul main-text">
                            <?php
                                if($courses) {
                                    foreach($courses as $c){ 
                                        echo '<li>'.$c["Name"].'</li>';
                                    }
                                }
                                else echo'<p>No has creado cursos</p>';
                            ?>
                        </ul>
                    </div>
                    <div class="d-inline-flex flex-column justify-content-center m-3">
                        <h4>Modulos</h4>
                        <ul class="fa-ul main-text">
                            <?php
                                if($modules) {
                                    foreach($modules as $m){ 
                                        echo '<li>'.$m["Name"].'</li>';
                                    }
                                }
                                else echo'<p>No has creado modulos</p>';
                            ?>
                        </ul>
                    </div>
                    <div class="d-inline-flex flex-column justify-content-center m-3">
                        <h4>Enlaces</h4>
                        <ul class="fa-ul main-text">
                            <?php
                                if($links){
                                    foreach($links as $key => $value){
                                        echo "<li>{$key}</li>";
                                    }
                                }
                                else echo'<p>No has creado enlaces o examenes</p>';
                            ?>
                        </ul>
                    </div>
                </article>
            </section>
        </div>
    </main>
</div>
</div>