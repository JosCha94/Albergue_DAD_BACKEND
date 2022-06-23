<?php
require_once('BL/consultas_perritos.php');
require_once('ENTIDADES/img_perritos.php');

$formTipo = $_GET['formTipo'] ?? '';

$conexion = conexion::conectar();
$consulta = new Consulta_perrito();

if(isset($_GET['id'])){
$id = $_GET['id'];

$perro = $consulta->listarPerritosPorId($conexion, $id);
$imgs = $consulta -> listarImgs_perritos($conexion, $id);
}

if (isset($_POST['btnInsert'])) {
    $p_nom = $_POST['nom_perro'];
    $p_peso = $_POST['peso_perro'];
    $p_tamano = $_POST['select_tamano'];
    $p_nacimiento = $_POST['f_nacimiento'];
    $p_sexo = $_POST['select_sexo'];
    $p_actividad = $_POST['select_actividad'];
    $p_descrip = $_POST['name_descrip'];

    $add_perro = new perritos($p_nom, $p_peso, $p_tamano, $p_nacimiento, $p_sexo, $p_actividad, $p_descrip);
    $consulta = new Consulta_perrito();
    $errores = $consulta->Validar_registroPerrito($add_perro);
    if (count($errores) == 0) {
        $estado = $consulta->insertar_perrito($conexion, $add_perro);

        if ($estado == 'fallo') {
        } else {
            echo '<div class="alert alert-success">¡El nuevo perrito ha sido agregado con exito!.</div>';
        }
    }
}

if (isset($_POST['save_foto'])) {

    $data = $_FILES['new_foto'];
    $foto = file_get_contents($_FILES['new_foto']['tmp_name']);
    $fotoName = $_FILES['new_foto']['name'];
    $fotoType = $_FILES['new_foto']['type'];
    $fotoError = $_FILES['new_foto']['error'];
    $fotoPeso = $_FILES['new_foto']['size'];
    $ext = explode('.', $fotoName);
    $extR = strtolower(end($ext));
    // var_dump($foto);
    $permitir = array('jpg', 'jpeg', 'png');
    if(in_array($extR, $permitir)){
        if ($fotoError === 0){
            if($fotoPeso < 5000000){
                $fotoNombreNew = uniqid('', true).".".$extR;
            }else{
            echo '<div class="alert alert-danger">¡El archivo es muy grande!.</div>';
                
            }
        }else{
        echo '<div class="alert alert-danger">¡Hubo un error al cargar la foto!</div>';
        }
    }else{
        echo '<div class="alert alert-danger">¡No tienes permitido añadir archivos de ese tipo!.</div>';
    }

    $img = new img_perritos($id, $foto, $fotoNombreNew, $extR);
    $consulta = new Consulta_perrito();
    $estado = $consulta->insertar_fotoPerrito($conexion, $img);
    if ($estado == 'fallo') {
        echo '<div class="alert alert-danger">¡Hubo un error al momento de guardar la foto!.</div>';
    } else {
            echo "<meta http-equiv='refresh' content='3'>";
            echo '<div class="alert alert-success">¡La nueva foto a sido añadida con exito con exito!.</div>';
    }

}


 

?>

<?php if ($formTipo == 'updatePerrito') : ?>
    
