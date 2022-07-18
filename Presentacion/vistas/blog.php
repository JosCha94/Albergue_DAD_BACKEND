<?php
$rolPermitido= $log->activeRol($_SESSION['usuario'][2], $blog);
$permisosRol = $log->activeRolPermi($_SESSION['usuario'][3], [10]);
$permisoEsp = $log->permisosEspeciales($_SESSION['usuario'][4], [10]);
$rolAdminGen= $log->activeRol($_SESSION['usuario'][2], [2]);

switch ($error = 'SinError') {
    case ($logueado == 'false'):
        $error = '<meta http-equiv="refresh" content="0; url=index.php" />';
        break;
    case ($rolPermitido != 'true'):
        $error = 'Su rol actual no le otorga permisos para acceder a esta página';
        break;
}
if ($error == 'SinError') : ?>
<?php
require_once('BL/consultas_post.php');
require_once('DAL/conexion.php');

$conexion = conexion::conectar();
$consulta = new Consulta_post();
$posts = $consulta->listarPosts($conexion); 

if (isset($_POST['eliminar_post'])){  //si se presiono el boton eliminar
    $id = $_POST['post_id'];   //obtengo el id del post que se quiere eliminar
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
<?php if ($permisosRol == 'true' || $permisoEsp == 'true'):?>     
<a href="index.php?modulo=admin_post&formTipo=insertPost" type="button" class="btn btn-primary btm-lg" data-toggle="modal" data-target="#modalBlog">
    <span>Agregar Post <i class="fa-solid fa-circle-plus"></i></apan>
</a>
<?php endif;?>
<hr>
<div class="row">
    <div class="col-sm-12">
        <div class="my-3 ">
        <div class="table-responsive">
            <table class="table table-hover" id="tablaBlog">
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
                            <td><?php echo ($value['post_estado']); ?> </td>                           
                            <td><?php echo ($value['post_fecha_creacion']); ?> </td>
                            <td><?php echo ($value['post_fecha_cambio']); ?> </td>
                            <td>
                            <?php if ($permisosRol == 'true' || $permisoEsp == 'true'):?>     
                                <form action="index.php?modulo=admin_post&formTipo=updatePost" method="post">
                                    <input type="hidden" name="post_id" value="<?= $value['post_id']; ?>">
                                    <button class="btn btn-warning btn-xs " name="editar_post" title="Editar post" <?php echo($value['usr_id'] != $_SESSION['usuario'][0])?'disabled':''; ?>><i class="fa-solid fa-pen-to-square"></i></button>
                                </form>
                            <?php endif;?>
                            </td>    
                            <td>
                            <?php if ($permisosRol == 'true' || $permisoEsp == 'true'):?>
                                <form action="" method="post">
                                    <input type="hidden" name="post_id" value="<?= $value['post_id']; ?>">
                                    <button class="btn btn-danger btn-xs " name="eliminar_post" title="Eliminar post" onclick="return confirm('¿Quieres eliminar este Post?')" 
                                    <?php 
                                    echo($value['usr_id'] != $_SESSION['usuario'][0] && $rolAdminGen != 'true')?
                                         'disabled':''; ?>><i class="fa fa-trash "></i></button>
                                </form>
                                <?php endif;?>
                            
                            </td>                         
                        </tr>                                      
              <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        </div>
    </div>
</div>
<?php else : ?>
        <div class="alert alert-danger p-5 my-5" role="alert">
            <?php echo $error; ?>
        </div>
<?php endif; ?>