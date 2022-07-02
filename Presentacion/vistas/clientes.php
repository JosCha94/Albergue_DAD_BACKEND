<?php
require_once('BL/consultas_usuario.php');
$consulta = new Consulta_usuario();
$usuarios = $consulta->listarUsuarios($conexion);
$usuarios2 = $consulta->listarUsuarios2($conexion);
$roles = $consulta->listarRoles($conexion);

if (isset($_POST['btn_asignaRol'])) {
    $idUser = $_POST['selectUser'];
    $idRol = $_POST['selectRol'];

    $asignaRol = $consulta->asignarRol($conexion, $idUser, $idRol);

    if ($asignaRol == 'mal') {
            
    } else {
        echo '<meta http-equiv="refresh" content="0; url=index.php?modulo=clientes&mensaje=Se agrego correctamente el rol al usuario" />';
    }
}

if (isset($_POST['delete_Urol'])) {
    $idUser = $_POST['user_id'];
    $idRol = $_POST['rol_id'];
    $estado = $consulta->desactivar_UserRol($conexion, $idUser, $idRol);

    if ($estado == 'mal') {
    } else {
        echo '<meta http-equiv="refresh" content="0; url=index.php?modulo=clientes&mensaje=El rol se desactivo para el usuario" />';
    }
}

if (isset($_POST['active_Urol'])) {
    $idUser = $_POST['user_id'];
    $idRol = $_POST['rol_id'];
    $estado = $consulta->activar_UserRol($conexion, $idUser, $idRol);

    if ($estado == 'mal') {
    } else {
        echo '<meta http-equiv="refresh" content="0; url=index.php?modulo=clientes&mensaje=El rol se activo para el usuario" />';
    }
}
?>
<h2 class="text-center mt-3 h1">Usuarios</h2>
<div class="row">
    <div class="col-sm-12">
        <div class="my-3">
            <ul class="nav nav-tabs mb-2" id="adop-tables-tab" role="tablist">

                <li class="nav-item" role="solicitud">
                    <button class="nav-link active" id="usuarios-tab" data-bs-toggle="tab" data-bs-target="#usuarios" type="button" role="tab" aria-controls="usuarios" aria-selected="true">Todos los usuarios</button>
                </li>
                <li class="nav-item" role="Asigna Roles">
                    <button class="nav-link" id="asignaRol-tab" data-bs-toggle="tab" data-bs-target="#asignaRol" type="button" role="tab" aria-controls="asignaRol" aria-selected="false">Asignar Rol</button>
                </li>
            </ul>
            <div class="tab-content " id="myTabContent">
                <div class="tab-pane fade show active" id="usuarios" role="tabpanel" aria-labelledby="usuarios-tab">
                    <table class="table table-sm table-hover" id="tablaClientes">
                        <thead class="bg-danger text-white">
                            <tr>
                                <td>Usuario </td>
                                <td>Estado </td>
                                <td>Nombre </td>
                                <td>Apellido Paterno </td>
                                <td>Apellido Materno </td>
                                <td>Correo </td>
                                <td>Telefono </td>
                                <td>Fecha creación</td>
                                <td>Fecha modificación</td>
                                <td>Cambiar UsrEstado</td>
                                <td>Rol</td>
                                <td>Rol Estado</td>
                                <td>Cambiar RolEstado</td>

                            </tr>
                        </thead>
                        <tfoot class="bg-secondary text-white">
                            <tr>
                                <td>Usuario </td>
                                <td>Estado </td>
                                <td>Nombre </td>
                                <td>Apellido Paterno </td>
                                <td>Apellido Materno </td>
                                <td>Correo </td>
                                <td>Telefono </td>
                                <td>Fecha creación</td>
                                <td>Fecha modificación</td>
                                <td>Cambiar UsrEstado</td>
                                <td>Rol</td>
                                <td>Rol Estado</td>
                                <td>Cambiar RolEstado</td>

                            </tr>
                        </tfoot>
                        <tbody>
                            <?php foreach ($usuarios as $key => $value) : ?>
                                <tr class="text-center">
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
                                        <span class="btn btn-warning btn-xs" title="Cambiar contraseña"><i class="fa-solid fa-pen-to-square"></i></span>
                                    </td>
                                    <td><?php echo ($value['rol_nombre']); ?> </td>
                                    <td><?php echo ($value['usr_rol_estado']); ?> </td>                 
                                    <td>
                                <?php if ($value['usr_rol_estado'] == 'Activado') : ?>
                                    <form action="" method="post">
                                        <input type="hidden" name="user_id" value="<?= $value['usr_id']; ?>">
                                        <input type="hidden" name="rol_id" value="<?= $value['rol_id']; ?>">
                                        <button class="btn btn-danger btn-xs" name="delete_Urol" title="Desactivar Rol"><i class="fa-solid fa-power-off"></i></button>
                                    </form>
                                <?php else : ?>
                                    <form action="" method="post">
                                        <input type="hidden" name="user_id" value="<?= $value['usr_id']; ?>">
                                        <input type="hidden" name="rol_id" value="<?= $value['rol_id']; ?>">
                                        <button class="btn btn-success btn-xs" name="active_Urol" title="Activar Rol"><i class="fa-solid fa-power-off"></i></button>
                                    </form>
                                <?php endif; ?>
                            </td>

                                </tr>
                            <?php endforeach; ?>
                        </tbody>

                    </table>
                </div>
                <div class="tab-pane fade" id="asignaRol" role="tabpanel" aria-labelledby="asignaRol-tab">
                    <div class="w-75 my-5 mx-auto">
                        <form action="" method="post">
                            <label for="selectUser">Usuario</label>
                            <select class="form-select form-select-lg mb-3" aria-label="form-select-lg example" id="selectUser" name="selectUser">
                                <option selected>Open this select menu</option>
                                <?php foreach ($usuarios2 as $key => $value) : ?>
                                    <option value="<?php echo ($value['usr_id']); ?>"><?php echo ($value['usr_email']); ?></option>
                                <?php endforeach; ?>

                            </select>

                            <label for="selectRol">Rol</label>
                            <select class="form-select form-select-lg" aria-label="form-select-lg example" id="selectRol" name="selectRol">
                                <option selected>Open this select menu</option>
                                <?php foreach ($roles as $key => $value) : ?>
                                    <option value="<?php echo ($value['rol_id']); ?>"><?php echo ($value['rol_nombre']); ?></option>
                                <?php endforeach; ?>
                            </select>

                            <button type="submit" class="btn btn-primary btn-lg mt-4" name="btn_asignaRol">Asignar Rol</button>
                            <button type="reset" class="btn btn-danger btn-lg mt-4">Cancelar</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>