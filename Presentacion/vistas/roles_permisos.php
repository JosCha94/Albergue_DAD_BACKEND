<?php
require_once('BL/consultas_rolesPermisos.php');
$consulta = new Consulta_RolesPermisos();
$rolPer = $consulta->listarRolesPermisos($conexion);
$roles = $consulta->listarRoles($conexion);
$permisos = $consulta->listarPermisos($conexion);

if (isset($_POST['cambia_estado_rol'])) {
    $Rol_Id = $_POST['rol_id'];
    $Rol_estado = $_POST['rol_estado'];
    $Restado = $consulta->cambiar_estado_rol($conexion, $Rol_Id, $Rol_estado);

    if ($Restado == 'mal') {
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
    $Pestado = $consulta->cambiar_estado_permiso($conexion, $Permiso_Id, $Permiso_estado);

    if ($Pestado == 'mal') {
    } else {
        echo '<meta http-equiv="refresh" content="0; url=index.php?modulo=rolesPermisos&mensaje=Se cambio el estado del permiso" />';
    }
}

if (isset($_POST['btn_asigna_permiso_rol'])) {
    $Rol_Id = $_POST['selectRol'];
    $Permiso_id = $_POST['selectPermiso'];
    $Pestado = $consulta->asignarPermisoRol($conexion, $Rol_Id, $Permiso_id);

    if ($Pestado == 'mal') {
    } else {
        echo '<meta http-equiv="refresh" content="0; url=index.php?modulo=rolesPermisos&mensaje=Se agrego un nuevo permiso al rol" />';
    }
}
?>
<h2 class="text-center mt-3 h1">Roles y Permisos</h2>
<div class="row">
    <div class="col-sm-12">
        <div class="my-3">
            <ul class="nav nav-tabs mb-3" id="adop-tables-tab" role="tablist">

                <li class="nav-item" role="RolesyPermisos">
                    <button class="nav-link active" id="rolesPermisos-tab" data-bs-toggle="tab" data-bs-target="#rolesPermisos" type="button" role="tab" aria-controls="rolesPermisos" aria-selected="true">Todos los Permisos segun rol</button>
                </li>
                <li class="nav-item" role="Roles">
                    <button class="nav-link" id="roles-tab" data-bs-toggle="tab" data-bs-target="#roles" type="button" role="tab" aria-controls="roles" aria-selected="false">Roles</button>
                </li>
                <li class="nav-item" role="Permisos">
                    <button class="nav-link" id="permisos-tab" data-bs-toggle="tab" data-bs-target="#permisos" type="button" role="tab" aria-controls="permisos" aria-selected="false">Permisos</button>
                </li>
            </ul>
            <div class="tab-content " id="myTabContent">
                <div class="tab-pane fade show active wrap" id="rolesPermisos" role="tabpanel" aria-labelledby="rolesPermisos-tab">
                    <table class="table table-sm table-hover" id="tablaRolesPermisos">
                        <thead class="bg-danger text-white">
                            <tr>
                                <td>Rol </td>
                                <td>Descripcion del Rol </td>
                                <td>Permiso </td>
                                <td>Descripcion del Permiso </td>
                                <td>Estado del acceso del rol al permiso </td>
                                <td>Acceso del rol al permiso </td>


                            </tr>
                        </thead>
                        <tfoot class="bg-secondary text-white">
                            <tr>
                                <td>Rol </td>
                                <td>Descripcion del Rol </td>
                                <td>Permiso </td>
                                <td>Descripcion del Permiso </td>
                                <td>Estado del acceso del rol al permiso </td>
                                <td>Acceso del rol al permiso </td>

                            </tr>
                        </tfoot>
                        <tbody>
                            <?php foreach ($rolPer as $key => $value) : ?>
                                <tr class="text-center">
                                    <td><?php echo ($value['rol_nombre']); ?> </td>
                                    <td><?php echo ($value['rol_descripcion']); ?> </td>
                                    <td><?php echo ($value['permiso_nombre']); ?></td>
                                    <td><?php echo ($value['permiso_descripcion']); ?> </td>
                                    <td><?php echo ($value['rol_per_estado']); ?> </td>
                                    <td>

                                        <form action="" method="post">
                                            <input type="hidden" name="rolper_estado" value="<?= $value['rol_per_estado']; ?>">
                                            <input type="hidden" name="rol_id" value="<?= $value['rol_id']; ?>">
                                            <input type="hidden" name="per_id" value="<?= $value['permiso_id']; ?>">
                                            <button class="btn <?php echo ($value['rol_per_estado'] == 'Activado') ? 'btn-danger' : 'btn-success' ?> btn-xs" name="cambia_estado_PerRol" title="<?php echo ($value['rol_per_estado'] == 'Activado') ? 'Desactivar' : 'Activar' ?> permiso para el rol" onclick="return confirm('¿Quieres <?php echo ($value['rol_per_estado'] == 'Activado') ? 'Desactivar' : 'Activar' ?> este permiso para el rol?')"><i class="fa-solid fa-power-off"></i></button>
                                        </form>

                                    </td>

                                </tr>
                            <?php endforeach; ?>
                        </tbody>

                    </table>
                </div>
                <div class="tab-pane fade" id="roles" role="tabpanel" aria-labelledby="roles-tab">
                    <table class="table table-sm table-hover wrap mx-auto w-100" id="tablaRoles">
                        <thead class="bg-danger text-white">
                            <tr>
                                <td>Rol </td>
                                <td>Descripcion del Rol </td>
                                <td>Estado del rol </td>
                                <td>Fecha de creación </td>
                                <td>Ultima modidicacion </td>
                                <td>Editar Rol </td>
                                <td>Cambiar estado del rol </td>


                            </tr>
                        </thead>
                        <tfoot class="bg-secondary text-white">
                            <tr>
                                <td>Rol </td>
                                <td>Descripcion del Rol </td>
                                <td>Estado del rol </td>
                                <td>Fecha de creación </td>
                                <td>Ultima modidicacion </td>
                                <td>Editar Rol </td>
                                <td>Cambiar estado del rol </td>

                            </tr>
                        </tfoot>
                        <tbody>
                            <?php foreach ($roles as $key => $value) : ?>
                                <tr class="text-center">
                                    <td><?php echo ($value['rol_nombre']); ?> </td>
                                    <td><?php echo ($value['rol_descripcion']); ?> </td>
                                    <td><?php echo ($value['rol_estado']); ?></td>
                                    <td><?php echo ($value['rol_fecha_creacion']); ?> </td>
                                    <td><?php echo ($value['rol_fecha_cambio']); ?> </td>
                                    <td>
                                        <form action="index.php?modulo=admin_roles_permisos&formTipo=editRol" method="post">
                                            <input type="hidden" name="rol_id" value="<?= $value['rol_id']; ?>">
                                            <button class="btn btn-warning btn-xs" name="cambiarDatosRol" title="Cambiar datos"><i class="fa-solid fa-pen-to-square"></i></button>
                                        </form>

                                    </td>
                                    <td>
                                        <form action="" method="post">
                                            <input type="hidden" name="rol_estado" value="<?= $value['rol_estado']; ?>">
                                            <input type="hidden" name="rol_id" value="<?= $value['rol_id']; ?>">
                                            <button class="btn <?php echo ($value['rol_estado'] == 'Activado') ? 'btn-danger' : 'btn-success' ?> btn-xs" name="cambia_estado_rol" title="<?php echo ($value['rol_estado'] == 'Activado') ? 'Desactivar' : 'Activar' ?> rol" onclick="return confirm('¿Quieres <?php echo ($value['rol_estado'] == 'Activado') ? 'Desactivar' : 'Activar' ?> este rol?')"><i class="fa-solid fa-power-off"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>

                    </table>
                </div>
                <div class="tab-pane fade" id="permisos" role="tabpanel" aria-labelledby="roles-tab">
                    <table class="table table-sm table-hover w-100" id="tablaPermisos">
                        <thead class="bg-danger text-white">
                            <tr>
                                <td>Permiso </td>
                                <td>Descripcion del Permiso </td>
                                <td>Estado del permiso </td>
                                <td>Fecha de creación </td>
                                <td>Ultima modidicacion </td>
                                <td>Editar Permiso </td>
                                <td>Cambiar estado del permiso </td>


                            </tr>
                        </thead>
                        <tfoot class="bg-secondary text-white">
                            <tr>
                                <td>Permiso </td>
                                <td>Descripcion del Permiso </td>
                                <td>Estado del permiso </td>
                                <td>Fecha de creación </td>
                                <td>Ultima modidicacion </td>
                                <td>Editar Permiso </td>
                                <td>Cambiar estado del permiso </td>

                            </tr>
                        </tfoot>
                        <tbody>
                            <?php foreach ($permisos as $key => $value) : ?>
                                <tr class="text-center">
                                    <td><?php echo ($value['permiso_nombre']); ?> </td>
                                    <td><?php echo ($value['permiso_descripcion']); ?> </td>
                                    <td><?php echo ($value['permiso_estado']); ?></td>
                                    <td><?php echo ($value['permiso_fecha_creacion']); ?> </td>
                                    <td><?php echo ($value['permiso_fecha_cambio']); ?> </td>
                                    <td>
                                        <form action="index.php?modulo=admin_roles_permisos&formTipo=editPermiso" method="post">
                                            <input type="hidden" name="permiso_id" value="<?= $value['permiso_id']; ?>">
                                            <button class="btn btn-warning btn-xs" name="cambiarDatosPermiso" title="Cambiar datos"><i class="fa-solid fa-pen-to-square"></i></button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="" method="post">
                                            <input type="hidden" name="permiso_estado" value="<?= $value['permiso_estado']; ?>">
                                            <input type="hidden" name="permiso_id" value="<?= $value['permiso_id']; ?>">
                                            <button class="btn <?php echo ($value['permiso_estado'] == 'Activado') ? 'btn-danger' : 'btn-success' ?> btn-xs" name="cambia_estado_permiso" title="<?php echo ($value['permiso_estado'] == 'Activado') ? 'Desactivar' : 'Activar' ?> permiso" onclick="return confirm('¿Quieres <?php echo ($value['permiso_estado'] == 'Activado') ? 'Desactivar' : 'Activar' ?> este permiso?')"><i class="fa-solid fa-power-off"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="w-75 my-5 mx-auto">
                        <h2 class="my-4 text-center">Asignar Permiso al rol</h2>
                        <form action="" method="post">
                            <label for="selectRol">Rol</label>
                            <select class="form-select form-select-lg" aria-label="form-select-lg example" id="selectRol" name="selectRol" required>
                                <option selected></option>
                                <?php foreach ($roles as $key => $value) : ?>
                                    <option value="<?php echo ($value['rol_id']); ?>"><?php echo ($value['rol_nombre']); ?></option>
                                <?php endforeach; ?>
                            </select>

                            <label for="selectRol">Permisos</label>
                            <select class="form-select form-select-lg" aria-label="form-select-lg example" id="selectPermiso" name="selectPermiso" required>
                                <option selected></option>
                                <?php foreach ($permisos as $key => $value) : ?>
                                    <option value="<?php echo ($value['permiso_id']); ?>"><?php echo ($value['permiso_nombre']); ?></option>
                                <?php endforeach; ?>
                            </select>

                            <button type="submit" class="btn btn-primary btn-lg mt-4" name="btn_asigna_permiso_rol">Asignar Permiso</button>
                            <button type="reset" class="btn btn-danger btn-lg mt-4">Cancelar</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>