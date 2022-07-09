<?php
require_once('BL/consultas_apadrinar.php');
require_once('DAL/conexion.php');
require_once('ENTIDADES/suscripciones_tipo.php');

$en_id = $_GET['id'];  
$id = (base64_decode(urldecode($en_id)))*7854/489554;

$consulta = new Consulta_suscripcion();
$tipoSus = $consulta->listarTipo_suscri($conexion, $id);


if(isset($_POST['btnUpdate'])){
    $id = (base64_decode(urldecode($en_id)))*7854/489554;
    $tipoNombre = $_POST['t_nombre'];
    $tPrecio = $_POST['t_precio'];
    $tipoDescripcion = $_POST['t_descripcion'];
    $t_estado = $_POST['t_estado'];
    
    $tipo = new tipo_suscripcion($tipoNombre, $tPrecio, $tipoDescripcion, $t_estado);
    $consulta2 = new Consulta_suscripcion();
    $updt_tSus = $consulta2->update_tipoSus($conexion, $id, $tipo);
    if (!$updt_tSus) {
        echo "<meta http-equiv='refresh' content='3'>";
        echo '<div class="alert alert-danger">¡No se pudo actualizar la información, por favor intentalo de nuevo!.</div>';
    } else {
        echo "<meta http-equiv='refresh' content='3'>";
        echo '<div class="alert alert-success">¡Los datos se actualizaron con éxito!.</div>';
    }

}



?>


<section class="shadow-lg bg-secondary bg-opacity-75 mt-5 p-5 mx-auto w-75" id="update_perrito">
    <div class="text-center"><h2 class="text-center h1">Plan de suscripcion : <?= $tipoSus['s_tipo_nombre'];?> </h2></div>
        <form action="" method="POST">
            <div class="col-md-12">
                <div class="form-outline">
                    <input type="text" id="pnom" class="form-control" value="<?php if (isset($tipoNombre)) {echo $tipoNombre;} else { echo $tipoSus['s_tipo_nombre'];} ?>" maxlength="50" minlength="5" name="t_nombre" required/>
                    <label class="form-label" for="pnom">Nombre del plan de suscripción</label>
                </div>
                <div class="form-outline">
                    <input type="number" class="form-control" value="<?php if (isset($tPrecio)) {echo $tPrecio;} else { echo $tipoSus['s_tipo_precio'];} ?>" name="t_precio" min="0" step="0.01"  required/>
                    <label class="form-label">Precio del plan</label>
                </div>
                <div class="form-outline mb-2">
                    <select class="form-control" aria-label="Default select example" id="select_estado" name="t_estado" required>
                        <option selected><?php if (isset($t_estado)) {echo $t_estado;} else { echo $tipoSus['s_tipo_estado'];} ?></option>
                        <option value="Activado">Activado</option>
                        <option value="desactivado">desactivado</option>
                    </select>
                    <label class="form-label" for="ptamano">Estado del plan</label>
                </div>
                <div class="form-outline mb-2">
                    <textarea class="form-control" id="exampleFormControlTextarea1" name="t_descripcion" rows="3" required minlength="5" maxlength="255"> <?php if (isset($tipoDescripcion)) {echo $tipoDescripcion;} else { echo $tipoSus['s_tipo_descripcion'];} ?></textarea>
                    <label for="exampleFormControlTextarea1" class="form-label">Descripción del plan</label>
                    </div> 
            </div>
            <div class="text-center">
                <button type="submit" name="btnUpdate" class="btn btn-adopt btn-block mb-4">Actualizar datos</button>
            </div>
        </form>
</section>