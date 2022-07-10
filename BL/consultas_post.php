<?php
class Consulta_post
{
    public function listarPosts($conexion)
    {
        try {
            $sql = "CALL SP_listar_posts_admin()";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $posts = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $posts;
        } catch (PDOException $e) {
            // echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
            ?>
            <div class="alert alert-danger alert-dismissible fade show " role="alert">
                <strong class="fs-3">Error!</strong><br>Debido a un problema, por el momento no se pueden mostrar los posts.
            </div>
            <?php
        }
    }

    public function insertarPost($conexion,$id,$rol,$post)
    {
        try {
            $sql = "CALL SP_insertar_post_admin($id, $rol, :autor, :titulo, :descripcion, :estado)";
            $consulta = $conexion->prepare($sql);
            $consulta->bindValue(':autor', $post->getPost_autor());
            $consulta->bindValue(':titulo', $post->getPost_titulo());
            $consulta->bindValue(':descripcion', $post->getPost_descripcion());
            $consulta->bindValue(':estado', $post->getPost_estado());
            $consulta->execute();
            $estado='bien';
        } catch (PDOException $e) {
            // echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
            ?>
            <div class="alert alert-danger alert-dismissible fade show " role="alert">
                <strong>Error!</strong><br> Debido a un error no se ha podido actualizar el post, inténtelo mas tarde por favor.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php  
            $estado='fallo';
        }
        return $estado;
    }

    public function Validar_post($post)
    {
        $errores = [];
        $autor = trim($post->getPost_autor());
        $titulo = trim($post->getPost_titulo());
        $descrip = trim($post->getPost_descripcion());
        $estado = trim($post->getPost_estado());

        if (empty($autor)) {
            $errores['autor'] = "Campo Autor es requerido";
        }
        if (empty($titulo)) {
            $errores['titu'] = "El titulo es requerido";
        } elseif (strlen($titulo) > 50) {
            $errores['titu'] = "El titulo, maximo puede tener 50 caracteres";
        } elseif (!preg_match("/^[a-zA-Z0-9\sñáéíóúÁÉÍÓÚÑ]+$/", $titulo)) {
            $errores['titu'] = "El titulo solo puede contener letras y numeros";
        }

        if (empty($descrip)) {
            $errores['descrip'] = "El contenido del post es requerid";
        } elseif (strlen($descrip) > 16000) {
            $errores['descrip'] = "El contenido del post puede ser maximo de 16000 caracteres";
        } elseif (!preg_match("/^[a-zA-Z0-9\sñáéíóúÁÉÍÓÚÑ(,.;)]+$/", $descrip)) {
            $errores['descrip'] = "El contenido no debe tener tener signos como @ $ & % # etc";
        }

        if (empty($estado)) {
            $errores['estado'] = "El campo estado es requerido";
        }
        return $errores;
    }

    public function updatePost($conexion,$idPost, $id, $rol, $post)
    {
        try {
            $sql = "CALL SP_update_post_admin($idPost, $id, $rol, :autor, :titulo, :descripcion, :estado)";
            $consulta = $conexion->prepare($sql);
            $consulta->bindValue(':autor', $post->getPost_autor());
            $consulta->bindValue(':titulo', $post->getPost_titulo());
            $consulta->bindValue(':descripcion', $post->getPost_descripcion());
            $consulta->bindValue(':estado', $post->getPost_estado());
            $consulta->execute();
            $estado='bien';
        } catch (PDOException $e) {
            echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
            ?>
                <!-- <div class="alert alert-danger alert-dismissible fade show " role="alert">
                    <strong>Error!</strong><br> Debido a un error no se ha podido actualizar el post, inténtelo mas tarde por favor.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div> -->
            <?php            
            $estado = 'fallo';
        }
        return $estado;
    }

    public function eliminarPost($conexion, $id){
        try {
            $sql = "CALL SP_delete_post($id)";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $del_post = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $del_post;
        } catch (PDOException $e) {
            echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
            ?>
            <div class="alert alert-danger alert-dismissible fade show " role="alert">
                <strong class="fs-3">Error!</strong><br>Debido a un problema, por el momento no se puede eliminar el post.
            </div>

            <?php
        }
    }

    public function detallePost($conexion, $id)
    {
        try {
            $sql = "CALL SP_select_Post_id_admin($id)";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $pdtid = $consulta->fetch(PDO::FETCH_ASSOC);
            return $pdtid;
        } catch (PDOException $e) {
            // echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
            ?>
            <div class="alert alert-danger alert-dismissible fade show " role="alert">
              <strong>Error!</strong><br> Debido a un problema, no se pudo mostrar los datos del post
            </div>
            <?php
        }
    }

    public function agregar_fotoPost($conexion, $imgid, $img, $imgTipo)
    {
        try {
            $sql = "CALL SP_update_foto_post_admin($imgid, :foto, :fTipo)";
            $consulta = $conexion->prepare($sql);
 
            $consulta->bindValue(':foto', $img);

            $consulta->bindValue(':fTipo', $imgTipo);
            $consulta->execute();
            $estado = 'bien';
        } catch (PDOException $e) {
            // echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
            ?>
                <div class="alert alert-danger alert-dismissible fade show " role="alert">
                    <strong>Error!</strong><br> Debido a un error no se ha podido agregar la foto del post, intentelo mas tarde
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php            
            $estado = 'fallo';
        }
        return $estado;
    }

}
?>