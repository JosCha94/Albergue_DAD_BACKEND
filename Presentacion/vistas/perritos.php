<?php
$rolPermitido= $log->activeRol($_SESSION['usuario'][2], $perritos);
$permisosRol = $log->activeRolPermi($_SESSION['usuario'][3], [7]);
$permisoEsp = $log->permisosEspeciales($_SESSION['usuario'][4], [7]);

// print_r($_SESSION['usuario'][3]);
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
require_once('BL/consultas_perritos.php');
require_once('DAL/conexion.php');


$consulta = new Consulta_perrito();
$perro = $consulta->listarPerritos($conexion);

?>

<h2 class="text-center mt-3 h1">Perritos</h2>
<?php if ($permisosRol == 'true' || $permisoEsp == 'true'):?>     
<a href="index.php?modulo=admin_perritos&formTipo=insertPerrito" type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modalProducto">
    <span>Agregar Perrito <i class="fa-solid fa-circle-plus"></i></apan>
</a>
<?php endif;?>
<hr>
<div class="row">
    <div class="col sm-12">
        <div class="container-tab mt-2">
            <table class="table table-sm table-hover" id="tablaPerritos">
                <thead class="bg-danger text-white text-center table-heading">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre del perro</th>
                        <th scope="col">Peso (en Kg.)</th>
                        <th scope="col">Tamaño</th>
                        <th scope="col">Fecha de nacimiento</th>
                        <th scope="col">Sexo</th>
                        <th scope="col">Nivel de actividad</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Fecha de ingreso</th>
                        <th scope="col">Fecha de modificación</th>
                        <?php if ($permisosRol == 'true' || $permisoEsp == 'true'):?>     
                        <th scope="col">editar fotos</th>
                        <th scope="col">Editar</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($perro as $key => $value) : ?>
                    <tr>
                        <td><?= $value['perro_id'] ;?></td>
                        <td><?= $value['perro_nombre'] ;?></td>
                        <td><?= $value['perro_peso'] ;?></td>
                        <td><?= $value['perro_tamano'] ;?></td>
                        <td><?= $value['perro_nacimiento'] ;?></td>
                        <td><?= $value['perro_sexo'] ;?></td>
                        <td><?= $value['perro_actividad'] ;?></td>
                        <td><?= $value['perro_descripcion'] ;?></td>
                        <td><?= $value['perro_estado'] ;?></td>
                        <td><?= $value['perro_fecha_creacion'] ;?></td>
                        <td><?= $value['perro_fecha_modificacion'] ;?></td>
                        <?php if ($permisosRol == 'true' || $permisoEsp == 'true'):?>     
                        <td class="text-center">
                            <a href="index.php?modulo=admin_perritos&formTipo=insertFoto&id=<?= urlencode(base64_encode(($value['perro_id']*489554)/7854)) ;?>" class="btn btn-warning" title="EDITAR FOTOS"><i class="fa-solid fa-file-image"></i></a>
                        </td>
                        <td>
                            <a href="index.php?modulo=admin_perritos&formTipo=updatePerrito&id=<?= urlencode(base64_encode(($value['perro_id']*489554)/7854)) ;?>" class="btn btn-warning" title="EDITAR"><i class="fa-solid fa-pen-to-square"></i></a>
                        </td>
                        <?php endif; ?>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php else : ?>
        <div class="alert alert-danger p-5 my-5" role="alert">
            <?php echo $error; ?>
        </div>
<?php endif; ?>
