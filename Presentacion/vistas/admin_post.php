<?php
require_once('BL/consultas_post.php');
require_once 'ENTIDADES/post.php';
$consulta = new Consulta_post();

$formTipo = $_GET['formTipo'] ?? '';

if ($formTipo == 'updatePost') :

    if ($_POST['post_id'] != '') {
        $idEditPost = $_POST['post_id'];
        $_SESSION['usuario'][6] =  $idEditPost;
        $postID = $consulta->detallePost($conexion,  $idEditPost);
        // $pdtImgID = $consulta->listarImgProducto($conexion, $idEditProducto);
    } else {
        // $pdtImgID = $consulta->listarImgProducto($conexion, $_SESSION['usuario'][6]);
        $postID = $consulta->detallePost($conexion, $_SESSION['usuario'][6]);
    }
endif;

$idpost =  $_SESSION['usuario'][6];

if (isset($_POST['registro_post'])) {
    $id = $_SESSION['usuario'][0];
    $rol = $rolUs;
    $autor = $_POST['post_autor'];
    $titulo = $_POST['post_titulo'];
    $descrip = $_POST['post_descripcion'];
    $estado = $_POST['post_estado'];
    $post = new Post($autor, $titulo, $descrip, $estado);

    $IPost = $consulta->insertarPost($conexion, $id, $rol, $post);

    if ($IPost == 'fallo') {
    } else {
        echo '<meta http-equiv="refresh" content="0; url=index.php?modulo=blog&mensaje=El post se agrego correctamente" />';
    }
}

if (isset($_POST['update_post'])) {
    $idPost = $idpost;
    $id = $_SESSION['usuario'][0];
    $rol = $rolUs;
    $autor = $_POST['post_autor'];
    $titulo = $_POST['post_titulo'];
    $descrip = $_POST['post_descripcion'];
    $estado = $_POST['post_estado'];
    $post = new Post($autor, $titulo, $descrip, $estado);

    $UPost = $consulta->updatePost($conexion,$idPost, $id, $rol, $post);

    if ($UPost == 'fallo') {
    } else {
        echo '<meta http-equiv="refresh" content="0; url=index.php?modulo=admin_post&formTipo=updatePost&mensaje=El post se actualizo correctamente" />';
    }
}

if (isset($_POST['guardarImgPost'])) {

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

    $estadoIP = $consulta->agregar_fotoPost($conexion, $idpost, $foto, $extR);
    if ($estado == 'fallo') {
    } else {
        echo '<meta http-equiv="refresh" content="0; url=index.php?modulo=admin_post&formTipo=updatePost&mensaje=La imagen del post se agrego correctamente" />';
    }
}

if (isset($_POST['EliminarImgPost'])) {
    $foto = ' ';
    $extR = '';
    $estadoIP = $consulta->agregar_fotoPost($conexion, $idpost, $foto, $extR);
    if ($estado == 'fallo') {
    } else {
        echo '<meta http-equiv="refresh" content="0; url=index.php?modulo=admin_post&formTipo=updatePost&mensaje=La imagen del post se elimino correctamente" />';
    }
}
?>

