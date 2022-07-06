<?php
require_once('BL/consultas_post.php');
require_once('DAL/conexion.php');

$conexion = conexion::conectar();
$consulta = new Consulta_post();
$posts = $consulta->listarPosts($conexion); 

if (isset($_POST['eliminar_post'])){  //si se presiono el boton eliminar
    $id = $_POST['post_id'];   //obtengo el id del post que se quiere eliminar

    $consulta = new Consulta_post();  //instancio la clase consulta_post
    $del_img = $consulta->eliminarPost($conexion, $id);   // Elimina el post de la base de datos    
    
    if(!$del_img){

        echo "<meta http-equiv='refresh' content='2'>";
        echo '<div class="alert alert-success">El post se eliminó.</div>';
        
    }else{
        echo '<div class="alert alert-danger">No se pudo eliminar el post.</div>';
        
    }  
}

?>

<h2 class="text-center mt-3 h1">Posts</h2>

<a href="index.php?modulo=admin_post&formTipo=insertPost" type="button" class="btn btn-primary btm-lg" data-toggle="modal" data-target="#modalBlog">
    <span>Agregar Post <i class="fa-solid fa-circle-plus"></i></apan>
</a>
<hr>
<div class="row">
    <div class="col-sm-12">
        <div class="my-3 ">
            <table class="table table-sm table-hover" id="tablaBlog">
                <thead class="bg-danger text-white">
                    <tr>
                        <td>Id </td>
                        <td>Autor</td>
                        <td>Titulo</td>
                        <td>Imagen</td>
                        <td>Descripción</td>
                        <td>Estado</td>
                        <td>Fecha de creación</td>
                        <td>Fecha de modificacion</td>
                        <td>Editar</td>
                        <td>Eliminar</td>
                    </tr>
                </thead>
                <tfoot class="bg-secondary text-white">
                    <tr>
                        <td>Id </td>
                        <td>Autor</td>
                        <td>Titulo</td>
                        <td>Imagen</td>
                        <td>Descripción</td>
                        <td>Estado</td>
                        <td>Fecha de creación</td>
                        <td>Fecha de modificacion</td>
                        <td>Editar</td>
                        <td>Eliminar</td>
                    </tr>
                </tfoot>
                <tbody>
                <?php foreach ($posts as $key => $value) : ?>
                        <tr>
                        <td><?php echo ($value['post_id']); ?> </td>
                            <td><?php echo ($value['post_autor']); ?> </td>
                            <td><?php echo ($value['post_titulo']); ?></td>
                            <td><img src="data:image/<?php echo ($value['post_img_tipo']); ?>;base64,<?php echo base64_encode($value['post_img']); ?>" alt="<?= $value['post_titulo']; ?>" class="img-fluid w-25"> </td>
                            <td><?php echo ($value['post_descripcion']); ?> </td>
                            <td>
                                    <form action="" method="post">
                                        <input type="hidden" name="post_id" value="<?= $value['post_id']; ?>">
                                        <button class="btn <?php echo ($value['post_estado'] == 'Activado') ? 'btn-danger' : 'btn-success' ?> btn-xs" name="cambia_estado_post" title="<?php echo ($value['post_estado'] == 'Activado') ? 'Desactivar' : 'Activar' ?> post" onclick="return confirm('¿Quieres <?php echo ($value['post_estado'] == 'Activado') ? 'Desactivar' : 'Activar' ?> este post?')"><i class="fa-solid fa-power-off"></i></button>
                                    </form>
                            </td>                            
                            <td><?php echo ($value['post_fecha_creacion']); ?> </td>
                            <td><?php echo ($value['post_fecha_cambio']); ?> </td>
                            <td>
                                <form action="index.php?modulo=admin_post&formTipo=updatePost" method="post">
                                    <input type="hidden" name="post_id" value="<?= $value['post_id']; ?>">
                                    <button class="btn btn-warning btn-xs " name="editar_post" title="Editar post"><i class="fa-solid fa-pen-to-square"></i></button>
                                </form>
                            </td>    
                            <td>
                                <form action="" method="post">
                                    <input type="hidden" name="post_id" value="<?= $value['post_id']; ?>">
                                    <button class="btn btn-danger btn-xs " name="eliminar_post" title="Eliminar post"><i class="fa fa-trash "></i></button>
                                </form>
                            </td>                         
                        </tr>                                      
              <?php endforeach; ?>
                </tbody>
            </table>
            
        </div>
    </div>
</div>