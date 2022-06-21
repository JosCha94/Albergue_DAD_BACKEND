
<?php
require_once('BL/consultas_apadrinar.php');
require_once('DAL/conexion.php');

$conexion = conexion::conectar();
$consulta = new Consulta_suscripcion();
$sus = $consulta->listarSuscripAdmin($conexion);
$tipoSus = $consulta -> listarTipoSuscripcion($conexion);
?>


<h2 class="text-center mt-3 h1">Suscripciones</h2>
<div class="row">
    <div class="col sm-12">
        <div class="container-tab mt-5">
            <ul class="nav nav-tabs" id="adop-tables-tab" role="tablist">
                <li class="nav-item" role="solicitud">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#suscripciones" type="button" role="tab" aria-controls="solicitudes" aria-selected="true">Suscripciones</button>
                </li>
                <li class="nav-item" role="Agenda de entrevistas">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#tipo_sus" type="button" role="tab" aria-controls="adopciones" aria-selected="false">Tipo de suscripción</button>
                </li>
            </ul>
            <div class="tab-content " id="myTabContent">
                <div class="tab-pane fade show active" id="suscripciones" role="tabpanel" aria-labelledby="home-tab">
                    <table class="table table-sm table-hover" id="tablaSuscrip">
                        <thead class="bg-danger text-center text-white table-heading">
                            <tr class="text-center">
                                <th scope="col">ID</th>
                                <th scope="col">Nombre del cliente</th>
                                <th scope="col">Tipo de suscripción</th>
                                <th scope="col">Estado de la suscripción</th>
                                <th scope="col">Periodo de la suscripción</th>
                                <th scope="col">Fecha de inicio</th>
                                <th scope="col">Fecha de renovación</th>
                                <th scope="col">Fecha de expiracioón</th>
                                <th scope="col">Editar</th>
                                <th scope="col">Deshabilitar</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($sus as $key => $value) : ?>

                            <tr class="text-center">
                                <td><?= $value['suscrip_id'] ;?></td>
                                <td><?= $value['usr_nombres'] ;?></td>
                                <td><?= $value['tipo_id'] ;?></td>
                                <td><?= $value['suscrip_estado'] ;?></td>
                                <td><?= $value['suscrip_tiempo'] ;?></td>
                                <td><?= $value['suscrip_fecha_inicio'] ;?></td>
                                <td><?= $value['suscrip_fecha_renov'] ;?></td>
                                <td><?= $value['suscrip_fecha_termino'] ;?></td>
                                <td>
                                    <span class="btn btn-warning btn-xs" title="Editar"><i class="fa-solid fa-pen-to-square"></i></span>
                                </td>
                                <td>
                                    <span class="btn btn-danger btn-xs" title="Desabilitar perrito"><i class="fa-solid fa-power-off"></i></span>
                                </td>
                        <?php endforeach; ?>
                                    
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="tipo_sus" role="tabpanel" aria-labelledby="">
                    <table id="tablaAdop" class="table table-sm table-hover">
                        <thead class="table-heading text-center text-white bg-danger">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Nombre de suscripción</th>
                                <th scope="col">Descripción</th>
                                <th scope="col">Precio</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Fecha de creación</th>
                                <th scope="col">Fecha de cambio</th>
                                <th scope="col">Editar</th>
                                <th scope="col">Deshabilitar</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($tipoSus as $adopcion => $value) : ?>
                            <tr class="text-center">
                                <td><?= $value['s_tipo_id']; ?></td>
                                <td><?= $value['s_tipo_nombre']; ?></td>
                                <td><?= $value['s_tipo_descripcion']; ?></td>
                                <td><?= $value['s_tipo_precio']; ?></td>
                                <td><?= $value['s_tipo_estado']; ?></td>
                                <td><?= $value['s_tipo_fecha_creacion']; ?></td>
                                <td><?= $value['s_tipo_fecha_cambio']; ?></td>
                                <td>
                                    <span class="btn btn-warning btn-xs" title="Editar"><i class="fa-solid fa-pen-to-square"></i></span>
                                </td>
                                <td>
                                    <span class="btn btn-danger btn-xs" title="Desabilitar perrito"><i class="fa-solid fa-power-off"></i></span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>        
                </div>
            </div>
        </div>
    </div>
</div>
