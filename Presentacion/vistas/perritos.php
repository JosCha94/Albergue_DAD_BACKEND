<?php
require_once('BL/consultas_perritos.php');
require_once('DAL/conexion.php');


$conexion = conexion::conectar();
$consulta = new Consulta_perrito();
$perro = $consulta->listarPerritos($conexion);

?>

<h2 class="text-center mt-3 h1">Perritos</h2>
<a href="index.php?modulo=admin_perritos&formTipo=insertPerrito" type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modalProducto">
    <span>Agregar Perrito <i class="fa-solid fa-circle-plus"></i></apan>
</a>
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
                        <th scope="col">editar fotos</th>
                        <th scope="col">Editar</th>
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
                        <td class="text-center">
                            <a href="index.php?modulo=admin_perritos&formTipo=insertFoto&id=<?= $value['perro_id'] ;?>" class="btn btn-warning" title="EDITAR FOTOS"><i class="fa-solid fa-file-image"></i></a>
                        </td>
                        <td>
                            <a href="index.php?modulo=admin_perritos&formTipo=updatePerrito&id=<?= $value['perro_id'] ;?>" class="btn btn-warning" title="EDITAR"><i class="fa-solid fa-pen-to-square"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

