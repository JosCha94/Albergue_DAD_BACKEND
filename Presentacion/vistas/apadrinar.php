<?php
$rolPermitido= $log->activeRol($_SESSION['usuario'][2], $suscripciones);
$permisosRol = $log->activeRolPermi($_SESSION['usuario'][3], [5]);
$permisoEsp = $log->permisosEspeciales($_SESSION['usuario'][4], [5]);

switch ($error = 'SinError') {
    case ($logueado == 'false'):
        $error = '<meta http-equiv="refresh" content="0; url=index.php" />';
        break;
    case ($rolPermitido != 'true'):
        $error = 'Su rol actual no le otorga permisos para acceder a esta página';
        break;
}
if ($error == 'SinError') : ?>
<?php
require_once('BL/consultas_apadrinar.php');
require_once('DAL/conexion.php');

$consulta = new Consulta_suscripcion();
$sus = $consulta->listarSuscripAdmin($conexion);
$tipoSus = $consulta -> listarTipoSuscripcion($conexion);

if (isset($_POST['cancel_sus'])) {
    $id = $_POST['inpt_cancel'];
    $consulta = new Consulta_suscripcion();
    $cancel = $consulta->cancelar_suscipcion($conexion, $id);
    if(!$cancel)
    {
        echo '<div class="alert alert-danger">¡Ocurrio un error, la solicitud no pudo ser rechazada!.</div>';
    }else{
        echo "<meta http-equiv='refresh' content='2'>";
        echo '<div class="alert alert-success">¡La suscripcion fue cancelada exitosamente!.</div>';
    }
}

if (isset($_POST['habi_sus'])) {
    $id = $_POST['inpt_habil'];
    $consulta = new Consulta_suscripcion();
    $habilitar = $consulta->habilitar_suscripcion($conexion, $id);
    if(!$habilitar)
    {
        echo '<div class="alert alert-danger">¡Ocurrio un error, la solicitud no pudo ser rechazada!.</div>';
    }else{
        echo "<meta http-equiv='refresh' content='2'>";
        echo '<div class="alert alert-success">¡La Suscripción ha sido reactivada exitosamente!.</div>';
    }
}

?>


<h2 class="text-center mt-3 h1">Suscripciones</h2>
<div class="row">
    <div class="col sm-12">
        <div class="container-tab mt-5">
            <ul class="nav nav-tabs" id="adop-tables-tab" role="tablist">
                <li class="nav-item" role="solicitud">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#suscripciones" type="button" role="tab" aria-controls="" aria-selected="true">Suscripciones</button>
                </li>
                <li class="nav-item" role="Agenda de entrevistas">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#tipo_sus" type="button" role="tab" aria-controls="" aria-selected="false">Tipo de suscripción</button>
                </li>
            </ul>
            <div class="tab-content " id="myTabContent">
                <div class="tab-pane fade show active" id="suscripciones" role="tabpanel" aria-labelledby="home-tab">
                    <table id="suscip" class="table table-sm table-hover" >
                        <thead class="bg-danger text-center text-white table-heading">
                            <tr class="">
                                <th scope="col">ID</th>
                                <th scope="col">Nombre del cliente</th>
                                <th scope="col">Tipo de suscripción</th>
                                <th scope="col">Estado de la suscripción</th>
                                <th scope="col">Periodo de la suscripción</th>
                                <th scope="col">Fecha de inicio</th>
                                <th scope="col">Fecha de renovación</th>
                                <th scope="col">Fecha de expiración</th>
                                <th scope="col">Deshabilitar</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($sus as $key => $value) : ?>
                            <tr class="text-center">
                                <td><?= $value['suscrip_id'] ;?></td>
                                <td><?= $value['usr_nombres'] ;?></td>
                                <td><?= $value['tipo_id'] ;?></td>
                                <?php if($value['suscrip_estado'] == 'Cancelada'){ 
                                                echo "<td class='bg-danger text-white'>$value[suscrip_estado]</td>";
                                                
                                                }else{echo"<td class='bg-success text-white'>$value[suscrip_estado]</td>";}?>
                                <td><?= $value['suscrip_tiempo'] ;?></td>
                                <td><?= $value['suscrip_fecha_inicio'] ;?></td>
                                <td><?= $value['suscrip_fecha_renov'] ;?></td>
                                <td><?= $value['suscrip_fecha_termino'] ;?></td>
                                <td>
                                    <?php if($permisosRol == 'true' || $permisoEsp == 'true'): ?>
                                    <form action="" method="POST">
                                    <?php if($value['suscrip_estado'] == "Vigente"){ ?>
                                        <button class="btn btn-danger" title="Cancelar Suscripcion" name="cancel_sus" onclick="return checkDelete()"><i class="fa-solid fa-power-off"></i></button>
                                        <?php }else{ ?>
                                        <button class="btn btn-success" title="Habilitar Suscipción" name="habi_sus" onclick="return checkDelete()"><i class="fa-solid fa-power-off"></i></button> <?php } ?>
                                        <input type="hidden" name="inpt_cancel" value="<?= $value['suscrip_id'] ;?>">
                                        <input type="hidden" name="inpt_habil" value="<?= $value['suscrip_id'] ;?>">
                                        
                                    </form>
                                    <?php endif; ?>
                                </td>
                                
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="tipo_sus" role="tabpanel" aria-labelledby="">
                    <table id="tipoSusci" class="table table-sm table-hover">
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
                                <?php if($permisosRol == 'true' || $permisoEsp == 'true'): ?>
                                <form action="" method="POST">
                                    <td>
                                        <a href="index.php?modulo=admin_apadrinar&id=<?= urlencode(base64_encode(($value['s_tipo_id']*489554)/7854)) ;?> "class="btn btn-warning" name="edit_tipo" title="EDITAR"><i class="fa-solid fa-pen-to-square"></i></a>
                                        <input type="hidden" name="edit_tipo" value="<?= $value['s_tipo_id']; ?>">
                                    </td>
                                   
                                </form>
                                <?php endif; ?>
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