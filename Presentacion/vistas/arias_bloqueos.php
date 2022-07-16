<?php
$rolPermitido = $log->activeRol($_SESSION['usuario'][2], $RolPermisos);
// $permisosRol = $log->activeRolPermi($_SESSION['usuario'][3], [9]);
// $permisoEsp = $log->permisosEspeciales($_SESSION['usuario'][4], [9]);

switch ($error = 'SinError') {
    case ($logueado == 'false'):
        $error = 'Debe iniciar sesión para poder visualizar este pagina';
        break;
    case ($rolPermitido != 'true'):
        $error = 'Su rol actual no le otorga permisos para acceder a esta página';
        break;
}
if ($error == 'SinError') : ?>
    <?php
    require_once('BL/consultas_rolesPermisos.php');
    $consulta = new Consulta_RolesPermisos();
    $roles = $consulta->listarRoles($conexion);
    $perRolBtn = $consulta->listarRolesXArea($conexion);
    $areas = $consulta->listarAreas($conexion);

    if (isset($_POST['cambia_estado_rol'])) {
        $Rol_Id = $_POST['rol_id'];
        $Rol_estado = $_POST['rol_estado'];
        $Rresult = $consulta->cambiar_estado_rol($conexion, $Rol_Id, $Rol_estado);

        if ($Rresult == 'mal') {
        } else {
            echo '<meta http-equiv="refresh" content="0; url=index.php?modulo=rolesPermisos&mensaje=Se cambio el estado del rol" />';
        }
    }

    if (isset($_POST['cambia_estado_PerRol'])) {
        $PerRol_estado = $_POST['rolper_estado'];
        $Rol_Id = $_POST['rol_id'];
        $Permiso_id = $_POST['per_id'];
        $PRestado = $consulta->cambiar_estado_PermisoRol($conexion, $Rol_Id, $Permiso_id, $PerRol_estado);

        if ($PRestado == 'mal') {
        } else {
            echo '<meta http-equiv="refresh" content="0; url=index.php?modulo=rolesPermisos&mensaje=Se cambio el acceso del permiso para el rol" />';
        }
    }

    if (isset($_POST['cambia_estado_permiso'])) {
        $Permiso_Id = $_POST['permiso_id'];
        $Permiso_estado = $_POST['permiso_estado'];
        $Presult = $consulta->cambiar_estado_permiso($conexion, $Permiso_Id, $Permiso_estado);

        if ($Presult == 'mal') {
        } else {
            echo '<meta http-equiv="refresh" content="0; url=index.php?modulo=rolesPermisos&mensaje=Se cambio el estado del permiso" />';
        }
    }

    if (isset($_POST['btn_asigna_permiso_rol'])) {
        $Rol_Id = $_POST['selectRol'];
        $Permiso_id = $_POST['selectPermiso'];
        $APRresult = $consulta->asignarPermisoRol($conexion, $Rol_Id, $Permiso_id);

        if ($APRresult == 1) {
    ?>
            <div class="alert alert-danger alert-dismissible fade show " role="alert">
                <strong class="fs-3">Error!</strong><br>No se puede asignar el permiso al rol debia a que ya lo tiene
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
        } elseif ($APRresult == 2) {
        ?>
            <div class="alert alert-danger alert-dismissible fade show " role="alert">
                <strong class="fs-3">Error!</strong><br>Debido a un problema, por el momento no se puede asignar el permiso al rol
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
    <?php
        } elseif ($APRresult == 3) {
            echo '<meta http-equiv="refresh" content="0; url=index.php?modulo=rolesPermisos&mensaje=Se agrego un nuevo permiso al rol" />';
        }
        
    }

    if (isset($_POST['btn_insert_rol'])) {
        $Rol_name = $_POST['rol_name'];
        $Rol_descrip = $_POST['rol_descrip'];
        $Rolresult = $consulta->insert_rol($conexion, $Rol_name, $Rol_descrip);


        if ($Rolresult == 1) {
    ?>
            <div class="alert alert-danger alert-dismissible fade show " role="alert">
                <strong class="fs-3">Error!</strong><br>No se puede agregar este rol porque ya hay un rol con ese nombre
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
        } elseif ($Rolresult == 2) {
        ?>
            <div class="alert alert-danger alert-dismissible fade show " role="alert">
                <strong class="fs-3">Error!</strong><br>Debido a un problema, por el momento no se puede agregar el rol
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
    <?php
        } elseif ($Rolresult == 3) {
            echo "<meta http-equiv='refresh' content='3';>";
            echo '<div class="alert alert-success">¡Se agrego un nuevo rol!.</div>';

        }
        
    }

    if (isset($_POST['btn_asigna_rol_area'])) {
        $Rol_Id = $_POST['selectRol'];
        $PArea_id = $_POST['selectArea'];
        $RAresult = $consulta->asignarRolArea($conexion, $Rol_Id, $PArea_id);    

        if ($RAresult == 1) {
    ?>
            <div class="alert alert-danger alert-dismissible fade show " role="alert">
                <strong class="fs-3">Error!</strong><br>No se puede asignar el rol al area debido a que ya lo tiene
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
        } elseif ($RAresult == 2) {
        ?>
            <div class="alert alert-danger alert-dismissible fade show " role="alert">
                <strong class="fs-3">Error!</strong><br>Debido a un problema, por el momento no se puede asignar el rol al area
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
    <?php
        } elseif ($RAresult == 3) {
            echo "<meta http-equiv='refresh' content='3';>";
            echo '<div class="alert alert-success">¡Se agrego un nuevo rol al area!.</div>';
        }
        
    }

    if (isset($_POST['cambia_estado_permisoRol'])) {
        $Btn_Id = $_POST['btn_id'];
        $Rol_Id = $_POST['rol_id'];
        $estado_RBt = $_POST['estadoRBt'];
        $RBresult = $consulta->cambiar_estado_permiso_rol($conexion, $Btn_Id, $Rol_Id, $estado_RBt);

        if ($RBresult == 'mal') {
        } else {
            echo '<meta http-equiv="refresh" content="0; url=index.php?modulo=rolesPermisos&mensaje=Se cambio el estado del permiso" />';
        }
    }
    $tpr = 1;
    $ro = 1;
    $pe = 1;
    $brp = 1;
    ?>
    <h2 class="text-center mt-3 h1">Roles y Permisos</h2>
    <div class="row">
        <div class="col-sm-12">
            <div class="my-3">
                <ul class="nav nav-tabs mb-3" id="adop-tables-tab" role="tablist">
                    <li class="nav-item" role="Permisos">
                        <button class="nav-link active" id="btnRolPermit-tab" data-bs-toggle="tab" data-bs-target="#btnRolPermit" type="button" role="tab" aria-controls="btnRolPermit" aria-selected="false">Botones y Roles permitidos</button>
                    </li>
                </ul>
                <div class="tab-content " id="myTabContent">
                        <div class="tab-pane fade show active" id="btnRolPermit" role="tabpanel" aria-labelledby="btnRolPermit-tab">
                            <table class="table table-sm table-hover wrap mx-auto w-100" id="tablaBtnRol">
                                <thead class="bg-danger text-white">
                                    <tr>
                                        <td># </td>
                                        <td>Area </td>
                                        <td>Rol </td>
                                        <td>Estado</td>
                                        <td>Cambiar estado </td>

                                    </tr>
                                </thead>
                                <tfoot class="bg-secondary text-white">
                                    <tr>
                                        <td># </td>
                                        <td>Area </td>
                                        <td>Rol </td>
                                        <td>Estado</td>
                                        <td>Cambiar estado </td>

                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php foreach ($perRolBtn  as $key => $value) : ?>
                                        <tr class="text-center">
                                            <td><?php echo ($brp++); ?> </td>
                                            <td><?php echo ($value['area_nombre']); ?> </td>
                                            <td><?php echo ($value['rol_nombre']); ?> </td>
                                            <td><?php echo ($value['estado'] == 1) ? 'Activado' : 'Desactivado'; ?></td>
                                            <td>
                                                <form action="" method="post">
                                                    <input type="hidden" name="btn_id" value="<?= $value['area_id']; ?>">
                                                    <input type="hidden" name="rol_id" value="<?= $value['rol_id']; ?>">
                                                    <input type="hidden" name="estadoRBt" value="<?= $value['estado']; ?>">
                                                    <button class="btn <?php echo ($value['estado'] == 1) ? 'btn-danger' : 'btn-success' ?> btn-xs" name="cambia_estado_permisoRol" title="<?php echo ($value['estado'] == 1) ? 'Desactivar' : 'Activar' ?> rol para esta area" onclick="return confirm('¿Quieres <?php echo ($value['estado'] == 1) ? 'Desactivar' : 'Activar' ?> este rol para esta area?')"><i class="fa-solid fa-power-off"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <div class="py-3 my-3 shadow-lg bg-secondary bg-opacity-75">
                                <h2 class="my-4 text-center">Asignar Rol al Area</h2>
                                <div class="w-75 my-5 mx-auto">
                                <form action="" method="post">
                                <div class="form-outline mb-3">
                                    <label for="selectRol">Rol</label>
                                    <select class="form-select form-select-lg" aria-label="form-select-lg example" id="selectRol" name="selectRol" required>
                                        <option selected></option>
                                        <?php foreach ($roles as $key => $value) : ?>
                                            <option value="<?php echo ($value['rol_id']); ?>"><?php echo ($value['rol_nombre']); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-outline mb-3">
                                    <label for="selectBtn">Area</label>
                                    <select class="form-select form-select-lg" aria-label="form-select-lg example" id="selectBtn" name="selectArea" required>
                                        <option selected></option>
                                        <?php foreach ($areas as $key => $value) : ?>
                                            <option value="<?php echo ($value['area_id']); ?>"><?php echo ($value['area_nombre']); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                    <div class="d-flex justify-content-evenly">
                                    <button type="submit" class="btn btn-primary btn-lg mt-4" name="btn_asigna_rol_area">Asignar Rol</button>
                                    <button type="reset" class="btn btn-danger btn-lg mt-4">Cancelar</button>
                                </div>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php else : ?>
        <div class="alert alert-danger p-5 my-5" role="alert">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>