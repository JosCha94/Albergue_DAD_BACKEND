<?php
require_once('BL/consultas_perritos.php');
require_once('ENTIDADES/perritos.php');

$formTipo = $_GET['formTipo'] ?? '';

$conexion = conexion::conectar();
$consulta = new Consulta_perrito();
if ($formTipo == 'updatePerrito') :
    if ($_POST['updt_perrito'] != '') {
        $id = $_POST['updt_perrito'];
        $perro = $consulta->listarPerritosPorId($conexion, $id);
        $imgs = $consulta -> listarImgs_perritos($conexion, $id);
    }
endif;


if (isset($_POST['btnInsert'])) {
    $p_nom = $_POST['nom_perro'];
    $p_peso = $_POST['peso_perro'];
    $p_tamano = $_POST['select_tamano'];
    $p_nacimiento = $_POST['f_nacimiento'];
    $p_sexo = $_POST['select_sexo'];
    $p_actividad = $_POST['select_actividad'];
    $p_descrip = $_POST['name_descrip'];
    $perro = new perritos($p_nom, $p_peso, $p_tamano, $p_nacimiento, $p_sexo, $p_actividad, $p_descrip);


    $consulta = new Consulta_perrito();
    $errores = $consulta->Validar_registroPerrito($perro);
    if (count($errores) == 0) {
        $estado = $consulta->insertar_perrito($conexion, $perro);

        if ($estado == 'fallo') {
        } else {
            echo '<div class="alert alert-success">¡El nuevo perrito ha sido agregado con exito!.</div>';
        }
    
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
                            <button class="btn btn-success my-3 mx-2" title="CAMBIAR FOTO"><i class="fa-solid fa-plus"></i></button>
                            <button class="btn btn-danger my-3 mx-2" title="BORRAR FOTO"><i class="fa-solid fa-circle-minus"></i></button>
                        </div>
                    </div> 
                <?php endforeach; ?>
                <?php } else{ ?>
                    <div class="row">
                        <div>
                            <img class="img-fluid  mb-4 shadow-lg bg-body ms-5 me-2" style="width: 180px" src="Presentacion\libs\images\default-image.png" alt="">
                            <button class="btn btn-success my-3 mx-2" title="CAMBIAR FOTO"><i class="fa-solid fa-plus"></i></button>
                            <button class="btn btn-danger my-3 mx-2" title="BORRAR FOTO"><i class="fa-solid fa-circle-minus"></i></button>
                        </div>
                    </div>
                    <div class="row">
                        <div>
                            <img class="img-fluid  mb-4 shadow-lg bg-body ms-5 me-2" style="width: 180px" src="Presentacion\libs\images\default-image.png" alt="">
                            <button class="btn btn-success my-3 mx-2" title="CAMBIAR FOTO"><i class="fa-solid fa-plus"></i></button>
                            <button class="btn btn-danger my-3 mx-2" title="BORRAR FOTO"><i class="fa-solid fa-circle-minus"></i></button>
                        </div>
                    </div>
                    <div class="row">
                        <div>
                            <img class="img-fluid  mb-4 shadow-lg bg-body ms-5 me-2" style="width: 180px" src="Presentacion\libs\images\default-image.png" alt="">
                            <button class="btn btn-success my-3 mx-2" title="CAMBIAR FOTO"><i class="fa-solid fa-plus"></i></button>
                            <button class="btn btn-danger my-3 mx-2" title="BORRAR FOTO"><i class="fa-solid fa-circle-minus"></i></button>
                        </div>
                    </div>
                    <?php } ?>
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

<section id="insert_foto">
    <div><h2 class="text-center my-3 h1">Agregar fotos</h2></div>
    <div class="container-fluid">
        <div class="row">
            <div class="col col-md-4">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="..." alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Cras justo odio</li>
                        <li class="list-group-item">Dapibus ac facilisis in</li>
                        <li class="list-group-item">Vestibulum at eros</li>
                    </ul>
                    <div class="card-body">
                        <a href="#" class="card-link">Card link</a>
                        <a href="#" class="card-link">Another link</a>
                    </div>
                </div>
            </div>
            <div class="col col-md-4">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="..." alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Cras justo odio</li>
                        <li class="list-group-item">Dapibus ac facilisis in</li>
                        <li class="list-group-item">Vestibulum at eros</li>
                    </ul>
                    <div class="card-body">
                        <a href="#" class="card-link">Card link</a>
                        <a href="#" class="card-link">Another link</a>
                    </div>
                </div>
            </div>
            <div class="col col-md-4">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="..." alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Cras justo odio</li>
                        <li class="list-group-item">Dapibus ac facilisis in</li>
                        <li class="list-group-item">Vestibulum at eros</li>
                    </ul>
                    <div class="card-body">
                        <a href="#" class="card-link">Card link</a>
                        <a href="#" class="card-link">Another link</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>