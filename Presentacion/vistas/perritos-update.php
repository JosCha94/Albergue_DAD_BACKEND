<?php
require_once('BL/consultas_perritos.php');
require_once('DAL/conexion.php');

$postId = $_POST['updt_perrito'];
$id = $postId;

$conexion = conexion::conectar();
$consulta = new Consulta_perrito();
$perro = $consulta->listarPerritosPorId($conexion, $id);
$imgs = $consulta -> listarImgs_perritos($conexion, $id)


?>
<div class="text-center"><h2 class="text-center mt-3 h1"><?= $perro['perro_nombre']; ?></h2></div>

<div class="container my-4 w-50">
    <form action="" method="POST">
        <div class="row mb-4">
            <div class="col">
                <div class="form-outline">
                    <input type="text" id="pnom" class="form-control" value="<?= $perro['perro_nombre']; ?>" />
                    <label class="form-label" for="pnom">Nombre del perrito</label>
                </div>
            </div>
            <div class="col">
                <div class="form-outline">
                    <input type="text" id="ppeso" class="form-control" value="<?= $perro['perro_peso']; ?>"/>
                    <label class="form-label" for="ppeso">Peso</label>
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col">
                <div class="form-outline mb-2">
                    <input type="text" id="ptamano" class="form-control" value="<?= $perro['perro_tamano']; ?>" />
                    <label class="form-label" for="ptamano">Tamaño</label>
                </div>
            </div>
            <div class="col">
                <div class="form-outline mb-2">
                    <input type="text" id="pnaci" class="form-control" value="<?= $perro['perro_nacimiento']; ?>" />
                    <label class="form-label" for="pnaci">Fecha de nacimiento</label>
                </div>
            </div>    
        </div>    
        <div class="row mb-2">
            <div class="col">
                <div class="form-outline mb-2">
                    <input type="text" id="psexo" class="form-control" value="<?= $perro['perro_sexo']; ?>" />
                    <label class="form-label" for="psexo">Sexo</label>
                </div>
            </div>
            <div class="col">
                <div class="form-outline mb-2">
                    <input type="text" id="pacti" class="form-control" value="<?= $perro['perro_actividad']; ?>" />
                    <label class="form-label" for="pacti">Nivel de actividad</label>
                </div>
            </div>    
        </div>    
        <div class="row mb-2">
            <div class="col">
                <div class="form-outline mb-2">
                    <select class="form-select" aria-label="Default select example" id="select_estado">
                        <option selected><?= $perro['perro_estado']; ?></option>
                        <option value="Adoptado">Adoptado</option>
                        <option value="Sin Adoptar">Sin Adoptar</option>
                        <option value="Reingreso">Reingreso</option>
                        <option value="Deshabilitado">Deshabilitado</option>
                    </select>
                    <label for="select_estado" class="form-label">Estado</label>
                </div>
            </div>    
        </div>   
        <div class="form-outline mb-2">
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"> <?= $perro['perro_descripcion']; ?></textarea>
            <label for="exampleFormControlTextarea1" class="form-label">Descripción</label>
        </div>    
        <div class="row">
        <?php foreach ($imgs as $key => $value) : ?>
            
            <div class="col-md-4 text-center">
                <img class="img-fluid" src="data:image/<?php echo $value['img_perro_tipo']; ?>;base64,<?php echo base64_encode($value['img_perro_foto']); ?>" alt="">
                <button class="btn btn-warning my-3" title="CAMBIAR FOTO"><i class="fa-solid fa-pen-to-square"></i></button>
                <button class="btn btn-danger my-3" title="BORRAR FOTO"><i class="fa-solid fa-circle-minus"></i></button>
            </div>
            <?php endforeach; ?>
        
        </div> 
        <div class="text-center">
            <button type="submit" class="btn btn-primary btn-block mb-4">Actualizar datos</button>
        </div>
    </form>

</div>