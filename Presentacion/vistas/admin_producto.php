<?php
$rolPermitido= $log->activeRol($_SESSION['usuario'][2], [5]);
$permisosRol = $log->activeRolPermi($_SESSION['usuario'][3], [9]);
$permisoEsp = $log->permisosEspeciales($_SESSION['usuario'][4], [9]);

switch ($error = 'SinError') {
    case ($logueado == 'false'):
        $error = 'Debe iniciar sesión para poder visualizar este pagina';
        break;
    case ($rolPermitido != 'true'):
        $error = 'Su rol actual no le otorga permisos para acceder a esta página';
        break;
}?>
<?php if ($error == 'SinError') : ?>
<?php
require_once('BL/consultas_productos.php');
require_once 'ENTIDADES/producto.php';
require_once 'ENTIDADES/img_productos.php';
$consulta = new Consulta_producto();
$categories = $consulta->listarCategorias($conexion);


$formTipo = $_GET['formTipo'] ?? '';

if ($formTipo == 'updateProduct') :

    if ($_POST['product_id'] != '') {
        $idEditProducto = $_POST['product_id'];
        $_SESSION['usuario'][6] = $idEditProducto;
        $pdtID = $consulta->detalleProducto($conexion, $idEditProducto);
        $pdtImgID = $consulta->listarImgProducto($conexion, $idEditProducto);
    } else {
        $pdtImgID = $consulta->listarImgProducto($conexion, $_SESSION['usuario'][6]);
        $pdtID = $consulta->detalleProducto($conexion, $_SESSION['usuario'][6]);
    }
endif;

$idpdt =  $_SESSION['usuario'][6];


if (isset($_POST['registro_pdt'])) {
    $category = $_POST['productCategory'];
    $product = $_POST['productName'];
    $precio = $_POST['productPrecio'];
    $stock = $_POST['productStock'];
    $descrip = $_POST['productDescripcion'];
    $sizeDog = $_POST['productSizeDog'];
    $estado = $_POST['productEstado'];
    $pdto = new Producto($category, $product, $precio, $stock, $descrip, $sizeDog, $estado);

    // $consulta = new Consulta_producto();
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

    // $consulta = new Consulta_producto();
    $errores = $consulta->Validar_registroPdt($pdto);
    if (count($errores) == 0) {
        $estado = $consulta->update_producto($conexion, $pdto, $idProduct);

        if ($estado == 'fallo') {
        } else {
            echo '<meta http-equiv="refresh" content="0; url=index.php?modulo=productos&mensaje=El producto se actualizo correctamente" />';
        }
    }
}

