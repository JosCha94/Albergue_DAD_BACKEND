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
            <?php
        }
    }   

    public function insertarPost($conexion,$post)
    {
        try {
            $sql = "CALL SP_insertar_post(:id, :rol, :autor, :titulo, :descripcion, :estado)";
            $consulta = $conexion->prepare($sql);
            $consulta->bindValue(':id', $post->getId_usr());
            $consulta->bindValue(':rol', $post->getRol_usr());
            $consulta->bindValue(':autor', $post->getPost_autor());
            $consulta->bindValue(':titulo', $post->getPost_titulo());
            $consulta->bindValue(':descripcion', $post->getPost_descripcion());
            $consulta->bindValue(':estado', $post->getPost_estado());
            $consulta->execute();
            $estado = 'bien';
        } catch (PDOException $e) {
            echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
            ?>
                <!-- <div class="alert alert-danger alert-dismissible fade show " role="alert">
                    <strong>Error!</strong><br> Debido a un error no se ha podido agregar el post, intentelo mas tarde
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div> -->
            <?php 
            $estado = 'fallo';
        }
    }

    public function insertar_fotoProducto($conexion, $img)
    {
        try {
            $sql = "CALL SP_agrega_img_producto_id_admin(:p_id, :fNombre, :foto, :fTipo)";
            $consulta = $conexion->prepare($sql);
            $consulta->bindValue(':p_id', $img->getId_producto());
            $consulta->bindValue(':fNombre', $img->getImg_producto_nombre());
            $consulta->bindValue(':foto', $img->getImg_producto_foto());
            $consulta->bindValue(':fTipo', $img->getImg_producto_tipo());
            $consulta->execute();
            $estado = 'bien';
        } catch (PDOException $e) {
            // echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
            ?>
                <div class="alert alert-danger alert-dismissible fade show " role="alert">
                    <strong>Error!</strong><br> Debido a un error no se ha podido agregar la foto del producto, intentelo mas tarde
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php            
            $estado = 'fallo';
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
}
?>