<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
$rolPermitido= $log->activeRol($_SESSION['usuario'][2], $adopciones);
$permisosRol = $log->activeRolPermi($_SESSION['usuario'][3], [8]);
$permisoEsp = $log->permisosEspeciales($_SESSION['usuario'][4], [8]);

switch ($error = 'SinError') {
    case ($logueado == 'false'):
        $error = 'Debe iniciar sesión para poder visualizar este pagina';
        break;
    case ($rolPermitido != 'true'):
        $error = 'Su rol actual no le otorga permisos para acceder a esta página';
        break;
}
if ($error == 'SinError') : ?>
<?php
require_once('BL/consultas_adopcion.php');
require_once('DAL/conexion.php');
require_once('ENTIDADES/adopciones.php');

require_once('BL/phpmailer/Exception.php');
require_once('BL/phpmailer/PHPMailer.php');
require_once('BL/phpmailer/SMTP.php');



$formTipo = $_GET['formTipo'] ?? '';

$en_id = $_GET['id'];
$id = (base64_decode(urldecode($en_id)))/94269456*8752;
$conexion = conexion::conectar();
$consulta = new Consulta_adopcion();
$data = $consulta->mostrar_datosAdo($conexion, $id);
$user = $consulta->user_mail($conexion, $id);



//ACEPTA LA ENTREVISTA Y PONE UNA FECHA PARA ELLA
if (isset($_POST['agendar'])) {
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $fechaHora = $fecha .' '. $hora;
    $entrevista = new updt_estadoAdo($fechaHora);
    $consulta = new Consulta_adopcion();
    $fechEntrevista = $consulta->updateEstadoAdop($conexion, $id, $entrevista);
    if(!$fechEntrevista)
    {
        echo '<div class="alert alert-danger">¡Hubo un error el momento de agendar la entrevista!.</div>';
    }else{
        echo '<meta http-equiv="refresh" content="0; url=index.php?modulo=adopciones&mensaje=La entrevista ha sido agendada exitosamente" />';
    }
}

//RECHAZA LA ENTREVISTA
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


//ACEPTA LA ADOPCION
if (isset($_POST['btn_aceptar'])) {
    $obs = $_POST['observaciones'];
    $consulta = new Consulta_adopcion();
    $observaciones = new acpt_adopcion($obs);
    $aceptar = $consulta->aceptar_adopcion($conexion, $id, $observaciones);
    if(!$aceptar)
    {
        echo '<div class="alert alert-danger">¡Ocurrio un error, la solicitud no pudo ser aceptada!.</div>';
    }else{
        echo "<meta http-equiv='refresh' content='3'; url=index.php?modulo=adoptar>";
        echo '<div class="alert alert-success">¡La adopcion ha sido aceptada!.</div>';
    }
}

//EMAIL
if(isset($_POST['agendar'])){
    if (isset($_POST['agendar'])) {
        $fecha = $_POST['fecha'];
        $hora = $_POST['hora'];
        $fechaHora = $fecha .' '. $hora;
        $usrId = $_POST['user_id'];
        $name = $_POST['user_nombre'];
        $asunto = "Solicitud de adopción";
        $msg = $_POST['mensaje'];
        $correo = $_POST['user_mail'];
        $body = "Hola <strong>".$name."</strong>, hemos revisado tu solicitud y hemos procedido a agendar una fecha para tu entrevista por videollamada <br> fecha de entrevista: <strong>" .$fechaHora. "</strong><br>
        Con las siguientes observaciones: <br>" .$msg. "<br> Si tienes alguna duda sobre la entrevista, o deseas reagendar la entrevista, escribenos a este correo electronico con el asunto REAGENDAR ENTREVISTA. <br> Saludos Cordiales.";
        $entrevista = new updt_estadoAdo($fechaHora);
        $consulta = new Consulta_adopcion();
        $fechEntrevista = $consulta->updateEstadoAdop($conexion, $id, $entrevista);
        if(!$fechEntrevista)
        {
            echo '<div class="alert alert-danger">¡Hubo un error el momento de agendar la entrevista!.</div>';
        }else{
            echo '<meta http-equiv="refresh" content="0; url=index.php?modulo=adoptar&mensaje=La entrevista ha sido agendada exitosamente" />';
            $mail = new PHPMailer(true);
            try {
                //Server settings
                $mail->SMTPDebug = "0";                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.gmail.com';'smtp.live.com';'smtp-mail.outlook.com';               //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'albergue.adoptar.perritos@gmail.com';                     //SMTP username
                $mail->Password   = 'iolsqknvqrlvoijr';                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom('albergue.adoptar.perritos@gmail.com', "ALBERGUE DE PERRITOS");
                $mail->addAddress($correo, $name);     //Add a recipient

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = $asunto;
                $mail->Body    = $body;
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
                echo 'El correo se mando correctamente';
            } catch (Exception $e) {
                echo "Hubo un error al momento de enviar el correo: {$mail->ErrorInfo}";
            }
        }
    }
}

?>
<?php if ($formTipo == 'gestEntrevista') : ?>


<div class="row m-5 shadow-lg bg-secondary bg-opacity-25 p-2">
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
                <textarea class="form-control my-4" id="floatingInput" rows="4" placeholder="Escribe un mensaje para el solicitante" style="min-height: 100%" required name="mensaje" ></textarea>
            </div>
            <div class="form text-center">
                <label class="mx-2" for="">Agenda una fecha</label>
                <input class="mx-2" type="date" name="fecha" required>
                <input class="mx-2" type="time" name="hora"required>
                <input type="hidden" name="user_nombre" value="<?php echo $user['adop_dueño']?>">
                <input type="hidden" name="user_mail" value="<?php echo $user['usr_email']?>">
                <input type="hidden" name="user_id" value="<?php echo $user['usr_id']?>">
                <input type="hidden" name="" value="">
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
            <div class="col-md-5 text-center">
                <img class="img-fluid" src="data:image/<?php echo $data['img_perro_tipo']; ?>;base64,<?php echo base64_encode($data['img_perro_foto']); ?>" alt="Laski perro adopcion">
            </div>
        </div>

    </div>
</div>

<?php elseif ($formTipo == 'acptAdop') : ?>
<div class="container w-75 my-5 p-5  bg-secondary bg-opacity-25 shadow-lg">
    <form action="" method="POST">
        <div class="row">
            <div class="col-md-6">
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
            <div class="col-md-6 text-center my-3">
                <img class="img-fluid" src="data:image/<?php echo $data['img_perro_tipo']; ?>;base64,<?php echo base64_encode($data['img_perro_foto']); ?>" alt="Laski perro adopcion">
            </div>
        </div>
        <div class="row">
            <div class="form-outline p-3">
                <label class="form-label" for="observaciones">Deja tus observaciones</label>
                <textarea class="form-control" name="observaciones" id="observaciones"  rows="6" minlength="10" maxlength="255" required></textarea>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-md-6 text-center">
                <button class="btn btn-adopt px-5" name="btn_aceptar"  onclick="return checkDelete()">Aceptar</button>
            </div>
            <div class="col-md-6 text-center">
                <a href="index.php?modulo=adoptar" class="btn btn-secondary px-5">Cancelar</a>
            </div>
        </div>
    </form>
</div>


<?php endif; ?>
<?php else : ?>
        <div class="alert alert-danger p-5 my-5" role="alert">
            <?php echo $error; ?>
        </div>
<?php endif; ?>