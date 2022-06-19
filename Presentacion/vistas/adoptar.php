
<?php
require_once('BL/consultas_adopcion.php');
require_once('DAL/conexion.php');

$conexion = conexion::conectar();
$consulta = new Consulta_adopcion();
$adop = $consulta->ad_listar_adiociones($conexion);


?>


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
            <table id="admin-table" class="table table-striped table-bordered border-dark table-responsive">
                <thead class="table-heading">
                    <tr>
                        <th scope="col">ID solicitud</th>
                        <th scope="col">Adoptante</th>
                        <th scope="col">Razón de adopción</th>
                        <th scope="col">Fecha de solicitud</th>
                        <th scope="col">Acción a realizar</th>
                    </tr>
                </thead>
                <tbody>
                    <form action="" method="POST">
                    <?php foreach ($adop as $adopcion => $value) : ?>
                        <tr>
                            <td><input type="hidden" name="ID" value="<?= $value['adop_id']; ?>"><?= $value['adop_id']; ?></td>
                            <td><?= $value['adop_dueño']; ?></td>
                            <td><?= $value['adop_razon']; ?></td>
                            <td><?= $value['adop_fecha_creacion']; ?></td>
                            <td>
                                <div class="text-center">
                                    <a type="button" class="btn btn-primary mx-2" data-bs-toggle="modal" data-bs-target="#acpt_modal" id="acpt_soli">Aceptar </a>
                                    <a type="button" class="btn btn-danger mx-2" id="acpt_soli">Rechazar </a>
                                </div>    
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </form>    
                </tbody>
            </table>
        </div>
        <div class="tab-pane fade" id="agen_adopciones" role="tabpanel" aria-labelledby="">
            <table id="admin-table" class="table table-striped table-bordered border-dark table-responsive">
                <thead class="table-heading">
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
                    <tr>
                        <td><?= $value['adop_id']; ?></td>
                        <td><?= $value['adop_dueño']; ?></td>
                        <td><?= $value['adop_razon']; ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>        
        </div>
        <div class="tab-pane fade" id="adopciones" role="tabpanel" aria-labelledby="">
            <table id="admin-table" class="table table-striped table-bordered border-dark table-responsive">
                <thead class="table-heading">
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
                        <tr>
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

<!-- MODAL -->
<div class="modal fade" id="acpt_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <main class="form-signin">
                    <form action="" method="post">
                        <h1 class="h3 mb-3 fw-normal text-center">  Agendar entrevista</h1>
                        <div class="form-floating my-4">
                            <textarea class="form-control" id="floatingInput" rows="4" placeholder="Envia un mensaje" style="min-heigth: 100%" required></textarea>
                            <label for="floatingInput">Envia un mensaje</label>
                        </div>
                        <div class="form-floating">
                            <input type="date" name="fecha" required>
                            <input type="time" name="hora" required>                           
                        </div>
                    </form>
                </main>
            </div>
            <div class="modal-footer">
                <button class="btn btn-adopt mt-3" type="submit" name="enviar">Enviar</button>
                <button type="button" class="btn btn-secondary mt-3" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>