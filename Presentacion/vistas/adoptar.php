
<?php
require_once('BL/consultas_adopcion.php');
require_once('DAL/conexion.php');

$conexion = conexion::conectar();
$consulta = new Consulta_adopcion();
$adop = $consulta->ad_listar_adiociones($conexion);


?>

<h2 class="text-center mt-3 h1">Adopciones</h2>
<div class="row">
    <div class="col sm-12">
        <div class="container-tab mt-5">
            <ul class="nav nav-tabs" id="adop-tables-tab" role="tablist">
                <li class="nav-item" role="solicitud">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#solicitudes" type="button" role="tab" aria-controls="solicitudes" aria-selected="true">Solicitudes de adopción</button>
                </li>
                <li class="nav-item" role="Agenda de entrevistas">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#agen_adopciones" type="button" role="tab" aria-controls="adopciones" aria-selected="false">Agenda de entrevistas</button>
                </li>
                <li class="nav-item" role="Adopciones finalizadas">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#adopciones" type="button" role="tab" aria-controls="adopciones" aria-selected="false">Adopciones finalizadas</button>
                </li>
            </ul>
            <div class="tab-content " id="myTabContent">
                <div class="tab-pane fade show active" id="solicitudes" role="tabpanel" aria-labelledby="home-tab">
                    <table id="tablaAdop" class="table table-sm table-hover">
                        <thead class="bg-danger text-white table-heading">
                            <tr>
                                <th scope="col">ID solicitud</th>
                                <th scope="col">Adoptante</th>
                                <th scope="col">Razón de adopción</th>
                                <th scope="col">Fecha de solicitud</th>
                                <th scope="col">Acción a realizar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($adop as $adopcion => $value) : ?>
                            <tr class="text-center">
                                <td><input type="hidden" name="ID" value="<?= $value['adop_id']; ?>"><?= $value['adop_id']; ?></td>
                                <td><?= $value['adop_dueño']; ?></td>
                                <td><?= $value['adop_razon']; ?></td>
                                <td><?= $value['adop_fecha_creacion']; ?></td>
                                <td>
                                    <div class="text-center">
                                        <a href="index.php?modulo=adoptar-update&id=<?= $value['adop_id']; ?>" type="button" class="btn btn-primary p-2" ><i class="mx-2 fa-solid fa-list-check"></i>Gestionar </a>
                                    </div>    
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="agen_adopciones" role="tabpanel" aria-labelledby="">
                    <table id="tablaAdop" class="table table-sm table-hover">
                        <thead class="table-heading text-white bg-danger">
                            <tr>
                                <th scope="col">ID adopción</th>
                                <th scope="col">Adoptante</th>
                                <th scope="col">Razón de adopción</th>
                                <th scope="col">Fecha de entrevista</th>
                                <th scope="col">Fecha de solicitud</th>
                                <th scope="col">Link de reunión</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($adop as $adopcion => $value) : ?>
                            <tr class="text-center">
                                <td><?= $value['adop_id']; ?></td>
                                <td><?= $value['adop_dueño']; ?></td>
                                <td><?= $value['adop_razon']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>        
                </div>
                <div class="tab-pane fade" id="adopciones" role="tabpanel" aria-labelledby="">
                    <table id="tablaAdop" class="table table-sm table-hover">
                        <thead class="table-heading text-white bg-danger">
                            <tr>
                                <th scope="col">ID adopción</th>
                                <th scope="col">Adoptante</th>
                                <th scope="col">Razón de adopción</th>
                                <th scope="col">Fecha de entrevista</th>
                                <th scope="col">Observaciones</th>
                                <th scope="col">Fecha de solicitud</th>
                                <th scope="col">Fecha de última visita</th>
                                <th scope="col">Observaciones de visitas</th>
                                <th scope="col">Estado de adopción</th>
                                <th scope="col">Fecha de adopción</th>
                                <th scope="col">Fecha de actualización</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($adop as $adopcion => $value) : ?>
                                <tr class="text-center">
                                    <td><?= $value['adop_id'] ?><</td>
                                    <td><?= $value['adop_dueño'] ?></td>
                                    <td><?= $value['adop_razon'] ?></td>
                                    <td><?= $value['adop_fecha_entrevista'] ?></td>
                                    <td><?= $value['adop_observaciones'] ?></td>
                                    <td><?= $value['adop_fecha_creacion'] ?></td>
                                    <td><?= $value['adop_ultima_visita'] ?></td>
                                    <td><?= $value['adop_resumen_visitas'] ?></td>
                                    <td><?= $value['adop_estado'] ?></td>
                                    <td><?= $value['adop_fecha'] ?></td>
                                    <td><?= $value['adop_fecha_cambio'] ?></td>
                                </tr>
                            <?php endforeach; ?>  
                        </tbody>
                    </table>        
                </div>
            </div>
        </div>
    </div>
</div>