<section id="update_perrito">
    <div class="text-center"><h2 class="text-center mt-3 h1"><?= $perro['perro_nombre']; ?></h2></div>
    <div class="container my-4">
        <form action="" method="POST">
            <div class="row">
                <div class="col-md-7">
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
                </div>
                <div class="col-md-5"> 
                      <?php $array = json_encode($imgs);
                      if ($array != '[]' ){
                      ?>
                        <?php foreach ($imgs as $key => $value) : ?>
                        <div class="row">
                            <div>
                                <img class="img-fluid  mb-4 shadow-lg bg-body ms-5 me-2" style="width: 180px" src="data:image/<?php echo $value['img_perro_tipo']; ?>;base64,<?php echo base64_encode($value['img_perro_foto']); ?>" alt="">
                                <a  href="index.php?modulo=admin_perritos&formTipo=insertFoto&id=<?= $value['perro_id'] ;?>" class="btn btn-warning">Modificar</a>
                            </div>
                        </div> 
                        <?php endforeach; ?>
                        <?php } else{ ?>
                        <div class="row">
                            <div>
                                <img class="img-fluid  mb-4 shadow-lg bg-body ms-5 me-2" style="width: 180px" src="Presentacion\libs\images\default-image.png" alt="">
                                <a  href="index.php?modulo=admin_perritos&formTipo=insertFoto&id=<?= $perro['perro_id'] ;?>" class="btn btn-warning">Modificar</a>
                            </div>
                        </div>
                        <div class="row">
                            <div>
                                <img class="img-fluid  mb-4 shadow-lg bg-body ms-5 me-2" style="width: 180px" src="Presentacion\libs\images\default-image.png" alt="">
                                <a  href="index.php?modulo=admin_perritos&formTipo=insertFoto&id=<?= $perro['perro_id'] ;?>" class="btn btn-warning">Modificar</a>
                            </div>
                        </div>
                        <div class="row">
                            <div>
                                <img class="img-fluid  mb-4 shadow-lg bg-body ms-5 me-2" style="width: 180px" src="Presentacion\libs\images\default-image.png" alt="">
                                <a  href="index.php?modulo=admin_perritos&formTipo=insertFoto&id=<?= $perro['perro_id'] ;?>" class="btn btn-warning">Modificar</a>
                            </div>
                        </div>
                        <?php } ?>
                </div>
            </div>    
            <div class="text-center">
                <button type="submit" name="btnUpdate" class="btn btn-primary btn-block mb-4">Actualizar datos</button>
            </div>

        </form>
    </div>
</section>


<?php elseif ($formTipo == 'insertPerrito') : ?>

<section id="insert_perrito">
    <div><h2 class="text-center my-3 h1">Agregar perrito</h2></div>
    <div class="container-fluid w-50">
    <form action="" method="POST">
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
            <div class="col-md-12 ">
                <div class="row mb-4">
                    <div class="col col-md-6">
                        <div class="form-outline">
                            <input type="text" id="pnom" class="form-control" name="nom_perro" required maxlength="50" minlength="5"/>
                            <label class="form-label" for="nom_perro">Nombre del perrito</label>
                        </div>
                    </div>
                    <div class="col col-md-6">
                        <div class="form-outline">
                            <input type="number" id="ppeso" class="form-control" name="peso_perro" min="0" step="0.01" required/>
                            <label class="form-label" for="peso_perro">Peso en Kg.</label>
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col col-md-6">
                        <div class="form-outline mb-2">
                            <select class="form-control" aria-label="Default select example" name="select_tamano" required>
                                <option selected>Seleccione una opción</option>
                                <option value="Pequeño">Pequeño</option>
                                <option value="Mediano">Mediano</option>
                                <option value="Grande">Grande</option>
                            </select>
                            <label for="select_tamano" class="form-label">Tamaño</label>
                        </div>
                    </div>
                    <div class="col col-md-6">
                        <div class="form-outline mb-2">
                            <input type="date" id="pnaci" class="form-control" name="f_nacimiento" required/>
                            <label class="form-label" for="f_nacimiento">Fecha de nacimiento</label>
                        </div>
                    </div>    
                </div>    
                <div class="row mb-2">
                    <div class="col col-md-6">
                        <div class="form-outline mb-2">
                            <select class="form-control" aria-label="Default select example" id="select_sexo" name="select_sexo" required>
                                <option selected>Seleccione una opción</option>
                                <option value="M">Macho</option>
                                <option value="H">Hembra</option>
                            </select>
                            <label class="form-label" for="select_sexo">Sexo</label>
                        </div>
                    </div>
                    <div class="col col-md-6">
                        <div class="form-outline mb-2">
                            <select class="form-control" aria-label="Default select example" id="select_actividad" name="select_actividad"required>
                                <option selected>Seleccione una opción</option>
                                <option value="Intensa">Intensa</option>
                                <option value="Moderada">Moderada</option>
                                <option value="Ligera">Ligera</option>
                            </select>
                            <label class="form-label" for="select_actividad">Nivel de actividad</label>
                        </div>
                    </div>    
                </div>
                
                <div class="form-outline mb-2">
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="name_descrip" required maxlength="255" minlength="15" > </textarea>
                    <label for="name_descrip" class="form-label">Descripción</label>
                </div> 
            </div>
                
        </div>    
        <div class="text-center">
            <button type="submit" name="btnInsert" class="btn btn-primary btn-block mb-4">Agregar Perrito</button>
        </div>
        
    </form>    
    </div>
