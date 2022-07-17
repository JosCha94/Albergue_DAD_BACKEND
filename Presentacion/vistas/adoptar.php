<?php
$rolPermitido= $log->activeRol($_SESSION['usuario'][2], $adopciones);
$permisosRol = $log->activeRolPermi($_SESSION['usuario'][3], [8]);
$permisoEsp = $log->permisosEspeciales($_SESSION['usuario'][4], [8]);

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
require_once('BL/consultas_adopcion.php');
require_once('DAL/conexion.php');

$conexion = conexion::conectar();
$consulta = new Consulta_adopcion();
$adop = $consulta->ad_listar_adopciones($conexion);
$entrevista = $consulta->ad_listar_entrevista($conexion);
$final = $consulta->ad_listar_finalizadas($conexion);
$visita = $consulta ->listar_visitas($conexion);

if(isset($_POST['acp_modal'])){
    $id= $_POST['value_modal'];
    $consulta = new Consulta_adopcion();
    $data = $consulta->mostrar_datosAdo($conexion, $id);

}


if (isset($_POST['btn_rechazar'])) {
    $id = $_POST['recha_value'];
    $consulta = new Consulta_adopcion();
    $rechazar = $consulta->rechazar_adopcion($conexion, $id);
    if(!$rechazar)
    {
        echo '<div class="alert alert-danger">¡Ocurrio un error, la solicitud no pudo ser rechazada!.</div>';
    }else{
        echo "<meta http-equiv='refresh' content='2'>";
        echo '<div class="alert alert-success">¡La solicitud fue rechazada exitosamente!.</div>';
    }
}




?>

