<?php
require_once('BL/consultas_productos.php');
$consulta = new Consulta_producto();
$productos = $consulta->listarProductos($conexion);

if (isset($_POST['delete_pdt'])) {
    $productoId = $_POST['product_id'];
    $estado = $consulta->desabilitar_producto($conexion, $productoId);

    if ($estado == 'mal') {
    } else {
        echo '<meta http-equiv="refresh" content="0; url=index.php?modulo=productos&mensaje=El producto se deshabilito" />';
    }
}

if (isset($_POST['active_pdt'])) {
    $productoId = $_POST['product_id'];
    $estado = $consulta->habilitar_producto($conexion, $productoId);

    if ($estado == 'mal') {
    } else {
        echo '<meta http-equiv="refresh" content="0; url=index.php?modulo=productos&mensaje=El producto se habilito" />';
    }
}

?>
<h2 class="text-center mt-3 h1">Productos</h2>

<a href="index.php?modulo=agrega-producto&formTipo=insertProduct" type="button" class="btn btn-primary btm-lg" data-toggle="modal" data-target="#modalProducto">
    <span>Agregar Producto <i class="fa-solid fa-circle-plus"></i></apan>
</a>
<hr>
<div class="row">
    <div class="col-sm-12">
        <div class="my-3 ">
            <table class="table table-sm table-hover" id="tablaProductos">
                <thead class="bg-danger text-white">
                    <tr>
                        <td>Producto </td>
                        <td>Estado </td>
                        <td>Categoria </td>
                        <td>Precio </td>
                        <td>Stock</td>
                        <td WIDTH="150">Detalle </td>
                        <td>Tamaño</td>
                        <td>Fecha creación</td>
                        <td>Fecha modificación</td>
                        <td>Editar</td>
                        <td>Habilitar/Deshabilitar</td>

                    </tr>
                </thead>
                <tfoot class="bg-secondary text-white">
                    <tr>
                        <td>Producto </td>
                        <td>Estado </td>
                        <td>Categoria </td>
                        <td>Precio </td>
                        <td>Stock</td>
                        <td WIDTH="150">Detalle </td>
                        <td>Tamaño</td>
                        <td>Fecha creación</td>
                        <td>Fecha modificación</td>
                        <td>Editar</td>
                        <td>Habilitar/Deshabilitar</td>

                    </tr>
                </tfoot>
                <tbody>
                    <?php foreach ($productos as $key => $value) : ?>
                        <tr class="text-center">
                            <td><?php echo ($value['product_nombre']); ?> </td>
                            <td><?php echo ($value['product_estado']); ?> </td>
                            <td><?php echo ($value['cat_nombre']); ?></td>
                            <td><?php echo ($value['product_precio']); ?> </td>
                            <td><?php echo ($value['product_stock']); ?> </td>
                            <td WIDTH="150"><?php echo ($value['product_descripcion']); ?> </td>
                            <td><?php echo ($value['product_size_perro']); ?> </td>
                            <td><?php echo ($value['product_fecha_creacion']); ?> </td>
                            <td><?php echo ($value['product_fecha_modificacion']); ?> </td>
                            <td>
                                <form action="index.php?modulo=agrega-producto&formTipo=updateProduct" method="post">
                                    <input type="hidden" name="product_id" value="<?= $value['product_id']; ?>">
                                    <button class="btn btn-warning btn-xs" name="cambiarDatosProducto" title="Cambiar datos"><i class="fa-solid fa-pen-to-square"></i></button>
                                </form>

                            </td>
                            <td>
                                <?php if ($value['product_estado'] == 'Habilitado') : ?>
                                    <form action="" method="post">
                                        <input type="hidden" name="product_id" value="<?= $value['product_id']; ?>">
                                        <button class="btn btn-danger btn-xs" name="delete_pdt" title="Deshabilitar Producto" onclick="return confirm('¿Quieres Deshabilitar este producto?')"><i class="fa-solid fa-power-off"></i></button>
                                    </form>
                                <?php else : ?>
                                    <form action="" method="post">
                                        <input type="hidden" name="product_id" value="<?= $value['product_id']; ?>">
                                        <button class="btn btn-success btn-xs" name="active_pdt" title="Habilitar Producto" onclick="return confirm('¿Quieres Habilitar este producto?')"><i class="fa-solid fa-power-off"></i></button>
                                    </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>
        </div>
    </div>
</div>