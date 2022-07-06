<?php
class Consulta_post
{
    public function listarPosts($conexion)
    {
        try {
            $sql = "CALL SP_listar_posts()";
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

    public function mostrarPost($conexion, $id)
    {
        try {
            $sql = "CALL SP_mostrar_post($id)";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $postId = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $postId;
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
            $sql = "CALL SP_insertar_post($id, $rol, :autor, :titulo, :descripcion, :estado)";
            $consulta = $conexion->prepare($sql);
            $consulta->bindValue(':autor', $post->getPost_autor());
            $consulta->bindValue(':titulo', $post->getPost_titulo());
            $consulta->bindValue(':descripcion', $post->getPost_descripcion());
            $consulta->bindValue(':estado', $post->getPost_estado());
            $consulta->execute();
            $estado='bien';
        } catch (PDOException $e) {
            echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
            $estado='fallo';
        }
        return $estado;
    }

    public function updatePost($conexion, $id, $post)
    {
        try {
            $sql = "CALL SP_admin_update_post($id, :autor, :titulo, :imagen, :nombre_img, :tipo_img, :descripcion, :estado)";
            $consulta = $conexion->prepare($sql);
            $consulta->bindValue(':autor', $post->getPost_autor());
            $consulta->bindValue(':titulo', $post->getPost_titulo());
            $consulta->bindValue(':imagen', $post->getPost_imagen());
            $consulta->bindValue(':nombre_img', $post->getPost_nombre_img());
            $consulta->bindValue(':tipo_img', $post->getPost_tipo_img());
            $consulta->bindValue(':descripcion', $post->getPost_descripcion());
            $consulta->bindValue(':estado', $post->getPost_estado());
            $consulta->execute();
            $estado = 'bien';
        } catch (PDOException $e) {
            echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
            ?>
                <div class="alert alert-danger alert-dismissible fade show " role="alert">
                    <strong>Error!</strong><br> Debido a un error no se ha podido actualizar el post, inténtelo mas tarde por favor.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
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


}
?>