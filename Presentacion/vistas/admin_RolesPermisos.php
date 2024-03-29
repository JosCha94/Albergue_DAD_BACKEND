<?php
$rolPermitido = $log->activeRol($_SESSION['usuario'][2], $RolPermisos);
// $permisosRol = $log->activeRolPermi($_SESSION['usuario'][3], [9]);
// $permisoEsp = $log->permisosEspeciales($_SESSION['usuario'][4], [9]);

switch ($error = 'SinError') {
    case ($logueado == 'false'):
        $error = '<meta http-equiv="refresh" content="0; url=index.php" />';
        break;
    case ($rolPermitido != 'true'):
        $error = 'Su rol actual no le otorga permisos para acceder a esta página';
        break;
}
if ($error == 'SinError') : ?>
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

        $OldRol =  $_POST['oldname'];
        $OldrolDescrip = $_POST['olddescrip'];
        $idRol =  $_SESSION['usuario'][5];
        $rol = $_POST['rolNombre'];
        $rolDescrip = $_POST['rolDescrip'];

        $errores = $consulta->Validar_RolPermiso($rol, $rolDescrip);
        if (count($errores) == 0) {
            $estado = $consulta->update_rol($conexion, $OldRol, $OldrolDescrip, $rol, $rolDescrip, $idRol);

            if ($estado == 1) {
    ?>
                <div class="alert alert-danger alert-dismissible fade show " role="alert">
                    <strong class="fs-3">Error!</strong><br> Ya existe un rol con ese nombre, ingrese otro
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php
            } elseif ($estado == 2) {
            ?>
                <div class="alert alert-danger alert-dismissible fade show " role="alert">
                    <strong class="fs-3">Error!</strong><br>Debido a un problema no se ha podido actualizar los datos del rol, intentelo mas tarde
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php
            } elseif ($estado == 3) {
                echo "<meta http-equiv='refresh' content='5';>";
            ?>
                <div class="alert alert-danger alert-dismissible fade show " role="alert">
                    <strong class="fs-3">Error!</strong><br>Este rol se ha actualizado hace poco, refresque la pagina y vuelva a intentarlo o espere 30 segundos
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php
            } elseif ($estado == 4) {
                echo '<meta http-equiv="refresh" content="0; url=index.php?modulo=rolesPermisos&mensaje=Se actualizo los datos del rol" />';
            }
        }
    }

    if (isset($_POST['btn_update_per'])) {

        $Oldpermiso =  $_POST['oldname'];
        $OldperDescrip = $_POST['olddescrip'];
        $idPer =  $_SESSION['usuario'][5];
        $permiso = $_POST['perNombre'];
        $perDescrip = $_POST['perDescrip'];

        $errores = $consulta->Validar_RolPermiso($permiso, $perDescrip);
        if (count($errores) == 0) {
            $estado = $consulta->update_permiso($conexion, $Oldpermiso, $OldperDescrip, $permiso, $perDescrip, $idPer);

            if ($estado == 1) {
            ?>
                <div class="alert alert-danger alert-dismissible fade show " role="alert">
                    <strong class="fs-3">Error!</strong><br> Ya existe un permiso con ese nombre, ingrese otro
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php
            } elseif ($estado == 2) {
            ?>
                <div class="alert alert-danger alert-dismissible fade show " role="alert">
                    <strong class="fs-3">Error!</strong><br>Debido a un problema no se ha podido actualizar los datos del permiso, intentelo mas tarde
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php
            } elseif ($estado == 3) {
                // echo "<meta http-equiv='refresh' content='5';>";
            ?>
                <div class="alert alert-danger alert-dismissible fade show " role="alert">
                    <strong class="fs-3">Error!</strong><br>Este permiso se ha actualizado hace poco, refresque la pantalla y vielva a intentarlo 
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
    <?php
            } elseif ($estado == 4) {
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
                                    <input type="text" name="rolNombre" class="form-control input-field" maxlength="50" value="<?php if (isset($rol)) { echo $rol; } else { echo $RolID['rol_nombre']; } ?>" required>
                                </div>
                                <div class="col-md-12 text-light mt-2">
                                    <label class="txt_form">Descripción del Rol </label>
                                </div>
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Escribe una descripcion de la categoria aqui" id="catDescrip" name="rolDescrip" style="height: 100px" required> <?php if (isset($rolDescrip)) {echo $rolDescrip; } else { echo $RolID['rol_descripcion']; } ?>
                                </textarea>
                                    <label for="catDescrip">Escribe una descripcion del rol aqui</label>
                                </div>
                                <input type="hidden" name="oldname" value="<?php echo $RolID['rol_nombre']; ?>">
                                <input type="hidden" name="olddescrip" value="<?php echo $RolID['rol_descripcion']; ?>">
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
                                    <input type="text" name="perNombre" class="form-control input-field" maxlength="50" minlength="4" value="<?php if (isset($permiso)) { echo $permiso;  } else { echo $PerID['permiso_nombre']; } ?>" required>
                                </div>
                                <div class="col-md-12 text-light mt-2">
                                    <label class="txt_form">Descripción del Permiso </label>
                                </div>
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Escribe una descripcion de la categoria aqui" id="catDescrip" name="perDescrip" style="height: 100px" required> <?php if (isset($perDescrip)) { echo $perDescrip; } else { echo $PerID['permiso_descripcion'];
                                                                                                                                                                                                } ?></textarea>
                                    <label for="catDescrip">Escribe una descripcion para el permiso</label>
                                </div>
                                <input type="hidden" name="oldname" value="<?php echo $PerID['permiso_nombre']; ?>">
                                <input type="hidden" name="olddescrip" value="<?php echo $PerID['permiso_descripcion']; ?>">


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
        </div>

        <!-- /row-->
        </div>

    <?php endif; ?>
<?php else : ?>
    <div class="alert alert-danger p-5 my-5" role="alert">
        <?php echo $error; ?>
    </div>
<?php endif; ?>