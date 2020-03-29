<body>
<main class="col-md">
        <div class="row">
            <header id="page-header" class="col-12">
                <h1>Editar Perfil de Usuario</h1>
            </header>
        </div>
        <div class="row">
            <aside id="user-resume" class="col-md-3 bk-color-1 px-2">
                <figure class="mt-5 preview">
                        <img src="<?php echo $user->getProfilePic(); ?>" class="figure-img img-fluid rounded" alt="profile picture">
                <figcaption>
                    <form method="post">
                        <label for="avatar" class="badge badge-info">Elige una imagen para tu perfil</label>
                        <input type="file" id="avatar" name="profilePic" accept="image/*">
                        <button type="submit" name="updateProfilePic" class="btn btn-warning btn-sm d-block mx-auto">Guardar</button>
                    </form>
                </figcaption>
                </figure>
                <h2><?php echo $user->getUserName(); ?></h2>
                <h4 class="main-text"><?php echo $user->getRole(); ?></h4>
                <hr>
            </aside>
            <section class="col-md">
                <article id="user-info" class="row align-items-center mx-0 pl-4 bk-color-1">
                    <header class="px-3 my-3 col-md-10">
                        <span class="fas fa-user fa-2x d-inline mr-1" aria-hidden="true"></span>
                        <h3 class="d-inline text-uppercase">Información</h3>
                    </header>
                    <button href="profile.php" class="btn btn-warning btn-sm ml-auto m-3"><i class="fas fa-pencil-alt fa-sm mr-1"></i>Guardar</button>
                    <div class="container">
                        <div class="row">
                            <div class="col-md">
                                <div class="row">
                                    <label for="user-name" class="col-sm-2 badge">Nombre</label>
                                    <input type="text" id="user-name" class="col-sm main-text" placeholder="<?php echo $user->getName(); ?>"></input>
                                </div>
                                <div class="row">
                                    <label for="user-lastname" class="col-sm-2 badge">Apellido</label>
                                    <input type="text" id="user-lastname" class="col-sm main-text" placeholder="<?php echo $user->getLastname(); ?>"></input>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="row">
                                    <label for="user-nickname" class="col-sm-2 badge">Usuario</label>
                                    <input type="text" id="user-nickname" class="col-sm main-text" placeholder="<?php echo $user->getUserName(); ?>"></input>
                                </div>
                                <div class="row">
                                    <label for="user-email" class="col-sm-2 badge">Correo</label>
                                    <input type="email" id="user-email" class="col-sm main-text" placeholder="<?php echo $user->getEmail(); ?>"></input>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            </section>
        </div>
    </main>
</div>
</div>