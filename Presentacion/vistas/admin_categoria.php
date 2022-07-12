<?php
$rolPermitido= $log->activeRol($_SESSION['usuario'][2], $productos);
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
require_once('BL/consultas_productos.php');
require_once 'ENTIDADES/categoria.php';
$consulta = new Consulta_categoria();


$formTipo = $_GET['formTipo'] ?? '';

if ($formTipo == 'updateCategoria') :

    if ($_POST['cat_id'] != '') {
        $idEditCat = $_POST['cat_id'];
        $_SESSION['usuario'][5] = $idEditCat;
        $catID = $consulta->detalleCategoria($conexion, $idEditCat);
    } else {
        $catID = $consulta->detalleCategoria($conexion, $_SESSION['usuario'][5]);
    }
endif;


if (isset($_POST['registro_cat'])) {
    $categoria = $_POST['catCategory'];
    $catDescrip = $_POST['catDescrip'];
    $catego = new Categoria($categoria, $catDescrip);
    $errores = $consulta->Validar_registroCat($catego);
    if (count($errores) == 0) {
        $estado = $consulta->insetar_categoria($conexion, $catego);

        if ($estado == 'fallo') {
        } else {
            echo '<meta http-equiv="refresh" content="0; url=index.php?modulo=productos&mensaje=La Categoria se agrego correctamente" />';
        }
    }
}

if (isset($_POST['update_cat'])) {
    // $idCat = $_POST['IDcat'];
    $idCat =  $_SESSION['usuario'][5];
    $categoria = $_POST['catCategory'];
    $catDescrip = $_POST['catDescrip'];
    $catego = new Categoria($categoria, $catDescrip);
    $errores = $consulta->Validar_registroCat($catego);
    if (count($errores) == 0) {
        $estado = $consulta->update_categoria($conexion, $catego,  $idCat);

        if ($estado == 'fallo') {
        } else {
            echo '<meta http-equiv="refresh" content="0; url=index.php?modulo=productos&mensaje=El producto se actualizo correctamente" />';
        }
    }
}

?>


<?php if ($formTipo == 'insertCategoria') : ?>
    <section id="dormRegistro" class="container-fluid mt-5">

        <div class="section-heading text-center">
            <h2>Nueva Categoria</h2>
        </div>
        <div class="row">
            <div class="col-lg-6 p-4 p-md-5 res-margin bg-secondary bg-opacity-75 h-50 mx-auto">

                <h4 class="text-light">Nueva Categoria</h4>

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
                                <label class="txt_form">Nombre Categoria </label>
                                <input type="text" name="catCategory" class="form-control input-field" maxlength="50" minlength="5" value="<?php if (isset($categoria)) echo $categoria ?>" required>
                            </div>
                            <div class="col-md-12 text-light mt-2">
                                <label class="txt_form">Descripción de la Categoria </label>
                            </div>
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Escribe una descripcion de la categoria aqui" id="catDescrip" name="catDescrip" style="height: 100px" required> <?php if (isset($catDescrip)) echo $catDescrip ?></textarea>
                                <label for="catDescrip">Escribe una descripcion de la categoria aqui</label>
                            </div>
                            <!-- button -->
                            <div class="mt-3 d-flex justify-content-around">
                                <button type="submit" name="registro_cat" value="Submit" class="btn btn-adopt my-3">Agregar</button>
                                <button type="reset" id="submit_btn" value="Submit" class="btn btn-danger my-3 mx-3">Limpiar</button>
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
<?php elseif ($formTipo == 'updateCategoria') : ?>
    <div class="container-fluid mt-5">

        <div class="text-center mb-4">
            <h1 class="fw-bold">Actualizacion de Categoria: <br>
                <?php echo $pdtID['cat_nombre'] ?> </h1>
        </div>
        <div class="row">

            <div class="col-lg-6 p-4 p-md-5 res-margin bg-secondary bg-opacity-75 h-50 mx-auto">

                <h4 class="text-light">Datos de la Categoria</h4>

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
                                <label class="txt_form">Nombre Categoria </label>
                                <input type="text" name="catCategory" class="form-control input-field" maxlength="50" minlength="4" value="<?php if (isset($categoria)) {echo $categoria;} else {echo $catID['cat_nombre'];} ?>" required>
                            </div>
                            <div class="col-md-12 text-light mt-2">
                                <label class="txt_form">Descripción de la Categoria </label>
                            </div>
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Escribe una descripcion de la categoria aqui" id="catDescrip" name="catDescrip" style="height: 100px" required> <?php if (isset($catDescrip)) {echo $catDescrip;} else {echo $catID['cat_descripcion'];} ?></textarea>
                                <label for="catDescrip">Escribe una descripcion de la categoria aqui</label>
                            </div>

                            <!-- button -->
                            <div class="mt-3 d-flex justify-content-around">
                                <button type="submit" name="update_cat" value="Submit" class="btn btn-adopt my-3">Actualizar</button>
                                <button type="reset" id="submit_btn" value="Submit" class="btn btn-danger my-3 mx-3">Limpiar</button>
                            </div>

                    </form>
                    <!-- /form-group-->
                </div>
            </div>
            <!-- /col-lg-->
        </div>

        <!-- /row-->
    </div>

<?php endif; ?>
<?php else : ?>
        <div class="alert alert-danger p-5 my-5" role="alert">
            <?php echo $error; ?>
        </div>
<?php endif; ?>