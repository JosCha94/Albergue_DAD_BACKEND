<?php
require_once('BL/consultas_post.php');
require_once 'ENTIDADES/post.php';
$consulta = new Consulta_post();


$formTipo = $_GET['formTipo'] ?? '';



if (isset($_POST['registro_post'])) {
    $idUser = $_SESSION['usuario'][0];
    $idRol =  $rolUs;
    $titulo = $_POST['postName'];
    $autor = $_POST['postAutor'];
    $descrip = $_POST['postDescripcion'];
    $estado = $_POST['postEstado'];

    $post = new Post($idUser, $idRol, $titulo, $autor, $descrip, $estado);
    $estadoPs = $consulta->insertarPost($conexion, $pdto);

    // if ($estadoPs == 'fallo') {
    // } else {
    //     echo '<meta http-equiv="refresh" content="0; url=index.php?modulo=blog&mensaje=El post se creo correctamente" />';
    // }
}
?>

<?php if ($formTipo == 'insertPost') : ?>
    <section id="dormRegistro" class="container-fluid mt-5">

        <div class="section-heading text-center">
            <h2>Nuevo Post</h2>
        </div>
        <div class="row">

            <div class="col-lg-6 p-4 p-md-5 res-margin bg-secondary bg-opacity-75 h-50 mx-auto">

                <h4 class="text-light">Nuevo Post</h4>

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
                                <label class="txt_form">Titulo del Post</label>
                                <input type="text" name="postName" class="form-control input-field" maxlength="100" minlength="5" value="<?php if (isset($product)) echo $product ?>" required>
                            </div>
                            <div class="col-md-12 text-light mt-2">
                                <label class="txt_form">Autor</label>
                                <input type="text" name="postAutor" class="form-control input-field" maxlength="50" minlength="4" value="<?php if (isset($precio)) echo $precio ?>" required>
                            </div>
                            <div class="col-md-12 text-light mt-2">
                                <label class="txt_form">Descripción del post </label>
                            </div>
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Escribe una descripcion del producto aqui" id="productDescripcion" name="postDescripcion" style="height: 100px" required> <?php if (isset($descrip)) echo $descrip ?></textarea>
                                <label for="postDescripcion">Escribe una descripcion del post aqui</label>
                            </div>
                            <div class="col-md-12 text-light mt-2">
                                <label class="txt_form">Estado del Post </label>
                                <div class="d-flex justify-content-evenly">
                                    <div class="form-check">
                                        <input class="form-check-input estado" type="radio" name="postEstado" id="RadioProductEstadoHab" value="Activado" checked>
                                        <label class="form-check-label" for="RadioProductEstadoHab">
                                            Activado
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input estado" type="radio" name="postEstado" id="RadioProductEstadoDes" value="Desactivado">
                                        <label class="form-check-label" for="RadioProductEstadoDes">
                                            Desactivado
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- button -->
                            <div class="mt-3 d-flex justify-content-around">
                                <button type="submit" name="registro_post" value="Submit" class="btn btn-orange my-3">Agregar</button>
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
<?php elseif ($formTipo == 'updatePost') : ?>

<?php endif; ?>