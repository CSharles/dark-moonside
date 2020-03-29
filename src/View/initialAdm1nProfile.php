<body>
<script type="text/javascript" src="../js/zxcvbn.js"></script>
    <main class="col-md">
        <div class="row">
            <header id="page-header" class="col-12">
                <h1>Configurar primer administrador</h1>
            </header>
            <div class="col">
                    <h2 class="text-white">Crear cuenta</h2>
                    <form action="#" method="post" class="w-25 mx-auto">
                        <div class="form-group">
                            <legend class="text-white" >Datos de usuario</legend>
                            <input type="text" class="form-control" Name="username" placeholder="NOMBRE DE USUARIO" required>
                            <input type="email" class="form-control"  Name="email" placeholder="CORREO" required>
                        </div>
                        <div class="form-group">
                            <legend class="text-white">contraseña</legend>
                            <input type="password" class="form-control"  Name="password" placeholder="PASSWORD" required>
                            <input type="password" class="form-control" Name="confirmation" placeholder="CONFIRMAR PASSWORD" required>
                        </div>
                        <fieldset>
                            <input type="text" id="reg" Name="registrar" class="d-none">
                            <button type="submit" class="btn btn-primary">Registrar</button>
                        </fieldset>
                    </form>
            </div>
        </div>
    </main>
