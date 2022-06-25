<?php
require_once('BL/consultas_adopcion.php');
require_once('DAL/conexion.php');
require_once('ENTIDADES/adopciones.php');


$id = $_GET['id'];
$conexion = conexion::conectar();
$consulta = new Consulta_adopcion();
$data = $consulta->mostrar_datosAdo($conexion, $id);

if (isset($_POST['agendar'])) {
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $fechaHora = $fecha .' '. $hora;
    $entrevista = new updt_estadoAdo($fechaHora);
    $consulta = new Consulta_adopcion();
    $fechEntrevista = $consulta->updateEstadoAdop($conexion, $id, $entrevista);
    if(!$fechEntrevista)
    {
        echo '<div class="alert alert-danger">¡Hubo un erro el momento de eliminar la foto!.</div>';
    }else{
        echo '<meta http-equiv="refresh" content="0; url=index.php?modulo=adopciones&mensaje=La entrevista ha sido agendada exitosamente" />';
    }
}
if (isset($_POST['rechazar'])) {
    $consulta = new Consulta_adopcion();
    $rechazar = $consulta->rechazar_adopcion($conexion, $id);
    if(!$rechazar)
    {
        echo '<div class="alert alert-danger">¡Ocurrio un errr, la solicitud no pudo ser rechazada!.</div>';
    }else{
        echo '<meta http-equiv="refresh" content="0; url=index.php?modulo=adopciones&mensaje=La solicitud se ha rechazado" />';
    }
}

?>

<div class="row m-5">
    <div class="col-md-5 border-end border-5 ">
        <div class="my-3">
            <h2 class="text-center">Datos del solicitante</h2>
        </div>   
        <table class="my-4 table table-bordered table-hover">
            <tr>
                <td>Nombre del adoptante:</td>
                <td><?php echo $data['adop_dueño']; ?></td>
            </tr>
            <tr>
                <td>Razon de la adopción:</td>
                <td><?php echo $data['adop_razon']; ?></td>
            </tr>
            <tr>
                <td>Fecha de la solicitud:</td>
                <td><?php echo $data['adop_fecha_creacion']; ?></td>
            </tr>
        </table>
        <form action="" method="post" class="d-inline me-5">
            <h1 class="h3 my-3 fw-normal text-center">  Agendar entrevista</h1>
            <div class="form ">
                <textarea class="form-control my-4" id="floatingInput" rows="4" placeholder="Escribe un mensaje para el solicitante" style="min-heigth: 100%" required ></textarea>
            </div>
            <div class="form text-center">
                <label class="mx-2" for="">Agenda una fecha</label>
                <input class="mx-2" type="date" name="fecha" required>
                <input class="mx-2" type="time" name="hora"required>
            </div>
            <button class="btn btn-adopt my-5" style="width:180px" type="submit" name="agendar" >Aceptar</button>
        </form>
        <form action="" method="POST" class="d-inline ms-5 ">
            <button class="btn btn-secondary my-5" style="width:180px;" type="submit" name="rechazar">Rechazar</button>
        </form>
    </div>
    <div class="col-md-7">
        <div class="my-3 "> 
            <h2 class="text-center">  Datos del perrito</h2>
        </div>
        <div class="row">
            <div class="col-md-7">    
                <table class="my-3 table table-bordered table-hover">
                    <tr>
                        <td>Nombre del Perro:</td>
                        <td><?php echo $data['perro_nombre']; ?></td>
                    </tr>
                    <tr>
                        <td>Tamaño</td>
                        <td><?php echo $data['perro_tamano']; ?></td>
                    </tr>
                    <tr>
                        <td>Peso</td>
                        <td><?php echo $data['perro_peso']; ?></td>
                    </tr>
                    <tr>
                        <td>Sexo</td>
                        <td><?php echo $data['perro_sexo']; ?></td>
                    </tr>
                    <tr>
                        <td>Actividad</td>
                        <td><?php echo $data['perro_actividad']; ?></td>
                    </tr>
                    <tr>
                        <td>Descripcion</td>
                        <td><?php echo $data['perro_descripcion']; ?></td>
                    </tr>
                </table>
            </div>
            <div class="col-md-5">
                <div class="text-center">
                    <img class="img-fluid" src="data:image/<?php echo $data['img_perro_tipo']; ?>;base64,<?php echo base64_encode($data['img_perro_foto']); ?>" alt="Laski perro adopcion">
                </div>
            </div>
        </div>
        
    </div>
</div>
