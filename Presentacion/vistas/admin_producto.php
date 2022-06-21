<?php
require_once('BL/consultas_productos.php');
require_once 'ENTIDADES/producto.php';
$consulta = new Consulta_producto();
$categories = $consulta->listarCategorias($conexion);

$formTipo = $_GET['formTipo'] ?? '';

if ($formTipo == 'updateProduct') :
    if ($_POST['product_id'] != '') {
        $idEditProducto = $_POST['product_id'];
        $pdtID = $consulta->detalleProducto($conexion, $idEditProducto);
    }
endif;


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
        $estado = $consulta->insetar_producto($conexion, $pdto);

        if ($estado == 'fallo') {
        } else {
            echo '<meta http-equiv="refresh" content="0; url=index.php?modulo=productos&mensaje=El producto se agrego correctamente" />';
        }
    }
}

if (isset($_POST['update_pdt'])) {
    $idProduct = $_POST['productID'];
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
         $estado = $consulta->update_producto($conexion, $pdto, $idProduct);

        if ($estado == 'fallo') {
        } else {
            echo '<meta http-equiv="refresh" content="0; url=index.php?modulo=productos&mensaje=El producto se actualizo correctamente" />';
        }
    }
}

?>
<?php if ($formTipo == 'insertProduct') : ?>
    <section id="dormRegistro" class="container-fluid mt-5">
        <div class="container">
            <div class="section-heading text-center">
                <h2>Nuevo Producto</h2>
            </div>
            <div class="row">

                <div class="col-lg-6 p-5 res-margin bg-secondary bg-gradient h-50 mx-auto">

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
                                <div class="col-md-12 text-light mt-2">
                                    <label>Nombre Producto </label>
                                    <input type="text" name="productName" class="form-control input-field" maxlength="50" minlength="5" value="<?php if (isset($product)) echo $product ?>" required>
                                </div>
                                <div class="col-md-12 text-light mt-2">
                                    <label>Precio</label>
                                    <input type="number" name="productPrecio" class="form-control input-field" min="0" step="0.01" value="<?php if (isset($precio)) echo $precio ?>" required>
                                </div>
                                <div class="col-md-12 text-light mt-2">
                                    <label>Stock </label>
                                    <input type="number" name="productStock" class="form-control input-field" min="0" value="<?php if (isset($stock)) echo $stock ?>" required>
                                </div>
                                <div class="col-md-12 text-light mt-2">
                                    <label>Categoria </label>
                                    <select class="form-select" aria-label="Default select example" name="productCategory">
                                        <option selected>
                                            <!-- <?php if ($category != '') {
                                                        echo $category;
                                                    } ?> -->
                                        </option>
                                        <?php foreach ($categories as $key => $value) : ?>
                                            <option value="<?= $value['cat_id']; ?>" <?php if ($category != '' and $category == $value['cat_id']) echo 'selected' ?>><?= $value['cat_nombre']; ?></option>

                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-12 text-light mt-2">
                                    <label>Descripción del producto </label>
                                </div>
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Escribe una descripcion del producto aqui" id="productDescripcion" name="productDescripcion" style="height: 100px" required> <?php if (isset($descrip)) echo $descrip ?></textarea>
                                    <label for="productDescripcion">Escribe una descripcion del producto aqui</label>
                                </div>

                                <div class="col-md-12 text-light mt-2">
                                    <label>Para perritos de tamaño </label>
                                    <div class="d-flex justify-content-evenly">
                                        <div class="form-check">
                                            <input class="form-check-input " value="Pequeno" type="radio" name="productSizeDog" id="RadioProductPequeno" <?php if ($sizeDog == 'Pequeno') echo 'checked' ?>>
                                            <label class="form-check-label" for="RadioProductPequeno">
                                                Pequeño
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input " value="Mediano" type="radio" name="productSizeDog" id="RadioProductMediano" <?php if ($sizeDog == 'Mediano') echo 'checked' ?>>
                                            <label class="form-check-label" for="RadioProductMediano">
                                                Mediano
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input " value="Grande" type="radio" name="productSizeDog" id="RadioProductGrande" <?php if ($sizeDog == 'Grande') echo 'checked' ?>>
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
                                            <input class="form-check-input estado" type="radio" name="productEstado" id="RadioProductEstadoHab" value="Habilitado" checked>
                                            <label class="form-check-label" for="RadioProductEstadoHab">
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
    <!-- /section-->
