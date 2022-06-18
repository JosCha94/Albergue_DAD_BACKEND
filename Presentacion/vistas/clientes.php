<?php
require_once('BL/consultas_usuario.php');
$consulta = new Consulta_usuario();
$usuarios = $consulta->listarUsuarios($conexion);
?>
<h2 class="text-center mt-3 h1">Usuarios</h2>
<div class="row">
    <div class="col-sm-12">
        <div class="my-3">
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
                        <td>Editar</td>
                        <td>Deshabilitar</td>

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
                        <td>Editar</td>
                        <td>Deshabilitar</td>

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
                            <td>
                            <span class="btn btn-danger btn-xs" title="Deshabilitar Usuario"><i class="fa-solid fa-power-off"></i></span>
                        </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>
        </div>
    </div>
</div>