if (isset($_POST['guardarImgPdt'])) {

    $data = $_FILES['foto'];
    $foto = file_get_contents($_FILES['foto']['tmp_name']);
    $fotoName = $_FILES['foto']['name'];
    $fotoType = $_FILES['foto']['type'];
    $fotoError = $_FILES['foto']['error'];
    $fotoPeso = $_FILES['foto']['size'];
    $ext = explode('.', $fotoName);
    $extR = strtolower(end($ext));

    $permitir = array('jpg', 'jpeg', 'png');
    if (in_array($extR, $permitir)) {
        if ($fotoError === 0) {
            if ($fotoPeso < 5000000) {
                $fotoNombreNew = uniqid('', true) . "." . $extR;
            } else {
                echo '<div class="alert alert-danger alert-dismissible fade show " role="alert">¡El archivo es muy grande!. <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></div>';
            }
        } else {
            echo '<div class="alert alert-danger alert-dismissible fade show " role="alert">¡Hubo un error al cargar la foto! <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></div>';
        }
    } else {
        echo '<div class="alert alert-danger alert-dismissible fade show " role="alert">¡No tienes permitido añadir archivos de ese tipo!. <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    }

    $img = new img_producto($idpdt, $fotoNombreNew, $foto, $extR);
    $consulta = new Consulta_producto();
    $estado = $consulta->insertar_fotoProducto($conexion, $img);
    if ($estado == 'fallo') {
        // echo '<meta http-equiv="refresh" content="0; url=index.php?modulo=agrega-producto&formTipo=updateProduct&error=La imagen del producto no se agrego correctamente" />';
    } else {
        echo '<meta http-equiv="refresh" content="0; url=index.php?modulo=agrega-producto&formTipo=updateProduct&mensaje=La imagen del producto se agrego correctamente" />';
    }
}

if (isset($_POST['delete_ImgPdt'])) {
    $idImg = $_POST['img_id'];
    $estado = $consulta->eliminarImgProducto($conexion, $idImg);

    if ($estado == 'fallo') {
    } else {
        echo '<meta http-equiv="refresh" content="0; url=index.php?modulo=agrega-producto&formTipo=updateProduct&mensaje=La imagen del producto se elimino correctamente" />';
    }
}

if (isset($_POST['update_estado_ImgPdt'])) {
    $idImg = $_POST['img_id'];
    $ImgEstado =  $_POST['imgProductEstado'. $idImg];
    if ($ImgEstado == 'Activado') {
        $estadoImg = $consulta->cambia_estado_Imgproducto_Acti($conexion, $idImg);
    } else {
        $estadoImg = $consulta->cambia_estado_Imgproducto_Desac($conexion, $idImg);
    }
    if ($estadoImg == 'bien') {
        echo '<meta http-equiv="refresh" content="0; url=index.php?modulo=agrega-producto&formTipo=updateProduct&mensaje=La visibilidad de la imagen se actualizo correctamente" />';
    } else {
        // echo '<meta http-equiv="refresh" content="0; url=index.php?modulo=agrega-producto&formTipo=updateProduct&error=No se pudo cambiar la visibilidad de la imagen del producto" />';
    }
}

?>


<?php if ($formTipo == 'insertProduct') : ?>
    <section id="dormRegistro" class="container-fluid mt-5">

        <div class="section-heading text-center">
            <h2>Nuevo Producto</h2>
        </div>
        <div class="row">

            <div class="col-lg-6 p-4 p-md-5 res-margin shadow-lg bg-opacity-75 h-50 mx-auto">

                <h4 class="text-dark">Nuevo Producto</h4>

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
                            <div class="col-md-12 text-dark mt-2">
                                <label class="txt_form">Nombre Producto </label>
                                <input type="text" name="productName" class="form-control input-field" maxlength="50" minlength="5" value="<?php if (isset($product)) echo $product ?>" required>
                            </div>
                            <div class="col-md-12 text-dark mt-2">
                                <label class="txt_form">Precio</label>
                                <input type="number" name="productPrecio" class="form-control input-field" min="0" step="0.01" value="<?php if (isset($precio)) echo $precio ?>" required>
                            </div>
                            <div class="col-md-12 text-dark mt-2">
                                <label class="txt_form">Stock </label>
                                <input type="number" name="productStock" class="form-control input-field" min="0" value="<?php if (isset($stock)) echo $stock ?>" required>
                            </div>
                            <div class="col-md-12 text-dark mt-2">
                                <label class="txt_form">Categoria </label>
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
                            <div class="col-md-12 text-dark mt-2">
                                <label class="txt_form">Descripción del producto </label>
                            </div>
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Escribe una descripcion del producto aqui" id="productDescripcion" name="productDescripcion" style="height: 100px" required> <?php if (isset($descrip)) echo $descrip ?></textarea>
                                <label for="productDescripcion">Escribe una descripcion del producto aqui</label>
                            </div>

                            <div class="col-md-12 text-dark mt-2">
                                <label class="txt_form">Para perritos de tamaño </label>
                                <div class="d-flex justify-content-evenly">
                                    <div class="form-check">
                                        <input class="form-check-input " value="Pequeno" type="radio" name="productSizeDog" id="RadioProductPequeno" <?php if ($sizeDog == 'Pequeno') echo 'checked' ?>>
                                        <label class="form-check-label" for="RadioProductPequeno">
                                            Pequeño
                                        </label>
                                    </div>
                                    <div class="form-check mx-3">
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
                            <div class="col-md-12 text-dark mt-2">
                                <label class="txt_form">Estado </label>
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
                                <button type="submit" name="registro_pdt" value="Submit" class="btn btn-orange my-3">Agregar</button>
                                <button type="reset" id="submit_btn" value="Submit" class="btn btn-danger my-3 mx-3">Limpiar</button>
                            </div>
                        </div>

                    </form>
                    <!-- /form-group-->
                </div>
            </div>
            <!-- /col-lg-->
        </div>
        <!-- /row-->
    </section>
    <!-- /section-->
<?php elseif ($formTipo == 'updateProduct') : ?>
    <div class="container-fluid mt-5">

        <div class="text-center mb-4">
            <h1 class="fw-bold">Actualizacion de Producto: <br>
                <?php echo $pdtID['product_nombre'] ?> </h1>
        </div>
        <div class="row">

            <div class="col-12 col-md-6 p-4 p-md-5 res-margin bg-secondary bg-opacity-75 h-50 mx-auto mt-1">

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
                                <label class="txt_form">Nombre Producto </label>
                                <input type="text" name="productName" class="form-control input-field" maxlength="50" minlength="5" value="<?php if (isset($product)) { echo $product; } else {echo $pdtID['product_nombre'];} ?>" required>
                            </div>
                            <div class="col-md-12 text-light mt-2">
                                <label class="txt_form">Precio</label>
                                <input type="number" name="productPrecio" class="form-control input-field" min="0" step="0.01" value="<?php if (isset($precio)) { echo $precio; } else { echo $pdtID['product_precio']; } ?>" required>
                            </div>
                            <div class="col-md-12 text-light mt-2">
                                <label class="txt_form">Stock </label>
                                <input type="number" name="productStock" class="form-control input-field" min="0" value="<?php if (isset($stock)) { echo $stock; } else { echo $pdtID['product_stock']; } ?>" required>
                            </div>
                            <div class="col-md-12 text-light mt-2">
                                <label class="txt_form">Categoria </label>
                                <select class="form-select" aria-label="Default select example" name="productCategory">
                                    <option selected>
                                    </option>
                                    <?php foreach ($categories as $key => $value) : ?>
                                        <option value="<?= $value['cat_id']; ?>" <?php if (isset($category)) {if ($category != '' and $category == $value['cat_id']) echo 'selected'; } else {  if ($value['cat_id'] == $pdtID['cat_id']) echo 'selected'; } ?>><?= $value['cat_nombre']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-12 text-light mt-2">
                                <label class="txt_form">Descripción del producto </label>
                            </div>
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Escribe una descripcion del producto aqui" id="productDescripcion" name="productDescripcion" style="height: 100px" required>
                                    <?php if (isset($descrip)) {
                                        echo $descrip;
                                    } else {
                                        echo $pdtID['product_descripcion'];
                                    } ?>
                                </textarea>
                                <label for="productDescripcion">Escribe una descripcion del producto aqui</label>
                            </div>

                            <div class="col-md-12 text-light mt-2 ">
                                <label class="txt_form">Para perritos de tamaño </label>
                                <div class="d-flex flex-nowrap justify-content-evenly">
                                    <div class="form-check">
                                        <input class="form-check-input " value="Pequeno" type="radio" name="productSizeDog" id="RadioProductPequeno" <?php if (isset($sizeDog)) { if ($sizeDog == 'Pequeno') echo 'checked';} else if ($pdtID['product_size_perro'] == 'Pequeno') echo 'checked' ?>>
                                        <label class="form-check-label" for="RadioProductPequeno">
                                            Pequeño
                                        </label>
                                    </div>
                                    <div class="form-check mx-3">
                                        <input class="form-check-input " value="Mediano" type="radio" name="productSizeDog" id="RadioProductMediano" <?php if (isset($sizeDog)) {if ($sizeDog == 'Mediano') echo 'checked';} else if ($pdtID['product_size_perro'] == 'Mediano') echo 'checked' ?>>
                                        <label class="form-check-label" for="RadioProductMediano">
                                            Mediano
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input " value="Grande" type="radio" name="productSizeDog" id="RadioProductGrande" <?php if (isset($sizeDog)) {if ($sizeDog == 'Grande') echo 'checked';} else if ($pdtID['product_size_perro'] == 'Grande') echo 'checked' ?>><label class="form-check-label" for="RadioProductGrande">
                                            Grande
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 text-light mt-2">
                                <label class="txt_form">Estado </label>
                                <div class="d-flex justify-content-evenly">
                                    <div class="form-check">
                                        <input class="form-check-input estado" type="radio" name="productEstado" id="RadioProductEstadoHab" value="Habilitado" <?php if (isset($estado)) {if ($estado == 'Habilitado') echo 'checked';} elseif ($pdtID['product_estado'] == 'Habilitado') echo 'checked' ?>>
                                        <label class="form-check-label" for="RadioProductEstadoHab">
                                            Habilitado
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input estado" type="radio" name="productEstado" id="RadioProductEstadoDes" value="Deshabilitado" <?php if (isset($estado)) {if ($estado == 'Deshabilitado') echo 'checked';} elseif ($pdtID['product_estado'] == 'Deshabilitado') echo 'checked' ?>>
                                        <label class="form-check-label" for="RadioProductEstadoDes">
                                            Deshabilitado
                                        </label>
                                    </div>
                                    <input type="hidden" name="productID" value="<?php if (isset($idProduct)) { echo $idProduct;} else {echo $pdtID['product_id'];} ?>">
                                </div>
                            </div>

                            <!-- button -->
                            <div class="mt-3 d-flex justify-content-around">
                                <button type="submit" name="update_pdt" value="Submit" class="btn btn-orange my-3">Actualizar</button>
                                <button type="reset" id="submit_btn" value="Submit" class="btn btn-danger my-3 mx-3">Limpiar</button>
                            </div>
                        </div>

                    </form>
                    <!-- /form-group-->
                </div>
            </div>
            <!-- /col-lg-->

            <div class="col-12 col-md-6 p-4 p-md-5 res-margin bg-secondary bg-opacity-75 h-50 mx-auto border-dark border-start  mt-1">
                <h4 class="text-light mb-3">Imagenes del producto</h4>

                <?php foreach ($pdtImgID as $key => $value) : ?>

                    <div class="card mb-3 bg-secondary bg-opacity-50" style="max-width: 540px;">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="data:image/<?php echo ($value['img_product_tipo']); ?>;base64,<?php echo base64_encode($value['img_product_foto']); ?>" alt="<?= $value['product_nombre']; ?>" class="img-fluid rounded-start">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">

                                    <h5 class="card-title"></h5>
                                    <div class="col-md-12 text-light mt-1">
                                        <form method="post" action="">
                                            <label class="txt_form">Mostrar en la galeria </label>
                                            <div class="d-flex justify-content-evenly mb-2">
                                                <div class="form-check">
                                                    <input class="form-check-input estado" type="radio" name="imgProductEstado<?php echo ($value['img_product_id']); ?>" id="RadioImgEstadoActi<?php echo ($value['img_product_id']); ?>" value="Activado" <?php if ($value['img_product_estado'] == 'Activado') echo 'checked' ?>>
                                                    <label class="form-check-label" for="RadioImgEstadoActi<?php echo ($value['img_product_id']); ?>">
                                                        Activado
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input estado" type="radio" name="imgProductEstado<?php echo ($value['img_product_id']); ?>" id="RadioImgEstadoDes<?php echo ($value['img_product_id']); ?>" value="Desactivado" <?php if ($value['img_product_estado'] == 'Desactivado') echo 'checked' ?>>
                                                    <label class="form-check-label" for="RadioImgEstadoDes<?php echo ($value['img_product_id']); ?>">
                                                        Desactivado
                                                    </label>
                                                </div>

                                                <input type="hidden" name="img_id" value="<?php echo ($value['img_product_id']); ?>">
                                    
                                    
                                            </div>
                                            <button type="submit" name="delete_ImgPdt" class="btn btn-danger" onclick="return confirm('¿Confirma si deseas eliminar la imagen del producto?')">Eliminar</button>
                                            <button type="submit" name="update_estado_ImgPdt" value="Submit" class="btn btn-orange ms-2">Actualizar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>
            </div>
            <div class="col-12 p-4 p-md-5 res-margin bg-secondary bg-opacity-75 h-50 mx-auto mt-1">
                <form method="post" enctype="multipart/form-data">
                    <div class="col-6">
                        <label for="foto" class="form-label text-light fs-4">Seleccione una imagen para agregar</label>
                        <input type="file" class="form-control" id="foto" name="foto" required>
                        <input type="hidden" id="IdProduct" name="IdProduct" value="">
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-orange my-3" name="guardarImgPdt">Agregar</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- /row-->
    </div>   
<?php endif; ?>
<?php else : ?>

<div class="alert alert-danger" role="alert">
    <?php echo $error; ?>
</div>

<?php endif; ?>