<?php if ($formTipo == 'insertPost') : ?>
    <section id="dormRegistro" class="container-fluid mt-5">

        <div class="section-heading text-center">
            <h2>Nuevo Post</h2>
        </div>
        <div class="row">

            <div class="col-lg-6 p-4 p-md-5 res-margin shadow-lg bg-secondary bg-opacity-75 h-50 mx-auto">

                <h4 class="text-dark">Nuevo Post</h4>

                <!-- Form Starts -->
                <div id="product_form">
                    <form action="" method="post">
                        <div class="row">
                            <div class="col-md-12 text-dark mt-3">
                                <label class="txt_form">Titulo post </label>
                                <input type="text" name="post_titulo" class="form-control input-field" maxlength="50" minlength="5" value="<?php if (isset($titulo)) echo $titulo ?>" required>
                            </div>
                            <div class="col-md-12 text-dark mt-3">
                                <label class="txt_form">Autor</label>
                                <input type="text" name="post_autor" class="form-control input-field" min="0" step="0.01" value="<?php if (isset($autor)) echo $autor ?>" required>
                            </div>
                            <div class="col-md-12 text-dark mt-3">
                                <label class="txt_form">Contenido </label>
                            </div>
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Escribe una descripcion del producto aqui" id="post_descripcion" name="post_descripcion" style="height: 100px" required> <?php if (isset($descrip)) echo $descrip ?></textarea>
                                <label for="post_descripcion">Escribe el contenido del post aqui</label>
                            </div>
                            <div class="col-md-12 text-dark mt-3">
                                <label class="txt_form">Estado </label>
                                <div class="d-flex justify-content-evenly">
                                    <div class="form-check">
                                        <input class="form-check-input estado" type="radio" name="post_estado" id="Radiopost_estadoActi" value="Activado" checked>
                                        <label class="form-check-label" for="Radiopost_estadoActi">
                                            Activado
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input estado" type="radio" name="post_estado" id="Radiopost_estadoDes" value="Desactivado">
                                        <label class="form-check-label" for="Radiopost_estadoDes">
                                            Desactivado
                                        </label>
                                    </div>
                                </div>
                            </div>  <!-- button -->
                            <div class="mt-3 d-flex justify-content-around">
                                 <button type="submit" name="registro_post" value="Submit" class="btn btn-donation my-3">Agregar</button>
                                 
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
<?php elseif ($formTipo == 'updatePost') : ?>
    <section id="dormRegistro" class="container-fluid mt-5">

        <div class="text-center mb-4">
            <h1 class="fw-bold">Actualizacion de Post: <br>
                <?php echo $postID['post_titulo'] ?> </h1>
        </div>
        <div class="row shadow-lg bg-secondary bg-opacity-50">

            <div class="col-lg-6 p-4 p-md-5 h-50 mx-auto">

                <h4 class="text-dark">Datos del Post</h4>

                <!-- Form Starts -->
                <div id="product_form">
                    <form action="" method="post">
                        <div class="row">
                            <div class="col-md-12 text-dark mt-3">
                                <label class="txt_form">Titulo post </label>
                                <input type="text" name="post_titulo" class="form-control input-field" maxlength="50" minlength="5" value="<?php if (isset($titulo)) {echo $titulo; } else { echo $postID['post_titulo']; } ?>" required>
                            </div>
                            <div class="col-md-12 text-dark mt-3">
                                <label class="txt_form">Autor</label>
                                <input type="text" name="post_autor" class="form-control input-field" min="0" step="0.01" value="<?php if (isset($autor)) { echo $autor;} else {echo $postID['post_autor'];} ?>" required>
                            </div>
                            <div class="col-md-12 text-dark mt-3">
                                <label class="txt_form">Contenido </label>
                            </div>
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Escribe una descripcion del producto aqui" id="post_descripcion" name="post_descripcion" style="height: 100px" required> <?php if (isset($descrip)) {echo $descrip;} else { echo $postID['post_descripcion'];} ?></textarea>
                                <label for="post_descripcion">Escribe el contenido del post aqui</label>
                            </div>
                            <div class="col-md-12 text-dark mt-3">
                                <label class="txt_form">Estado </label>
                                <div class="d-flex justify-content-evenly">
                                    <div class="form-check">
                                        <input class="form-check-input estado" type="radio" name="post_estado" id="Radiopost_estadoActi" value="Activado" <?php if (isset($estado)) {if ($estado == 'Activado') echo 'checked'; } elseif ($postID['post_estado'] == 'Activado') echo 'checked' ?>>
                                        <label class="form-check-label" for="Radiopost_estadoActi">
                                            Activado
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input estado" type="radio" name="post_estado" id="Radiopost_estadoDes" value="Desactivado" <?php if (isset($estado)) {if ($estado == 'Desactivado') echo 'checked'; } elseif ($postID['post_estado'] == 'Desactivado') echo 'checked' ?>>
                                        <label class="form-check-label" for="Radiopost_estadoDes">
                                            Desactivado
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- button -->
                            <div class="mt-3 d-flex justify-content-around">
                                <button type="submit" name="update_post" value="Submit" class="btn btn-donation my-3">Actualizar</button>
                               
                            </div>
                        </div>
                    </form>
                    <!-- /form-group-->
                    

                </div>
                                      
            </div> 
            <div class="col-lg-6 p-4 p-md-5 h-50 mx-auto  mt-3 mt-md-0"> 
                <h4 class="text-light">Imagen del Post</h4>
                <div class="row my-3">
                    <div class="col-12">
                    <?php if($postID['post_img_tipo'] != null): ?>
                        <img src="data:image/<?php echo ($postID['post_img_tipo']); ?>;base64,<?php echo base64_encode($postID['post_img']); ?>" alt="<?= $postID['post_titulo']; ?>" class="img-fluid w-75 mx-5">
                    <?php else : ?>
                        <marquee behavior="alternate" class="fs-3" scrollamount="10">SIN IMAGEN</marquee>
                    <?php endif;?>
                    
                    </div>
                </div>

                    <form method="post" enctype="multipart/form-data">
                        <div class="col-12">
                            <label for="foto" class="form-label text-light fs-4">Seleccione una imagen para agregar</label>
                            <input type="file" class="form-control" id="foto" name="foto" <?php echo($postID['post_img_tipo'] == null)? 'required':''; ?> >
                            <div class=" mt-3 d-flex justify-content-around">
                            <button type="submit" class="btn btn-orange my-3" name="guardarImgPost" <?php echo($postID['post_img_tipo'] != null)? 'disabled':''; ?>>Agregar</button>
                            <button type="submit" class="btn btn-danger my-3" name="EliminarImgPost" <?php echo($postID['post_img_tipo'] == null)? 'disabled':''; ?>>Eliminar</button>
                            </div>

                        </div>
                        
                   </form>
            </div>

            </div>



        <!-- /row-->
    </section>
<?php endif; ?>