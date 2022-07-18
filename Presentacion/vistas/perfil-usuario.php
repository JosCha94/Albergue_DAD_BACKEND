<?php
switch ($error = 'SinError') {
    case ($logueado == 'false'):
        $error = '<meta http-equiv="refresh" content="0; url=index.php" />';
        break;
    case ($rolActual == ' '):
        $error = 'No tiene ningun rol activado';
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

    if (isset($_POST['btn-delCuenta'])) {
        $userId = $id;

        $elimina = $consulta->eliminar_cuenta($conexion, $userId);
        if ($elimina == 1) {
            echo '<div class="alert alert-danger alert-dismissible fade show " role="alert">
            <strong>Error!</strong> No se pudo cerrar su cuenta ahora, intentelo mas tarde
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        } elseif ($elimina == 2) {
            echo '<div class="alert alert-success alert-dismissible fade show " role="alert">
             Tienes una adopcion vigente y no puedes cerrar tu cuenta hasta que no finalice.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        } elseif ($elimina == 3) {
            echo '<div class="alert alert-success alert-dismissible fade show " role="alert">
         Tienes una solicitud de adopcion en proceso, podras cerrar tu cuenta cuando concluya.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        } elseif ($elimina == 4) {
            echo '<div class="alert alert-success alert-dismissible fade show " role="alert">
     Tienes pedidos sin recoger, recogelos para poder cerrar tu cuenta
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
        } elseif ($elimina == 5) {
            session_destroy();
            echo '<meta http-equiv="refresh" content="0; url=index.php?modulo=inicio&cerrarcuenta=Su cuenta se cerro exitosamente" />';
        }
    }

    ?>
    <h1 class="text-center text-uppercase my-4">HOLA <?php echo ($usuario['usuario']); ?></h1>
    <div class="row my-md-4 ">
        
        <div class="col-12 col-md-4 p-5 shadow-lg  position-relative mx-auto">
            <h3 class="text-center h1 perfil-texto"> Mis Datos</h3>

            <div class="row g-0  flex-md-row mb-4 h-md-250 position-relative">
                <div class="col-auto d-none d-lg-block text-center">
                    <h3 class="mb-0 mt-2"><?php echo ($usuario['usuario']); ?></h3>
                </div>
                <div class="col p-4 mt-2 d-flex flex-column position-static">
                    <!-- <strong class="d-inline-block mb-2 text-white">Nombre: <?php echo ($usuario['usr_nombre']); ?></strong> -->
                    <div class="mb-1 perfil-texto">Nombre: <?php echo ($usuario['usr_nombre']); ?></div>
                    <div class="mb-1 perfil-texto">Apellidos: <?php echo ($usuario['usr_apellido_paterno'] . ' ' . $usuario['usr_apellido_materno']); ?></div>
                    <div class="mb-1 perfil-texto">Celular: <?php echo ($usuario['usr_celular']); ?></div>
                    <div class="mb-1 perfil-texto">E-mail: <?php echo ($usuario['usr_email']); ?></div>
                </div>
                <div class="my-3">
                    <a class="btn btn-adopt w-100 my-4 my-md-2 mx-auto" href="index.php?modulo=update-user&formTipo=dataUser" id="btn-changedata">Cambiar datos</a>
                    <a class="btn btn-adopt w-100 my-2 mx-auto" href="index.php?modulo=update-user&formTipo=passUser" id="btn-changedata">Cambiar contraseña</a>
                    <form method="post" action="">
                        
                        <button class="btn btn-danger w-100 my-2 mx-auto" onclick="return confirm('¿Quieres cerrar tu cuenta de forma definitiva? , todas tus suscripciones se cancelaran aunq no hayan finalizado')" name="btn-delCuenta">Cerrar cuenta</a>
                    </form>
                </div>

            </div>
            <div class="<?php echo ($section != '') ? 'position-absolute bottom-0' : '' ?>">
                <h6 class="usr-date">Fecha de creacion: <span class="h6 ms-5 perfil-texto"><?php echo ($usuario['usr_fecha_creacion']); ?></span></h6>
                <br>
                <h6 class="usr-date">Ultima actualización: <span class="h6 ms-5 perfil-texto"><?php echo ($usuario['usr_fecha_modificacion']); ?></span></h6>

            </div>
        </div>

    </div>
<?php else : ?>
        <div class="alert alert-danger p-5 my-5" role="alert">
            <?php echo $error; ?>
        </div>
<?php endif; ?>