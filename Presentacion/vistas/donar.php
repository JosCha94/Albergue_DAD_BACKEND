<?php
require_once('BL/consultas_donacion.php');
require_once('DAL/conexion.php');

$consulta = new Consulta_donacion();
$donacion = $consulta->listarDonaciones($conexion);

?>

<h2 class="text-center mt-3 h1">Donaciones</h2>


<hr>
<div class="row">
    <div class="col-sm-12">
        <div class="my-3 ">
            <table class="table table-sm table-hover" id="tablaDonaciones">
                <thead class="bg-danger text-white">
                    <tr>
                        <td>Id </td>
                        <td>Fecha</td>
                        <td>Nombres</td>
                        <td>Apellidos</td>
                        <td>Correo</td>
                        <td>Celular</td>
                        <td>Vaucher</td>
                        <td>Monto</td>
                    </tr>
                </thead>
                <tfoot class="bg-secondary text-white">
                    <tr>
                    <td>Id </td>
                        <td>Fecha</td>
                        <td>Nombres</td>
                        <td>Apellidos</td>
                        <td>Correo</td>
                        <td>Celular</td>
                        <td>Vaucher</td>
                        <td>Monto</td>
                    </tr>
                </tfoot>
                <tbody>
                    <?php foreach ($donacion as $key => $value) : ?>
                        <tr class="text-center">
                            <td><?php echo ($value['dona_id']); ?> </td>
                            <td><?php echo ($value['dona_fecha']); ?> </td>
                            <td><?php echo ($value['dona_nombres']); ?></td>
                            <td><?php echo ($value['dona_apellidos']); ?> </td>
                            <td><?php echo ($value['dona_correo']); ?> </td>
                            <td><?php echo ($value['dona_celular']); ?> </td>
                            <td><button data-bs-toggle="modal" data-bs-target="#fotoModal"><img src="data:image/<?php echo($value['dona_tipo_img']);?>;base64,<?php echo base64_encode( $value['dona_vaucher']); ?>" style="width:80px;" alt="albergue"></button> </td>
                            <td><?php echo ($value['dona_monto']); ?> </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>
        </div>
    </div>
</div>

<!-- MODAL DE IMAGENS -->

<div class="modal fade" id="fotoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <img class = "image-fluid" src="data:image/<?php echo($value['dona_tipo_img']);?>;base64,<?php echo base64_encode( $value['dona_vaucher']); ?>" style="width:290px;" alt="albergue">              
      </div>
    </div>
  </div>
</div>
