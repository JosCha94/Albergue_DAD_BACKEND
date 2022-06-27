
<?php
require_once('BL/consultas_apadrinar.php');
require_once('DAL/conexion.php');

$conexion = conexion::conectar();
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
        echo '<div class="alert alert-success">¡La solicitud fue rechazada exitosamente!.</div>';
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
        echo '<div class="alert alert-success">¡La solicitud fue rechazada exitosamente!.</div>';
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
                                    <form action="" method="POST">
                                    <?php if($value['suscrip_estado'] == "Vigente"){ ?>
                                        <button class="btn btn-danger" title="Cancelar Suscripcion" name="cancel_sus" onclick="return checkDelete()"><i class="fa-solid fa-power-off"></i></button>
                                        <?php }else{ ?>
                                        <button class="btn btn-success" title="Habilitar Suscipción" name="habi_sus" onclick="return checkDelete()"><i class="fa-solid fa-power-off"></i></button> <?php } ?>
                                        <input type="hidden" name="inpt_cancel" value="<?= $value['suscrip_id'] ;?>">
                                        <input type="hidden" name="inpt_habil" value="<?= $value['suscrip_id'] ;?>">
                                        
                                    </form>
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
