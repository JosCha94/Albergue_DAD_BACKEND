<?php
$rolPermitido= $log->activeRol($_SESSION['usuario'][2], $donaciones);


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
                            <form action="" method="POST">
                                <td><div class="foto-zoom"><img src="data:image/<?php echo($value['dona_tipo_img']);?>;base64,<?php echo base64_encode( $value['dona_vaucher']); ?>" style="width:80px;" alt="albergue"></div> </td>
                            </form>
                            <td><?php echo ($value['dona_monto']); ?> </td>
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