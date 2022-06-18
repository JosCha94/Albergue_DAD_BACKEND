<?php
require_once('BL/consultas_productos.php');
$consulta = new Consulta_producto();
$productos = $consulta->listarProductos($conexion);
?>
<h2 class="text-center mt-3 h1">Productos</h2>
<button type="button" class="btn btn-primary btm-lg" data-toggle="modal" data-target="#modalProducto">
<span>Agregar Producto  <i class="fa-solid fa-circle-plus"></i></apan> 
</button>
<hr>
<div class="row">
    <div class="col-sm-12">
        <div class="my-3">
            <table class="table table-sm table-hover" id="tablaProductos">
                <thead class="bg-danger text-white">
                    <tr>
                        <td>Producto </td>
                        <td>Estado </td>
                        <td>Categoria </td>
                        <td>Precio </td>
                        <td>IGV </td>
                        <td>Stock</td>
                        <td WIDTH="150">Detalle </td>
                        <td>Tamaño</td>
                        <td>Fecha creación</td>
                        <td>Fecha modificación</td>
                        <td>Editar</td>
                        <td>Habilitar/Deshabilitar</td>
                        <!-- <td>Habilitar</td> -->

                    </tr>
                </thead>
                <tfoot class="bg-secondary text-white">
                    <tr>
                        <td>Producto </td>
                        <td>Estado </td>
                        <td>Categoria </td>
                        <td>Precio </td>
                        <td>IGV </td>
                        <td>Stock</td>
                        <td WIDTH="150">Detalle </td>
                        <td>Tamaño</td>
                        <td>Fecha creación</td>
                        <td>Fecha modificación</td>
                        <td>Editar</td>
                        <td>Habilitar/Deshabilitar</td>
                        <!-- <td>Habilitar</td> -->

                    </tr>
                </tfoot>
                <tbody>
                    <?php foreach ($productos as $key => $value) : ?>
                        <tr class="text-center">
                            <td><?php echo ($value['product_nombre']); ?> </td>
                            <td><?php echo ($value['product_estado']); ?> </td>
                            <td><?php echo ($value['cat_nombre']); ?></td>
                            <td><?php echo ($value['product_precio']); ?> </td>
                            <td><?php echo ($value['product_igv']); ?> </td>
                            <td><?php echo ($value['product_stock']); ?> </td>
                            <td WIDTH="150"><?php echo ($value['product_descripcion']); ?> </td>
                            <td><?php echo ($value['product_size_perro']); ?> </td>
                            <td><?php echo ($value['product_fecha_creacion']); ?> </td>
                            <td><?php echo ($value['product_fecha_modificacion']); ?> </td>
                            <td>
                                <span class="btn btn-warning btn-xs mt-4" title="Cambiar datos"><i class="fa-solid fa-pen-to-square"></i></span>
                            </td>
                            <td>
                                <?php if($value['product_estado'] == 'Habilitado'): ?>
                            <span class="btn btn-danger btn-xs mt-4" title="Deshabilitar Producto"><i class="fa-solid fa-power-off"></i></span>
                            <?php else: ?>
                                <span class="btn btn-success btn-xs mt-4" title="Habilitar Producto"><i class="fa-solid fa-power-off"></i></span>
                            <?php endif; ?>
                        </td>
                        <!-- <td>
                            <span class="btn btn-success btn-xs" title="Habilitar Usuario"><i class="fa-solid fa-power-off"></i></span>
                        </td> -->
                        </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>
        </div>
    </div>
</div>