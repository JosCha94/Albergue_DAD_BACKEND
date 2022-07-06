<?php
switch ($error = 'SinError') {
    case ($logueado == 'false'):
        $error = 'Debe iniciar sesión para poder visualizar este pagina';
        break;
    case ($rolActi != 'true'):
        $error = 'No tiene activado el rol de Cliente';
        break;
}
?>
<?php if ($error == 'SinError') : ?>
    <?php
    require_once('BL/consultas_usuario.php');
    require_once 'ENTIDADES/usuario.php';
    // require_once('DAL/conexion.php');
    // $conexion = conexion::conectar();
    $consulta = new Consulta_usuario();

    $id = $_SESSION['usuario'][0];
    $usuario = $consulta->detalleUsuario($conexion, $id);

    ?>
    <h1 class="text-center my-4">HOLA <?php echo ($usuario['usuario']); ?></h1>
    <div class="row my-md-4 ">
        
        <div class="col-12 col-md-4 bg-orange p-3 position-relative mx-auto">
            <h3 class="text-center text-success h1"> Mis Datos</h3>

            <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                <div class="col-auto d-none d-lg-block">
                    <img class="img-circle mx-5 mt-3" src="Presentacion\libs\images\perrito_adopt.jpg" width="250" height="250" alt="">
                    <h3 class="mb-0 text-center text-success  mt-2"><?php echo ($usuario['usuario']); ?></h3>
                </div>
                <div class="col p-4 mt-2 d-flex flex-column position-static">
                    <!-- <strong class="d-inline-block mb-2 text-white">Nombre: <?php echo ($usuario['usr_nombre']); ?></strong> -->
                    <div class="mb-1 text-white">Nombre: <?php echo ($usuario['usr_nombre']); ?></div>
                    <div class="mb-1 text-white">Apellidos: <?php echo ($usuario['usr_apellido_paterno'] . ' ' . $usuario['usr_apellido_materno']); ?></div>
                    <div class="mb-1 text-white">Celular: <?php echo ($usuario['usr_celular']); ?></div>
                    <div class="mb-1 text-white">E-mail: <?php echo ($usuario['usr_email']); ?></div>
                </div>
                <div class="my-3">
                    <a class="btn btn-success w-100 my-4 my-md-2 mx-auto" href="index.php?modulo=update-user&formTipo=dataUser" id="btn-changedata">Cambiar datos</a>
                    <a class="btn btn-success w-100 my-2 mx-auto" href="index.php?modulo=update-user&formTipo=passUser" id="btn-changedata">Cambiar contraseña</a>
                </div>

            </div>
            <div class="<?php echo ($section != '') ? 'position-absolute bottom-0' : '' ?>">
                <h6 class="text-success">Fecha de creacion: <span class="h6 text-light"><?php echo ($usuario['usr_fecha_creacion']); ?></span></h6>
                <br>
                <h6 class="text-success">Ultima actualización: <span class="h6 text-light"><?php echo ($usuario['usr_fecha_modificacion']); ?></span></h6>

            </div>
        </div>

    </div>
<?php else : ?>

    <div class="alert alert-danger" role="alert">
        <?php echo $error; ?>
    </div>

<?php endif; ?>