<?php elseif ($formTipo == 'updateProduct') : ?>

    <section id="dormRegistro" class="container-fluid mt-5">
        <div class="container">
            <div class="section-heading text-center">
                <h2>Actualizacion de Producto: <br>
                <?php echo $pdtID['product_nombre'] ?> </h2>
            </div>
            <div class="row">

                <div class="col-lg-6 p-5 res-margin bg-secondary bg-gradient h-50 mx-auto">

                    <h4 class="text-light">Datos del Producto</h4>

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
                                <div class="col-md-12 text-light mt-2">
                                    <label>Nombre Producto </label>
                                    <input type="text" name="productName" class="form-control input-field" maxlength="50" minlength="5" value="<?php if (isset($product)) {echo $product;} else { echo $pdtID['product_nombre'];} ?>" required>
                                </div>
                                <div class="col-md-12 text-light mt-2">
                                    <label>Precio</label>
                                    <input type="number" name="productPrecio" class="form-control input-field" min="0" step="0.01" value="<?php if (isset($precio)) {echo $precio;} else { echo $pdtID['product_precio'];} ?>" required>
                                </div>
                                <div class="col-md-12 text-light mt-2">
                                    <label>Stock </label>
                                    <input type="number" name="productStock" class="form-control input-field" min="0" value="<?php if (isset($stock)) {echo $stock;} else { echo $pdtID['product_stock'];} ?>" required>
                                </div>
                                <div class="col-md-12 text-light mt-2">
                                    <label>Categoria </label>
                                    <select class="form-select" aria-label="Default select example" name="productCategory">
                                        <option selected>
                                        </option>
                                        <?php foreach ($categories as $key => $value) : ?>
                                            <option value="<?= $value['cat_id']; ?>" <?php 
                                            if (isset($category)){
                                                if ($category != '' and $category == $value['cat_id']) echo 'selected';
                                            }else{
                                                if ($value['cat_id'] == $pdtID['cat_id']) echo 'selected';

                                            }?>><?= $value['cat_nombre']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-12 text-light mt-2">
                                    <label>Descripción del producto </label>
                                </div>
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Escribe una descripcion del producto aqui" id="productDescripcion" name="productDescripcion" style="height: 100px" required>
                                    <?php if (isset($descrip)) {echo $descrip;} else { echo $pdtID['product_descripcion'];} ?>
                                </textarea>
                                    <label for="productDescripcion">Escribe una descripcion del producto aqui</label>
                                </div>

                                <div class="col-md-12 text-light mt-2">
                                    <label>Para perritos de tamaño </label>
                                    <div class="d-flex justify-content-evenly">
                                        <div class="form-check">
                                            <input class="form-check-input " value="Pequeno" type="radio" name="productSizeDog" id="RadioProductPequeno" <?php
                                            if (isset($sizeDog)){
                                                if ($sizeDog == 'Pequeno') echo 'checked';
                                            }else if ($pdtID['product_size_perro'] == 'Pequeno') echo 'checked' ?>>
                                            <label class="form-check-label" for="RadioProductPequeno">
                                                Pequeño
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input " value="Mediano" type="radio" name="productSizeDog" id="RadioProductMediano" <?php 
                                            if (isset($sizeDog)){
                                                if ($sizeDog == 'Mediano') echo 'checked';
                                            }else if ($pdtID['product_size_perro'] == 'Mediano') echo 'checked' ?>>
                                            <label class="form-check-label" for="RadioProductMediano">
                                                Mediano
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input " value="Grande" type="radio" name="productSizeDog" id="RadioProductGrande" <?php 
                                            if (isset($sizeDog)){
                                                if ($sizeDog == 'Grande') echo 'checked';
                                            }else if ($pdtID['product_size_perro'] == 'Grande') echo 'checked' ?>>
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
                                            <input class="form-check-input estado" type="radio" name="productEstado" id="RadioProductEstadoHab" value="Habilitado" <?php 
                                            if (isset($estado)){
                                                if ($estado == 'Habilitado') echo 'checked';
                                            }elseif ($pdtID['product_estado'] == 'Habilitado') echo 'checked' ?>>
                                            <label class="form-check-label" for="RadioProductEstadoHab">
                                                Habilitado
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input estado" type="radio" name="productEstado" id="RadioProductEstadoDes" value="Deshabilitado" <?php 
                                            if (isset($estado)){
                                                if ($estado == 'Deshabilitado') echo 'checked';
                                            }elseif ($pdtID['product_estado'] == 'Deshabilitado') echo 'checked' ?>>
                                            <label class="form-check-label" for="RadioProductEstadoDes">
                                                Deshabilitado
                                            </label>
                                        </div>
                                        <input type="hidden" name="productID" value="<?php if (isset($idProduct)) {echo $idProduct;} else {echo $pdtID['product_id'];} ?>">
                                    </div>
                                </div>

                                <!-- button -->
                                <div class="mt-3 d-flex justify-content-around">
                                    <button type="submit" name="update_pdt" value="Submit" class="btn btn-donation mt-3">Actualizar</button>
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
    <!-- /section-->

<?php endif; ?>