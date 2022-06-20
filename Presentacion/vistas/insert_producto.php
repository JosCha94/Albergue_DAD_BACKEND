<?php
require_once('BL/consultas_productos.php');
require_once 'ENTIDADES/producto.php';
$consulta = new Consulta_producto();
$categories = $consulta->listarCategorias($conexion);


if (isset($_POST['registro_pdt'])) {
    $category = $_POST['productCategory'];
    $product = $_POST['productName'];
    $precio = $_POST['productPrecio'];
    $stock = $_POST['productStock'];
    $descrip = $_POST['productDescripcion'];
    $sizeDog = $_POST['productSizeDog'];
    $estado = $_POST['productEstado'];
    $pdto = new Producto($category, $product, $precio, $stock, $descrip, $sizeDog, $estado);

    $consulta = new Consulta_producto();
    $errores = $consulta->Validar_registroPdt($pdto);
    if (count($errores) == 0) {
        $estado = $consulta->insetar_producto($conexion, $usu);

        if ($estado == 'mal') {
        } else {
            echo '<meta http-equiv="refresh" content="0; url=../index.php?modulo=inicio&mensaje=El Usuario se registro correctamente" />';
        }
    }
}
?>
<section id="dormRegistro" class="container-fluid mt-5">
    <div class="container">
        <div class="section-heading text-center">
            <h2>Nuevo Producto</h2>
        </div>
        <div class="row">

            <div class="col-lg-6 p-5 res-margin bg-secondary h-50 mx-auto">

                <h4 class="text-light">Nuevo Producto</h4>

                <!-- Form Starts -->
                <div id="product_form">
                    <form action="" method="post">
                        <?php if (isset($errores)) : ?>
                            <?php if (count($errores) != 0) : ?>
                                <ul class="alert alert-danger mt-3">
                                    <h1>Corregir</h1>
                                    <?php foreach ($errores as  $error) : ?>
                                        <li class="ms-2"><?= $error; ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        <?php endif; ?>
                        <div class="row">
                            <div class="col-md-12 text-light">
                                <label>Nombre Producto </label>
                                <input type="text" name="productName" class="form-control input-field" maxlength="50" minlength="5" value="<?php if (isset($product)) echo $product ?>" required>
                            </div>
                            <div class="col-md-12 text-light">
                                <label>Precio</label>
                                <input type="number" name="productPrecio" class="form-control input-field" min="0" value="<?php if (isset($precio)) echo $precio ?>" required>
                            </div>
                            <div class="col-md-12 text-light">
                                <label>Stock </label>
                                <input type="number" name="productStock" class="form-control input-field" min="0" value="<?php if (isset($stock)) echo $stock ?>" required>
                            </div>
                            <div class="col-md-12 text-light">
                                <label>Categoria </label>
                                <select class="form-select" aria-label="Default select example" name="productCategory">
                                    <option selected placeholder="Selecciona una categoria"></option>
                                    <?php foreach ($categories as $key => $value) : ?>
                                    <option value="<?= $value['cat_id']; ?>"><?= $value['cat_nombre']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-12 text-light mt-2">
                                <label>Para perritos de tamaño </label>
                                <div class="d-flex justify-content-evenly">
                                    <div class="form-check">
                                        <input class="form-check-input " value="Pequeno" type="radio" name="productSizeDog" id="RadioProductPequeno">
                                        <label class="form-check-label" for="RadioProductPequeno">
                                            Pequeño
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input " value="Mediano" type="radio" name="productSizeDog" id="RadioProductMediano">
                                        <label class="form-check-label" for="RadioProductMediano">
                                            Mediano
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input " value="Grande" type="radio" name="productSizeDog" id="RadioProductGrande">
                                        <label class="form-check-label" for="RadioProductGrande">
                                            Grande
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 text-light mt-2">
                                <label>Estado </label>
                                <div class="d-flex justify-content-evenly">
                                    <div class="form-check">
                                        <input class="form-check-input estado" type="radio" name="productEstado" id="RadioProductEstadoHab" checked>
                                        <label class="form-check-label" for="RadioProductEstadoHab" value="Habilitado">
                                            Habilitado
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input estado" type="radio" name="productEstado" id="RadioProductEstadoDes" value="Deshabilitado">
                                        <label class="form-check-label" for="RadioProductEstadoDes">
                                            Deshabilitado
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- button -->
                            <div class="mt-3 d-flex justify-content-around">
                                <button type="submit" name="registro_pdt" value="Submit" class="btn btn-donation mt-3">Agregar</button>
                                <button type="reset" id="submit_btn" value="Submit" class="btn btn-danger size-btn mt-3">Limpiar</button>
                            </div>

                    </form>
                    <!-- /form-group-->
                </div>
            </div>
            <!-- /col-lg-->
        </div>
        <!-- /row-->
    </div>
    <!-- /container-->
</section>