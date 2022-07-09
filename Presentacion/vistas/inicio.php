<?php
switch ($error = 'SinError') {
    case ($conexion  == 'fallo'):
        $error = 'No se puede establecer una conexión con el servidor ya que el equipo de destino denegó expresamente dicha conexión';
        break;
}
?>
<?php if ($error == 'SinError') : ?>
<?php if ($logueado == null || $logueado == 'false') {
?>
    <div class="container w-50 mt-4 mb-4">
        <main class="form-signin">
            <form action="BL/valida_user.php" method="post">

                <h1 class="h3 mb-3 fw-normal text-center">Bienvenido</h1>

                <div class="form-floating">
                    <input type="text" class="form-control mb-3" id="user" name="user" placeholder="Correo electronico o numero de celular">
                    <label for="floatingInput">Correo electronico o numero de celular</label>
                </div>
                <div class="form-floating">
                    <input type="password" class="form-control" id="pass" name="pass" placeholder="Contraseña">
                    <label for="pass">Contraseña</label>
                </div>

                <!-- <div class="checkbox mb-3">
                                <label>
                                    <input type="checkbox" value="remember-me"> Remember me
                                </label>
                            </div> -->
                <button class="w-100 btn btn-login mt-3" type="submit">Iniciar Sesión</button>
                <p class="mt-5 mb-3 text-muted">© 2021–<span class="anio"></p>
            </form>
        </main>
    </div>
<?php
} else {
?>
<h1 class="text-center mt-4 mb-4">Bienvenido <?php echo $info->nick ?></h1>
<?php
}
?>
<?php else : ?>

<div class="alert alert-danger mt-5 mb-5" role="alert">
    <?php echo $error; ?>
</div>

<?php endif; ?>