<h2 class="text-center mt-3 h1">Adopciones</h2>
<div class="row">
    <div class="col sm-12">
        <div class="container-tab mt-5">
            <ul class="nav nav-tabs" id="adop-tables-tab" role="tablist">
                <li class="nav-item" role="solicitud">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#tabSolicitudesAdop" type="button" role="tab" aria-controls="solicitudes" aria-selected="true">Solicitudes de adopción</button>
                </li>
                <li class="nav-item" role="Agenda de entrevistas">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#tabAgendaAdop" type="button" role="tab" aria-controls="adopciones" aria-selected="false">Agenda de entrevistas</button>
                </li>
                <li class="nav-item" role="Adopciones finalizadas">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#tabAdopFinal" type="button" role="tab" aria-controls="adopciones" aria-selected="false">Adopciones finalizadas</button>
                </li>
                <li class="nav-item" role="Adopciones finalizadas">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#tabVisitas" type="button" role="tab" aria-controls="adopciones" aria-selected="false">Visitas a adoptantes</button>
                </li>
            </ul>
            <div class="tab-content " id="myTabContent">
                <div class="tab-pane fade show active" id="tabSolicitudesAdop" role="tabpanel" aria-labelledby="home-tab">
                    <table id="solicitudesAdop" class="table table-sm table-hover">
                        <thead class="bg-danger text-white table-heading">
                            <tr>
                                <th scope="col">ID solicitud</th>
                                <th scope="col">Adoptante</th>
                                <th scope="col">Razón de adopción</th>
                                <th scope="col">Fecha de solicitud</th>
                                <th scope="col">Nombre del Perro</th>
                                <th scope="col">Acción a realizar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($adop as $adopcion => $value) : ?>
                            <tr class="text-center">
                                <td><?= $value['adop_id']; ?></td>
                                <td><?= $value['adop_dueño']; ?></td>
                                <td><?= $value['adop_razon']; ?></td>
                                <td><?= $value['adop_fecha_creacion']; ?></td>
                                <td><?= $value['perro_nombre']; ?></td>
                                <?php if ($permisosRol == 'true' || $permisoEsp == 'true'):?>     
                                <td class="text-center">
                                    <a href="index.php?modulo=admin_adoptar&formTipo=gestEntrevista&id=<?= urlencode(base64_encode(($value['adop_id']*94269456)/8752)); ?>" class="btn btn-primary p-2" ><i class="mx-2 fa-solid fa-list-check"></i>Gestionar </a>
                                </td>
                                <?php endif; ?>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="tabAgendaAdop" role="tabpanel" aria-labelledby="">
                    <table id="agendaAdop" class="table table-sm table-hover">
                        <thead class="table-heading text-white bg-danger">
                            <tr>
                                <th scope="col">ID adopción</th>
                                <th scope="col">Adoptante</th>
                                <th scope="col">Nombre del perro</th>
                                <th scope="col">Razón de adopción</th>
                                <th scope="col">Fecha de entrevista</th>
                                <th scope="col">Fecha de solicitud</th>
                                <th scope ="col">Aceptar</th>
                                <th scope="col">Rechazar</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($entrevista as $adopcion => $value) : ?>
                            <tr class="text-center">
                                <td><?= $value['adop_id']; ?></td>
                                <td><?= $value['adop_dueño']; ?></td>
                                <td><?= $value['perro_nombre']; ?></td>
                                <td><?= $value['adop_razon']; ?></td>
                                <td><?= $value['adop_fecha_entrevista']; ?></td>
                                <td><?= $value['adop_fecha_creacion']; ?></td>
                                <td>
                                    <a href="index.php?modulo=admin_adoptar&formTipo=acptAdop&id=<?= urlencode(base64_encode( ($value['adop_id']*94269456)/8752)); ?>" class="btn btn-success mt-3 ms-3" name= "btn_aceptar"><i class="fa-solid fa-check"></i></a>
                                </td>
                                <td>
                                <form action="" method="post">
                                    <button class="btn btn-danger mt-3 ms-3" name= "btn_rechazar" onclick="return checkDelete()" ><i class="fa-solid fa-circle-minus"></i></button>
                                    <input type="hidden" name="recha_value" value="<?= $value['adop_id']; ?>">
                                </form>
                                </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>        
                </div>
                <div class="tab-pane fade" id="tabAdopFinal" role="tabpanel" aria-labelledby="">
                    <table id="adopFinal" class="table table-sm table-hover">
                        <thead class="table-heading text-white bg-danger">
                            <tr class="text-center">
                                <th scope="col">ID adopción</th>
                                <th scope="col">Adoptante</th>
                                <th scope="col">Razón de adopción</th>
                                <th scope="col">Nombre del perro</th>
                                <th scope="col">Observaciones</th>
                                <th scope="col">Fecha de solicitud</th>
                                <th scope="col">Estado de adopción</th>
                                <th scope="col">Fecha de adopción</th>
                                <th scope="col">Fecha de actualización</th>
                                <th scope="col">Visitas</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($final as $adopcion => $value) : ?>
                                <tr class="text-center">
                                    <td><?= $value['adop_id'] ?></td>
                                    <td><?= $value['adop_dueño'] ?></td>
                                    <td><?= $value['adop_razon'] ?></td>
                                    <td><?= $value['perro_nombre'] ?></td>
                                    <td><?= $value['adop_observaciones'] ?></td>
                                    <td><?= $value['adop_fecha_creacion'] ?></td>
                                    <?php if($value['adop_estado'] == 'Rechazada'){ 
                                                echo "<td class='bg-danger text-white'>$value[adop_estado]</td>";
                                                
                                                }else{echo"<td class='bg-success text-white'>$value[adop_estado]</td>";}?>
                                    <td><?= $value['adop_fecha'] ?></td>
                                    <td><?= $value['adop_fecha_cambio'] ?></td>
                                    <?php if($value['adop_estado'] == 'Vigente'){ ?>
                                    <td class="text-center">
                                        <a href="index.php?modulo=admin_adoptar&formTipo=editVisita&id=<?= urlencode(base64_encode(($value['adop_id']*94269456)/8752)); ?>" class="btn btn-warning" title="EDITAR VISITAS"><i class="fa-solid fa-dog"></i></a>
                                    </td>
                                    <?php }else{ ?>
                                    <td class="text-center">
                                        --
                                    </td>  
                                    <?php } ?>
                                </tr>
                            <?php endforeach; ?>  
                        </tbody>
                    </table>        
                </div>
                <div class="tab-pane fade" id="tabVisitas" role="tabpanel" aria-labelledby="">
                    <table id="Visitas" class="table table-sm table-hover">
                        <thead class="table-heading text-white bg-danger">
                            <tr class="text-center">
                                <th scope="col">ID visita</th>
                                <th scope="col">Adoptante</th>
                                <th scope="col">fecha de adopción</th>
                                <th scope="col">Estado de adopción</th>
                                <th scope="col">Nombre del perrito</th>
                                <th scope="col">Perro estado</th>
                                <th scope="col">Observaciones de Visita</th>
                                <th scope="col">Fecha de visita</th>
                                <th scope="col">encargado de visita</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($visita as $adopcion => $value) : ?>
                                <tr class="text-center">
                                    <td><?= $value['id'] ?></td>
                                    <td><?= $value['adop_dueño'] ?></td>
                                    <td><?= $value['adop_fecha'] ?></td>
                                    <td><?= $value['adop_estado'] ?></td>
                                    <td><?= $value['perro_nombre'] ?></td>
                                    <td><?= $value['perro_estado'] ?></td>
                                    <td><?= $value['comentarios_visita'] ?></td>
                                    <td><?= $value['fecha_visita'] ?></td>
                                    <td><?= $value['usuario'] ?></td>
                                   
                                </tr>
                            <?php endforeach; ?>  
                        </tbody>
                    </table>        
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