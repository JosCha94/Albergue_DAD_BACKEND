<?php
require_once('BL/consultas_rolesPermisos.php');
$consulta = new Consulta_RolesPermisos();

$formTipo = $_GET['formTipo'] ?? '';

if ($formTipo == 'editRol') :

    if ($_POST['rol_id'] != '') {
        $idEditRol = $_POST['rol_id'];
        $_SESSION['usuario'][5] = $idEditRol;
        $RolID = $consulta->detalleRol($conexion, $idEditRol);
    } else {
        $RolID = $consulta->detalleRol($conexion, $_SESSION['usuario'][5]);
    }
endif;

if ($formTipo == 'editPermiso') :

    if ($_POST['permiso_id'] != '') {
        $idEditPer = $_POST['permiso_id'];
        $_SESSION['usuario'][5] = $idEditPer;
        $PerID = $consulta->detallePermiso($conexion, $idEditPer);
    } else {
        $PerID = $consulta->detallePermiso($conexion, $_SESSION['usuario'][5]);
    }
endif;

if (isset($_POST['btn_update_rol'])) {

    $idRol =  $_SESSION['usuario'][5];
    $rol = $_POST['rolNombre'];
    $rolDescrip = $_POST['rolDescrip'];

    $errores = $consulta->Validar_RolPermiso($rol, $rolDescrip);
    if (count($errores) == 0) {
         $estado = $consulta->update_rol($conexion, $rol, $rolDescrip, $idRol);

        if ($estado == 'fallo') {
        } else {
            echo '<meta http-equiv="refresh" content="0; url=index.php?modulo=rolesPermisos&mensaje=Se actualizo los datos del rol" />';
        }
    }
}

if (isset($_POST['btn_update_per'])) {

    $idPer =  $_SESSION['usuario'][5];
    $permiso = $_POST['perNombre'];
    $perDescrip = $_POST['perDescrip'];

    $errores = $consulta->Validar_RolPermiso($permiso, $perDescrip);
    if (count($errores) == 0) {
         $estado = $consulta->update_permiso($conexion, $permiso, $perDescrip, $idPer);

        if ($estado == 'fallo') {
        } else {
            echo '<meta http-equiv="refresh" content="0; url=index.php?modulo=rolesPermisos&mensaje=Se actualizo los datos del permiso" />';
        }
    }
}
?>
<?php if ($formTipo == 'editRol') : ?>
    <section id="dormRegistro" class="container-fluid mt-5">

        <div class="text-center mb-4">
            <h1 class="fw-bold">Actualizacion del Rol: <br>
                <?php echo $RolID['rol_nombre']; ?> </h1>
        </div>
        <div class="row">
            <div class="col-lg-6 p-4 p-md-5 res-margin bg-secondary bg-opacity-75 h-50 mx-auto">

                <h4 class="text-light">Datos del Rol</h4>

                <!-- Form Starts -->
                <div id="product_form">
                    <form action="" method="post">
                        <?php if (isset($errores)) : ?>
                            <?php if (count($errores) != 0) : ?>
                                <ul class="alert alert-danger mt-3">
                                    <h1>Corregir</h1>
                                    <?php foreach ($errores as  $error) : ?>
                                        <li class="ms-2"><?= $error; ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        <?php endif; ?>
                        <div class="row">
                            <div class="col-md-12 text-light mt-2">
                                <label class="txt_form">Nombre Del Rol </label>
                                <input type="text" name="rolNombre" class="form-control input-field" maxlength="50" value="<?php if (isset($rol)) {echo $rol;} else {echo $RolID['rol_nombre'];} ?>" required>
                            </div>
                            <div class="col-md-12 text-light mt-2">
                                <label class="txt_form">Descripción del Rol </label>
                            </div>
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Escribe una descripcion de la categoria aqui" id="catDescrip" name="rolDescrip" style="height: 100px" required> <?php if (isset($rolDescrip)) {echo $rolDescrip;} else {echo $RolID['rol_descripcion'];} ?></textarea>
                                <label for="catDescrip">Escribe una descripcion del rol aqui</label>
                            </div>
                            <!-- button -->
                            <div class="mt-3 d-flex justify-content-around">
                                <button type="submit" name="btn_update_rol" value="Submit" class="btn btn-adopt my-3">Actualizar</button>
                                <button type="reset" id="submit_btn" value="Submit" class="btn btn-danger my-3 mx-3">Limpiar</button>
                            </div>
                    </form>
                    <!-- /form-group-->
                </div>
            </div>
            <!-- /col-lg-->
        </div>
        <!-- /row-->
    </section>
    <!-- /section-->
<?php elseif ($formTipo == 'editPermiso') : ?>
    <div class="container-fluid mt-5">

        <div class="text-center mb-4">
            <h1 class="fw-bold">Actualizacion de Permiso: <br>
                <?php echo $PerID['permiso_nombre'] ?> </h1>
        </div>
        <div class="row">

            <div class="col-lg-6 p-4 p-md-5 res-margin bg-secondary bg-opacity-75 h-50 mx-auto">

                <h4 class="text-light">Datos del Permiso</h4>

                <!-- Form Starts -->
                <div id="product_form">
                    <form action="" method="post">
                        <?php if (isset($errores)) : ?>
                            <?php if (count($errores) != 0) : ?>
                                <ul class="alert alert-danger mt-3">
                                    <h1>Corregir</h1>
                                    <?php foreach ($errores as  $error) : ?>
                                        <li class="ms-2"><?= $error; ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        <?php endif; ?>
                        <div class="row">
                            <div class="col-md-12 text-light mt-2">
                                <label class="txt_form">Nombre Permiso </label>
                                <input type="text" name="perNombre" class="form-control input-field" maxlength="50" minlength="4" value="<?php if (isset($permiso)) {echo $permiso;} else {echo $PerID['permiso_nombre'];} ?>" required>
                            </div>
                            <div class="col-md-12 text-light mt-2">
                                <label class="txt_form">Descripción del Permiso </label>
                            </div>
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Escribe una descripcion de la categoria aqui" id="catDescrip" name="perDescrip" style="height: 100px" required> <?php if (isset($perDescrip)) {echo $perDescrip;} else {echo $PerID['permiso_descripcion'];} ?></textarea>
                                <label for="catDescrip">Escribe una descripcion para el permiso</label>
                            </div>

                            <!-- button -->
                            <div class="mt-3 d-flex justify-content-around">
                                <button type="submit" name="btn_update_per" value="Submit" class="btn btn-adopt my-3">Actualizar</button>
                                <button type="reset" id="submit_btn" value="Submit" class="btn btn-danger my-3 mx-3">Limpiar</button>
                            </div>

                    </form>
                    <!-- /form-group-->
                </div>
            </div>
            <!-- /col-lg-->
        </div>

        <!-- /row-->
    </div>

<?php endif; ?>