</section>

<?php elseif ($formTipo == 'insertFoto') : ?>

<section id="insert_foto" class=" my-5 container w-75">
    <div><h2 class="text-center my-5 h1">Agregar fotos</h2></div>
    <div class="container-fluid">
        <form action="" method="post">
            <div class="row">
                    <div class="col col-md-4">
                        <div class="card shadow-lg mb-4" >
                        <?php 
                        
                        if (count($imgs) > 0 ){
                        ?>
                            <img class="card-img-top img-fluid " src="data:image/<?php echo $imgs[0]['img_perro_tipo']; ?>;base64,<?php echo base64_encode($imgs[0]['img_perro_foto']); ?>" alt="Card image cap">
                            <button type="button" class="btn btn-success mt-3 mx-5" data-bs-toggle="modal" data-bs-target="#foto_modal" name ="subir_foto" disabled><i class="fa-solid fa-circle-plus"></i></button>

                        <?php }else{  ?>  
                            <img class="card-img-top img-fluid" src="Presentacion/libs/images/default-image.png" alt="Card image cap">
                            <button type="button" class="btn btn-success mt-3 mx-5" data-bs-toggle="modal" data-bs-target="#foto_modal" name ="subir_foto"><i class="fa-solid fa-circle-plus"></i></button> <?php } ?>
                            <button class="btn btn-danger mt-3 ms-3" name= "elim_foto" ><i class="fa-solid fa-circle-minus"></i></button>
                    </div>
                    
                </div>
                <div class="col col-md-4">
                    <div class="card shadow-lg mb-4" >
                        <?php 
                        if (count($imgs) > 1 ){
                        ?>
                            <img class="card-img-top img-fluid" src="data:image/<?php echo $imgs[1]['img_perro_tipo']; ?>;base64,<?php echo base64_encode($imgs[1]['img_perro_foto']); ?>" alt="Card image cap">
                            <button type="button" class="btn btn-success mt-3 mx-5" data-bs-toggle="modal" data-bs-target="#foto_modal" name ="subir_foto" disabled><i class="fa-solid fa-circle-plus"></i></button>

                        <?php }else{  ?>  
                            <img class="card-img-top img-fluid" src="Presentacion/libs/images/default-image.png" alt="Card image cap">
                            <button type="button" class="btn btn-success mt-3 mx-5" data-bs-toggle="modal" data-bs-target="#foto_modal" name ="subir_foto"><i class="fa-solid fa-circle-plus"></i></button> <?php } ?>
                            <button class="btn btn-danger mt-3 ms-3" name= "elim_foto" ><i class="fa-solid fa-circle-minus"></i></button>
                    </div>
                </div>
                <div class="col col-md-4">
                    <div class="card shadow-lg mb-4" >
                        <?php 
                        if (count($imgs) > 2 ){
                        ?>
                            <img class="card-img-top img-fluid" src="data:image/<?php echo $imgs[2]['img_perro_tipo']; ?>;base64,<?php echo base64_encode($imgs[2]['img_perro_foto']); ?>" alt="Card image cap">
                            <button type="button" class="btn btn-success mt-3 mx-5" data-bs-toggle="modal" data-bs-target="#foto_modal" name ="subir_foto" disabled><i class="fa-solid fa-circle-plus"></i></button>

                        <?php }else{  ?>  
                            <img class="card-img-top img-fluid" src="Presentacion/libs/images/default-image.png" alt="Card image cap"> 
                            <button type="button" class="btn btn-success mt-3 mx-5" data-bs-toggle="modal" data-bs-target="#foto_modal" name ="subir_foto"><i class="fa-solid fa-circle-plus"></i></button> <?php } ?>
                            <button class="btn btn-danger mt-3 ms-3" name= "elim_foto" ><i class="fa-solid fa-circle-minus"></i></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="modal fade" id="foto_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Subir Foto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="file" name="new_foto">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-success" name="save_foto">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>




<?php endif; ?>