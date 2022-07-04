<?php
require_once('BL/consultas_productos.php');
$consulta = new Consulta_producto();
$consulta2 = new Consulta_categoria();
$productos = $consulta->listarProductos($conexion);
$categorias = $consulta2->listarCategorias($conexion);

if (isset($_POST['cambia_estado_pdt'])) {
    $productoId = $_POST['product_id'];
    $P_estado = $_POST['product_estado'];
    $Pestado = $consulta->cambia_estado_producto($conexion, $productoId, $P_estado);

    if ($Pestado == 'mal') {
    } else {
        echo '<meta http-equiv="refresh" content="0; url=index.php?modulo=productos&mensaje=El estado del producto ha cambiado" />';
    }
}

if (isset($_POST['cambia_estado_categoria'])) {
    $cat_Id = $_POST['cat_id'];
    $C_estado = $_POST['cat_estado'];
    $Cestado = $consulta2->cambia_estado_categoria($conexion, $cat_Id, $C_estado);

    if ($Cestado == 'mal') {
    } else {
        echo '<meta http-equiv="refresh" content="0; url=index.php?modulo=productos&mensaje=El estado de la categoria ha cambiado" />';
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
                                <form action="" method="post">
                                    <input type="hidden" name="product_estado" value="<?= $value['product_estado']; ?>">
                                    <input type="hidden" name="product_id" value="<?= $value['product_id']; ?>">
                                    <button class="btn <?php echo ($value['product_estado'] == 'Habilitado') ? 'btn-danger' : 'btn-success' ?> btn-xs" name="cambia_estado_pdt" title="<?php echo ($value['product_estado'] == 'Habilitado') ? 'Deshabilitar' : 'Habilitar' ?> Producto" onclick="return confirm('¿Quieres <?php echo ($value['product_estado'] == 'Habilitado') ? 'Deshabilitar' : 'Habilitar' ?> este producto?')"><i class="fa-solid fa-power-off"></i></button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>
        </div>
    </div>
</div>
<!-- CATEGORIAS -->
<h2 class="text-center mt-3 h1">Categorias</h2>

<a href="index.php?modulo=agrega-categoria&formTipo=insertCategoria" type="button" class="btn btn-primary btm-lg" data-toggle="modal" data-target="#modalProducto">
    <span>Agregar Categoria <i class="fa-solid fa-circle-plus"></i></apan>
</a>

<hr>
<div class="row">
    <div class="col-sm-12">
        <div class="my-3 ">
            <table class="table table-sm table-hover" id="tablaRoles">
                <thead class="bg-danger text-white">
                    <tr>
                        <td>Categoria </td>
                        <td>descripcón </td>
                        <td>Estado </td>
                        <td>Fecha creacón </td>
                        <td>Fecha modificación</td>
                        <td>Editar</td>
                        <td>Cambiar estado</td>

                    </tr>
                </thead>
                <tfoot class="bg-secondary text-white">
                    <tr>
                        <td>Categoria </td>
                        <td>descripcón </td>
                        <td>Estado </td>
                        <td>Fecha creacón </td>
                        <td>Fecha modificación</td>
                        <td>Editar</td>
                        <td>Cambiar estado</td>

                    </tr>
                </tfoot>
                <tbody>
                    <?php foreach ($categorias as $key => $value) : ?>
                        <tr class="text-center">
                            <td><?php echo ($value['cat_nombre']); ?> </td>
                            <td><?php echo ($value['cat_descripcion']); ?> </td>
                            <td><?php echo ($value['cat_estado']); ?></td>
                            <td><?php echo ($value['cat_fecha_creacion']); ?> </td>
                            <td><?php echo ($value['cat_fecha_cambio']); ?> </td>
                            <td>
                                <form action="index.php?modulo=agrega-categoria&formTipo=updateCategoria" method="post">
                                    <input type="hidden" name="cat_id" value="<?= $value['cat_id']; ?>">
                                    <button class="btn btn-warning btn-xs" name="cambiarDatosCategoria" title="Cambiar datos"><i class="fa-solid fa-pen-to-square"></i></button>
                                </form>

                            </td>
                            <td>
                                <form action="" method="post">
                                    <input type="hidden" name="cat_estado" value="<?= $value['cat_estado']; ?>">
                                    <input type="hidden" name="cat_id" value="<?= $value['cat_id']; ?>">
                                    <button class="btn <?php echo ($value['cat_estado'] == 'Activado') ? 'btn-danger' : 'btn-success' ?> btn-xs" name="cambia_estado_categoria" title="<?php echo ($value['cat_estado'] == 'Activado') ? 'Desactivar' : 'Activar' ?> Producto" onclick="return confirm('¿Quieres <?php echo ($value['cat_estado'] == 'Activado') ? 'Desactivar' : 'Activar' ?> esta categoria?')"><i class="fa-solid fa-power-off"></i></button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>
        </div>
    </div>
</div>