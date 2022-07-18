<?php
$rolPermitido = $log->activeRol($_SESSION['usuario'][2], $usuarios);
$permisosRol = $log->activeRolPermi($_SESSION['usuario'][3], [13]);
$permisoEsp = $log->permisosEspeciales($_SESSION['usuario'][4], [13]);
$gestionUsr = $log->permisosEspeciales($_SESSION['usuario'][4], [12]);

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
    require_once('BL/consultas_usuario.php');
    require_once('BL/consultas_rolesPermisos.php');
    $consultaRP = new Consulta_RolesPermisos();
    $consulta = new Consulta_usuario();
    $usuarios = $consulta->listarUsuarios($conexion);
    $usuarios2 = $consulta->listarUsuarios2($conexion);
    $perEsp = $consulta->listarPerEspUsr($conexion);
    $roles = $consultaRP->listarRoles($conexion);
    $permisos = $consultaRP->listarPermisos($conexion);

    if (isset($_POST['btn_asignaRol'])) {
        $idUser = $_POST['selectUser'];
        $idRol = $_POST['selectRol'];

        $asignaRol = $consulta->asignarRol($conexion, $idUser, $idRol);

        if ($asignaRol == 1) {
            ?>
            <div class="alert alert-danger alert-dismissible fade show " role="alert">
                    <strong class="fs-3">Error!</strong><br>No se puede asignar el rol al uasuario debia a que ya lo tiene
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
        <?php
        }elseif($asignaRol == 2){
            ?>
            <div class="alert alert-danger alert-dismissible fade show " role="alert">
                    <strong class="fs-3">Error!</strong><br>Debido a un problema, por el momento no se puede asignar el rol al usuario
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>           
             <?php
        } elseif($asignaRol == 3) {
            echo '<meta http-equiv="refresh" content="0; url=index.php?modulo=usuarios&mensaje=Se agrego correctamente el rol al usuario" />';
        }
    }

    if (isset($_POST['cambia_estado_usrRol'])) {
        $estado_UR = $_POST['usrrol_estado'];
        $idUser = $_POST['user_id'];
        $idRol = $_POST['rol_id'];
        $estadoUR = $consulta->cambia_estado_UsrRol($conexion, $idUser, $idRol, $estado_UR);

        if ($estadoUR == 'mal') {
        } else {
            echo '<meta http-equiv="refresh" content="0; url=index.php?modulo=usuarios&mensaje=El estado del rol se cambio para el usuario" />';
        }
    }

    if (isset($_POST['cambia_estado_usr'])) {
        $idUser = $_POST['usr_id'];
        $estado = $_POST['usr_estado'];
        $estadoU = $consulta->cambia_estado_User($conexion, $idUser, $estado);

        if ($estadoU == 'mal') {
        } else {
            echo '<meta http-equiv="refresh" content="0; url=index.php?modulo=usuarios&mensaje=Se cambio el estado del usuario" />';
        }
    }

    if (isset($_POST['cambia_estado_usrPerEsp'])) {
        $UP_estado = $_POST['usrper_estado'];
        $idUser = $_POST['usr_id'];
        $idPer = $_POST['permiso_id'];
        $estadoUP = $consulta->cambia_estado_UsrPer($conexion, $idUser, $idPer, $UP_estado);

        if ($estadoUP == 'mal') {
        } else {
            echo '<meta http-equiv="refresh" content="0; url=index.php?modulo=usuarios&mensaje=Se cambio el acceso del permiso para el usuario" />';
        }
    }

    if (isset($_POST['btn_asignaPermiso'])) {
        $idUser = $_POST['selectUser'];
        $idPer = $_POST['selectPer'];

        $asignaRol = $consulta->asignarPermiso($conexion, $idUser, $idPer);

        if ($asignaRol == 1) {
            ?>
            <div class="alert alert-danger alert-dismissible fade show " role="alert">
                    <strong class="fs-3">Error!</strong><br>No se puede asignar el permiso al uasuario debia a que ya lo tiene
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
        <?php
        }elseif($asignaRol == 2){
            ?>
            <div class="alert alert-danger alert-dismissible fade show " role="alert">
                    <strong class="fs-3">Error!</strong><br>Debido a un problema, por el momento no se puede asignar el permiso al usuario
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php
        } elseif($asignaRol == 3) {
            echo '<meta http-equiv="refresh" content="0; url=index.php?modulo=usuarios&mensaje=Se agrego correctamente el permiso especial al usuario" />';
        }

    }
    $us = 1;
    $ur = 1;
    $up = 1;

    ?>
    <h2 class="text-center mt-3 h1">Usuarios</h2>
    <div class="row">
        <div class="col-sm-12">
            <div class="my-3">
                <ul class="nav nav-tabs mb-3" id="adop-tables-tab" role="tablist">

                    <li class="nav-item" role="usuarios">
                        <button class="nav-link active" id="usuarios-tab" data-bs-toggle="tab" data-bs-target="#usuarios" type="button" role="tab" aria-controls="usuarios" aria-selected="true">Todos los usuarios</button>
                    </li>
                    <li class="nav-item" role="Asigna Roles">
                        <button class="nav-link" id="asignaRol-tab" data-bs-toggle="tab" data-bs-target="#asignaRol" type="button" role="tab" aria-controls="asignaRol" aria-selected="false">Usuarios y roles</button>
                    </li>
                    <li class="nav-item" role="UsrPerEsp">
                        <button class="nav-link" id="UsrPerEsp-tab" data-bs-toggle="tab" data-bs-target="#UsrPerEsp" type="button" role="tab" aria-controls="UsrPerEsp" aria-selected="false">Usuarios y permisos Especiales</button>
                    </li>
                </ul>
                <div class="tab-content " id="myTabContent">
                    <div class="tab-pane fade show active" id="usuarios" role="tabpanel" aria-labelledby="usuarios-tab">
                        <table class="table table-sm table-hover" id="tablaUsuarios">
                            <thead class="bg-danger text-white">
                                <tr>
                                    <th scope="col">#</th>
                                    <td>Usuario </td>
                                    <td>Estado </td>
                                    <td>Nombre </td>
                                    <td>Apellido Paterno </td>
                                    <td>Apellido Materno </td>
                                    <td>Correo </td>
                                    <td>Teléfono </td>
                                    <td>Fecha de creación</td>
                                    <td>Fecha de modificación</td>
                                    <td>Cambiar UsrEstado</td>

                                </tr>
                            </thead>
                            <tfoot class="bg-secondary text-white">
                                <tr>
                                    <th scope="col">#</th>                                    
                                    <td>Usuario </td>
                                    <td>Estado </td>
                                    <td>Nombre </td>
                                    <td>Apellido Paterno </td>
                                    <td>Apellido Materno </td>
                                    <td>Correo </td>
                                    <td>Teléfono </td>
                                    <td>Fecha de creación</td>
                                    <td>Fecha de modificación</td>
                                    <td>Cambiar UsrEstado</td>

                                </tr>
                            </tfoot>
                            <tbody>
                                <?php foreach ($usuarios2 as $key => $value) : ?>
                                    <tr class="text-center">
                                        <th scope="row"><?= $us++ ?></th>
                                        <td><?php echo ($value['usuario']); ?> </td>
                                        <td><?php echo ($value['usr_estado']); ?> </td>
                                        <td><?php echo ($value['usr_nombre']); ?></td>
                                        <td><?php echo ($value['usr_apellido_paterno']); ?> </td>
                                        <td><?php echo ($value['usr_apellido_materno']); ?> </td>
                                        <td><?php echo ($value['usr_email']); ?> </td>
                                        <td><?php echo ($value['usr_celular']); ?> </td>
                                        <td><?php echo ($value['usr_fecha_creacion']); ?> </td>
                                        <td><?php echo ($value['usr_fecha_modificacion']); ?> </td>
                                        <td>
                                        <?php if($gestionUsr == 'true'): ?>
                                            <form action="" method="post">
                                                <input type="hidden" name="usr_estado" value="<?= $value['usr_estado']; ?>">
                                                <input type="hidden" name="usr_id" value="<?= $value['usr_id']; ?>">
                                                <button class="btn <?php echo ($value['usr_estado'] == 'Habilitado') ? 'btn-danger' : 'btn-success' ?> btn-xs " name="cambia_estado_usr" title="<?php echo ($value['usr_estado'] == 'Habilitado') ? 'Deshabilitar' : 'Habilitar' ?> Usuario" onclick="return confirm('¿Quieres <?php echo ($value['usr_estado'] == 'Habilitado') ? 'Deshabilitar' : 'Habilitar' ?> este usuario?')"><i class="fa-solid fa-toggle-off"></i></button>
                                            </form>
                                        <?php endif; ?>
                                        </td>

                                    </tr>
                                <?php endforeach; ?>
                            </tbody>

                        </table>
                    </div>
                    <div class="tab-pane fade " id="asignaRol" role="tabpanel" aria-labelledby="asignaRol-tab">
                        <table class="table table-sm table-hover w-100" id="tablaUserRol">
                            <thead class="bg-danger text-white">
                                <tr>
                                    <th scope="col">#</th>
                                    <td>Usuario </td>
                                    <td>Estado del usuario </td>
                                    <td>Nombre completo </td>
                                    <td>Correo </td>
                                    <td>Teléfono </td>
                                    <td>Rol</td>
                                    <td>Rol Estado</td>
                                    <td>Cambiar Estado del Rol</td>

                                </tr>
                            </thead>
                            <tfoot class="bg-secondary text-white">
                                <tr>
                                    <th scope="col">#</th>
                                    <td>Usuario </td>
                                    <td>Estado del usuario </td>
                                    <td>Nombre completo </td>
                                    <td>Correo </td>
                                    <td>Teléfono </td>
                                    <td>Rol</td>
                                    <td>Rol Estado</td>
                                    <td>Cambiar Estado del Rol</td>

                                </tr>
                            </tfoot>
                            <tbody>
                                <?php foreach ($usuarios as $key => $value) : ?>
                                    <tr class="text-center">
                                        <th scope="row"><?= $ur++ ?></th>
                                        <td><?php echo ($value['usuario']); ?> </td>
                                        <td><?php echo ($value['usr_estado']); ?> </td>
                                        <td><?php echo ($value['usr_nombre'] . ' ' . $value['usr_apellido_paterno'] . ' ' . $value['usr_apellido_materno']); ?> </td>
                                        <td><?php echo ($value['usr_email']); ?> </td>
                                        <td><?php echo ($value['usr_celular']); ?> </td>
                                        <td><?php echo ($value['rol_nombre']); ?> </td>
                                        <td><?php echo ($value['usr_rol_estado']); ?> </td>
                                        <td>
                                        <?php if($permisosRol == 'true' || $permisoEsp == 'true'): ?>
                                            <form action="" method="post">
                                                <input type="hidden" name="usrrol_estado" value="<?= $value['usr_rol_estado']; ?>">
                                                <input type="hidden" name="user_id" value="<?= $value['usr_id']; ?>">
                                                <input type="hidden" name="rol_id" value="<?= $value['rol_id']; ?>">
                                                <button class="btn <?php echo ($value['usr_rol_estado'] == 'Activado') ? 'btn-danger' : 'btn-success' ?> btn-xs" name="cambia_estado_usrRol" title="<?php echo ($value['usr_rol_estado'] == 'Activado') ? 'Desactivar' : 'Activar' ?> rol para el usuario" onclick="return confirm('¿Quieres <?php echo ($value['usr_rol_estado'] == 'Activado') ? 'Desactivar' : 'Activar' ?> este rol para el usuario?')"><i class="fa-solid fa-power-off"></i></button>

                                            </form>
                                        <?php endif; ?>
                                        </td>

                                    </tr>
                                <?php endforeach; ?>
                            </tbody>

                        </table>
                        <div class="py-3 my-3 shadow-lg bg-secondary bg-opacity-75">
                            <h3 class="my-2 text-center">Asignar Rol al usuario</h3>
                            <div class="w-75 mx-auto">
                                <form class="" action="" method="post">
                                    <label for="selectUser ">Usuario</label>
                                    <select class="form-select form-select-lg mb-3" aria-label="form-select-lg example" id="selectUser" name="selectUser" required>
                                        <option selected></option>
                                        <?php foreach ($usuarios2 as $key => $value) : ?>
                                            <option value="<?php echo ($value['usr_id']); ?>"><?php echo ($value['usr_email']); ?></option>
                                        <?php endforeach; ?>

                                    </select>

                                    <label for="selectRol">Rol</label>
                                    <select class="form-select form-select-lg" aria-label="form-select-lg example" id="selectRol" name="selectRol" required>
                                        <option selected></option>
                                        <?php foreach ($roles as $key => $value) : ?>
                                            <option value="<?php echo ($value['rol_id']); ?>"><?php echo ($value['rol_nombre']); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?php if($permisosRol == 'true' || $permisoEsp == 'true'): ?>
                                    <button type="submit" class="btn btn-primary btn-lg mt-4" name="btn_asignaRol">Asignar Rol</button>
                                    <button type="reset" class="btn btn-danger btn-lg mt-4">Cancelar</button>
                                    <?php endif; ?>

                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="UsrPerEsp" role="tabpanel" aria-labelledby="UsrPerEsp-tab">
                        <table class="table table-sm table-hover w-100" id="tablaUserEsp">
                            <thead class="bg-danger text-white">
                                <tr>
                                    <th scope="col">#</th>
                                    <td>Usuario </td>
                                    <td>E-mail </td>
                                    <td>Permiso </td>
                                    <td>Estado </td>
                                    <td>Cambiar estado </td>


                                </tr>
                            </thead>
                            <tfoot class="bg-secondary text-white">
                                <tr>
                                    <th scope="col">#</th>
                                    <td>Usuario </td>
                                    <td>E-mail </td>
                                    <td>Permiso </td>
                                    <td>Estado </td>
                                    <td>Cambiar estado </td>

                                </tr>
                            </tfoot>
                            <tbody>
                                <?php foreach ($perEsp as $key => $value) : ?>
                                    <tr class="text-center">
                                        <th scope="row"><?= $up++ ?></th>
                                        <td><?php echo ($value['Usuario']); ?> </td>
                                        <td><?php echo ($value['usr_email']); ?> </td>
                                        <td><?php echo ($value['permiso_nombre']); ?></td>
                                        <td><?php echo ($value['usr_per_estado']); ?> </td>
                                        <td>
                                        <?php if($gestionUsr == 'true'): ?>
                                            <form action="" method="post">
                                                <input type="hidden" name="usrper_estado" value="<?= $value['usr_per_estado']; ?>">
                                                <input type="hidden" name="usr_id" value="<?= $value['usr_id']; ?>">
                                                <input type="hidden" name="permiso_id" value="<?= $value['permiso_id']; ?>">
                                                <button class="btn <?php echo ($value['usr_per_estado'] == 'Activado') ? 'btn-danger' : 'btn-success' ?> btn-xs" name="cambia_estado_usrPerEsp" title="<?php echo ($value['usr_per_estado'] == 'Activado') ? 'Desactivar' : 'Activar' ?> permiso para el usuario" onclick="return confirm('¿Quieres <?php echo ($value['usr_per_estado'] == 'Activado') ? 'Desactivar' : 'Activar' ?> este permiso para el usuario?')"><i class="fa-solid fa-power-off"></i></button>

                                            </form>
                                        <?php endif; ?>
                                        </td>

                                    </tr>
                                <?php endforeach; ?>
                            </tbody>

                        </table>
                        <div class="w-75 my-5 mx-auto">
                            <h2 class="my-4 text-center">Asignar Permiso al usuario</h2>
                            <form action="" method="post">
                                <label for="selectUser">Usuario</label>
                                <select class="form-select form-select-lg mb-3" aria-label="form-select-lg example" id="selectUser" name="selectUser" required>
                                    <option selected></option>
                                    <?php foreach ($usuarios2 as $key => $value) : ?>
                                        <option value="<?php echo ($value['usr_id']); ?>"><?php echo ($value['usr_email']); ?></option>
                                    <?php endforeach; ?>

                                </select>

                                <label for="selectRol">Permiso</label>
                                <select class="form-select form-select-lg" aria-label="form-select-lg example" id="selectRol" name="selectPer" required>
                                    <option selected></option>
                                    <?php foreach ($permisos as $key => $value) : ?>
                                        <option value="<?php echo ($value['permiso_id']); ?>"><?php echo ($value['permiso_nombre']); ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php if($gestionUsr == 'true'): ?>
                                <button type="submit" class="btn btn-primary btn-lg mt-4" name="btn_asignaPermiso">Asignar Permiso</button>
                                <button type="reset" class="btn btn-danger btn-lg mt-4">Cancelar</button>
                                <?php endif; ?>
                            </form>
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