<?php
$rolPermitido= $log->activeRol($_SESSION['usuario'][2], $ventas);
$permisosRol = $log->activeRolPermi($_SESSION['usuario'][3], [9]);
$permisoEsp = $log->permisosEspeciales($_SESSION['usuario'][4], [9]);

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
require_once('BL/consultas_ventas.php');
$consulta = new Consulta_ventas();
$ventas = $consulta->listarVentas($conexion);
$detalle = $consulta->detalleVenta($conexion);
?>

<h2 class="text-center mt-3 h1">Ventas</h2>

<hr>
<div class="row">
    <div class="col-sm-12 ">
        <div class="my-3 ">
            <ul class="nav nav-tabs mb-2" id="adop-tables-tab" role="tablist">
                
                <li class="nav-item" role="solicitud">
                    <button class="nav-link active" id="ventas-tab" data-bs-toggle="tab" data-bs-target="#ventas" type="button" role="tab" aria-controls="ventas" aria-selected="true">Todas las ventas</button>
                </li>
                <li class="nav-item" role="Agenda de entrevistas">
                    <button class="nav-link" id="detailVentas-tab" data-bs-toggle="tab" data-bs-target="#detalleVentas" type="button" role="tab" aria-controls="detalleVentas" aria-selected="false">Detalle de ventas</button>
                </li>
            </ul>
            <div class="tab-content " id="myTabContent">
                <div class="tab-pane fade show active" id="ventas" role="tabpanel" aria-labelledby="ventas-tab">
                    <table class="table table-sm table-hover" id="tablaVentas">
                        <thead class="bg-danger text-white">
                            <tr>
                                <td>Numero de comprobante </td>
                                <td>Usuario_id </td>
                                <td>Rol_id </td>
                                <td>Tipo de comprobante </td>
                                <td>Cliente </td>
                                <td>DNI </td>
                                <td>Correo </td>
                                <td>Serie del comprobante </td>
                                <td>Fecha</td>
                                <td>IGV</td>
                                <td>Precio total </td>
                                <td>Estado</td>

                            </tr>
                        </thead>
                        <tfoot class="bg-secondary text-white">
                            <tr>
                                <td>Numero de comprobante </td>
                                <td>Usuario_id </td>
                                <td>Rol_id </td>
                                <td>Tipo de comprobante </td>
                                <td>Cliente </td>
                                <td>DNI </td>
                                <td>Correo </td>
                                <td>Serie del comprobante </td>
                                <td>Fecha</td>
                                <td>IGV</td>
                                <td>Precio total </td>
                                <td>Estado</td>

                            </tr>
                        </tfoot>
                        <tbody>
                            <?php foreach ($ventas as $key => $value) : ?>
                                <?php $info = json_decode($value['datos_cliente']) ?>
                                <tr class="text-center">
                                    <td><?php echo ($value['pedi_id']); ?></td>
                                    <td><?php echo ($value['usr_id']); ?></td>
                                    <td><?php echo ($value['rol_id']); ?></td>
                                    <td><?php echo ($value['tipo_comprobante']); ?> </td>
                                    <td><?php echo $info->cliente; ?></td>
                                    <td><?php echo $info->dni; ?></td>
                                    <td><?php echo $info->correo; ?></td>
                                    <td><?php echo ($value['serie_comprobante']); ?> </td>
                                    <td><?php echo ($value['pedi_fecha']); ?> </td>
                                    <td><?php echo ($value['pedi_igv']); ?></td>
                                    <td><?php echo ($value['pedi_monto']); ?> </td>
                                    <td><?php echo ($value['pedi_estado']); ?> </td>

                                </tr>
                            <?php endforeach; ?>
                        </tbody>

                    </table>
                </div>
                <div class="tab-pane fade" id="detalleVentas" role="tabpanel" aria-labelledby="detalleVentas-tab">
                <table class="table table-lg table-hover wrap mx-auto w-100" id="tablaDetalleVentas">
                        <thead class="bg-danger text-white">
                            <tr>
                                <td>Id Detalle </td>
                                <td>Pedido_id </td>
                                <td>Producto_id </td>
                                <td>Precio <br>Unitario </td>
                                <td>Cantidad </td>
                                <td>Subtotal </td>
        

                            </tr>
                        </thead>
                        <tfoot class="bg-secondary text-white">
                            <tr>
                            <td>Id Detalle </td>
                                <td>Pedido_id </td>
                                <td>Producto_id </td>
                                <td>Precio <br>Unitario </td>
                                <td>Cantidad </td>
                                <td>Subtotal </td>

                            </tr>
                        </tfoot>
                        <tbody>
                            <?php foreach ($detalle as $key => $value) : ?>
                                <?php $infoDeta = json_decode($value['precioCantidad']) ?>
                                <tr class="text-center">
                                    <td><?php echo ($value['iddetalle_pedido']); ?></td>
                                    <td><?php echo ($value['pedi_id']); ?></td>
                                    <td><?php echo ($value['product_nombre']); ?></td>
                                    <td><?php echo $infoDeta->Precio; ?> </td>
                                    <td><?php echo $infoDeta->Cantidad; ?></td>
                                    <td><?php echo $infoDeta->Precio_Total; ?> </td>
                     
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