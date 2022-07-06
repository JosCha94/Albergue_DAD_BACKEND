<?php
class Consulta_usuario
{
    public function listarUsuarios($conexion)
    {
        try {
            $sql = "CALL SP_usuarios_admin()";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $user = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $user;
        } catch (PDOException $e) {
            // echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
?>
            <div class="alert alert-danger alert-dismissible fade show " role="alert">
                <strong class="fs-3">Error!</strong><br>Debido a un problema, por el momento no se puede listar los usuarios

            </div>

        <?php
        }
    }

    public function listarUsuarios2($conexion)
    {
        try {
            $sql = "CALL SP_select_usuarios_admin()";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $user = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $user;
        } catch (PDOException $e) {
            // echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
        ?>
            <div class="alert alert-danger alert-dismissible fade show " role="alert">
                <strong class="fs-3">Error!</strong><br>Debido a un problema, por el momento no se puede listar los usuarios

            </div>

            <?php
        }
    }

    public function listarPerEspUsr($conexion)
    {
        try {
            $sql = "CALL SP_select_UserPermisoEsp_admin()";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $user = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $user;
        } catch (PDOException $e) {
            // echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
        ?>
            <div class="alert alert-danger alert-dismissible fade show " role="alert">
                <strong class="fs-3">Error!</strong><br>Debido a un problema, por el momento no se puede listar los permisos especiales de los usuarios

            </div>

            <?php
        }
    }

    public function asignarRol($conexion, $idUser, $idRol)
    {
        try {
            $sql = "CALL SP_asignar_rol_admin($idUser, $idRol)";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $resultado = 'bien';
        } catch (PDOException $e) {
            // echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
            $bad = $e->getMessage();
            $msj = 'Duplicate entry';
            $msj_error = strpos($bad, $msj);
            if ($msj_error !== false) { ?>
                <div class="alert alert-danger alert-dismissible fade show " role="alert">
                    <strong class="fs-3">Error!</strong><br>No se puede asignar el rol al uasuario debia a que ya lo tiene
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php
            } else { ?>
                <div class="alert alert-danger alert-dismissible fade show " role="alert">
                    <strong class="fs-3">Error!</strong><br>Debido a un problema, por el momento no se puede asignar el rol al usuario
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
<?php                
            }
            $resultado = 'mal';
        }
        return $resultado;
    }

    public function cambia_estado_UsrRol($conexion, $idUser, $idRol, $UR_estado)
    {
        try {
            $sql = "CALL SP_update_estado_UserRol_admin($idUser, $idRol, :estado)";
            $consulta = $conexion->prepare($sql);
            $consulta->bindParam(':estado', $UR_estado);
            $consulta->execute();
            $estado='bien';

        } catch (PDOException $e) {
            //  echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
            ?>
              <div class="alert alert-danger alert-dismissible fade show " role="alert">
              <strong>Error!</strong> Debido a un problema , no se pudo desactivar el rol al usuario
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            <?php
            $estado='mal';
        }
        return $estado;
    }


    public function cambia_estado_User($conexion, $idUser, $U_estado)
    {
        try {
            $sql = "CALL SP_update_estado_User_admin($idUser, :estado)";
            $consulta = $conexion->prepare($sql);
            $consulta->bindParam(':estado', $U_estado);
            $consulta->execute();
            $estado='bien';

        } catch (PDOException $e) {
            //   echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
            ?>
              <div class="alert alert-danger alert-dismissible fade show " role="alert">
              <strong>Error!</strong> Debido a un problema , no se pudo cambiar el estado del usuario
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            <?php
            $estado='mal';
        }
        return $estado;
    }

    public function cambia_estado_UsrPer($conexion, $idUser, $idPer, $UP_estado)
    {
        try {
            $sql = "CALL SP_update_estado_UserPer_admin($idUser, $idPer, :estado)";
            $consulta = $conexion->prepare($sql);
            $consulta->bindParam(':estado', $UP_estado);
            $consulta->execute();
            $estado='bien';

        } catch (PDOException $e) {
            //   echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
            ?>
              <div class="alert alert-danger alert-dismissible fade show " role="alert">
              <strong>Error!</strong> Debido a un problema , no se pudo desactivar el rol al usuario
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            <?php
            $estado='mal';
        }
        return $estado;
    }

    public function asignarPermiso($conexion, $idUser, $idPer)
    {
        try {
            $sql = "CALL SP_asignar_user_permiso_admin($idUser, $idPer)";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $resultado = 'bien';
        } catch (PDOException $e) {
            // echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
            $bad = $e->getMessage();
            $msj = 'Duplicate entry';
            $msj_error = strpos($bad, $msj);
            if ($msj_error !== false) { ?>
                <div class="alert alert-danger alert-dismissible fade show " role="alert">
                    <strong class="fs-3">Error!</strong><br>No se puede asignar el permiso al uasuario debia a que ya lo tiene
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php
            } else { ?>
                <div class="alert alert-danger alert-dismissible fade show " role="alert">
                    <strong class="fs-3">Error!</strong><br>Debido a un problema, por el momento no se puede asignar el permiso al usuario
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
<?php                
            }
            $resultado = 'mal';
        }
        return $resultado;
    }

    // ------------------------------------------------
    //                 PERFIL USUARIO
    // ------------------------------------------------

    public function Validar_registro($usu)
    {
        $errores = [];
        $usuario = trim($usu->getUsuario());
        $clave = trim($usu->getUsr_clave());
        $nombre = trim($usu->getUsr_nombre());
        $ape_pat = trim($usu->getUsr_apellido_paterno());
        $ape_mat = trim($usu->getUsr_apellido_materno());
        $mail = trim($usu->getUsr_email());
        $celular = trim($usu->getUsr_celular());
        if (empty($usuario)) {
            $errores['usu'] = "Campo Usuario es requerido";
        } elseif (strlen($usuario) < 5 || strlen($usuario) > 15) {
            $errores['usu'] = "El campo Usuario debe tener de 5 a 15 caracteres, sin espacios en blanco";
        }
        if (empty($clave)) {
            $errores['pass'] = "El campo Contraseña es requerido";
        } elseif (strlen($clave) < 8 || strlen($clave) > 15) {
            $errores['pass'] = "La Contraseña debe tener de 8 a 15 caracteres, sin espacios en blanco";
        }
        if (empty($nombre)) {
            $errores['name'] = "El campo Nombre es requerido";
        } elseif (strlen($nombre) < 4 || strlen($nombre) > 20) {
            $errores['name'] = "El Nombre deve tener de 4 a 20 letras, sin espacios en blanco";
        } elseif (lcfirst($nombre) == ($nombre)) {
            $errores['name'] = "La primera letra del Nombre debe estar en mayuscula";
        } elseif (!preg_match("/^[A-Z][a-zñáéíóú]+$/", $nombre)) {
            if(!preg_match("/^[A-Z][a-zñáéíóú]+(\s*[A-Z][a-zñáéíóú]*)$/", $nombre)){
                $errores['name'] = "El Nombre debe tener solo letras";
            }
        }
        if (empty($ape_pat)) {
            $errores['ape_p'] = "El campo Apellido Paterno es requerido";
        } elseif (strlen($ape_pat) < 4 || strlen($ape_pat) > 20) {
            $errores['ape_p'] = "El Apellido Paterno deve tener de 4 a 20 letras, sin espacios en blanco";
        } elseif (lcfirst($ape_pat) == ($ape_pat)) {
            $errores['ape_p'] = "La primera letra del Apellido Paterno debe estar en mayuscula";
        } elseif (!preg_match("/^[A-Z][a-zñáéíóú]+$/", $ape_pat)) {
            if(!preg_match("/^[A-Z][a-zñáéíóú]+(\s*[A-Z][a-zñáéíóú]*)$/", $ape_pat)){
                $errores['ape_p'] = "El Apellido Paterno solo puede tener letras";
            }
        }
        if (empty($ape_mat)) {
            $errores['ape_m'] = "El campo Apellido Materno es requerido";
        } elseif (strlen($ape_mat) < 4 || strlen($ape_mat) > 20) {
            $errores['ape_m'] = "El Apellido Materno deve tener de 4 a 20 letras, sin espacios en blanco";
        } elseif (lcfirst($ape_mat) == ($ape_mat)) {
            $errores['ape_m'] = "La primera letra del Apellido Materno debe estar en mayuscula";
        } elseif (!preg_match("/^[A-Z][a-zñáéíóú]+$/", $ape_mat)) {
            if(!preg_match("/^[A-Z][a-zñáéíóú]+(\s*[A-Z][a-zñáéíóú]*)$/", $ape_mat)){
                $errores['ape_m'] = "El Apellido Materno solo puede tener letras";
            }
        }
        if (empty($mail)) {
            $errores['mail'] = "El campo Correo electronico es requerido";
        } elseif (strlen($mail) > 30) {
            $errores['mail'] = "El Correo electronico puede tener de hasta 30 caracteres, sin espacios en blanco";
        } elseif (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            $errores['mail'] = "La sintaxis del Correo electronico es incorrecta";
        }
        if (empty($celular)) {
            $errores['celu'] = "El campo Celular es requerido";
        } elseif (strlen($celular) < 9) {
            $errores['celu'] = "El Celular debe 9 digitos, sin espacios en blanco";
        } elseif (!ctype_digit($celular)) {
            $errores['celu'] = "El Celular solo puede tener numeros enteros";
        }
        return $errores;
    }

    public function detalleUsuario($conexion, $id)
    {
        try {
            $sql = "CALL SP_detalle_usuario($id)";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $user = $consulta->fetch(PDO::FETCH_ASSOC);
            return $user;
        } catch (PDOException $e) {
            // echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
            ?>
            <div class="alert alert-danger alert-dismissible fade show " role="alert">
              <strong>Error!</strong> Debido a un problema no se puede mostrar los datos del usuario por el momento
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
            $user = 'error';
        }
    }

    public function actualizar_usuario($conexion, $uid, $usu)
    {
        try {
            $sql = "CALL SP_update_usuario($uid, :usuario, :nombre, :ape_pat, :ape_mat, :email, :celular)";
            $consulta = $conexion->prepare($sql);
            $consulta->bindValue(':usuario', $usu->getUsuario());
            $consulta->bindValue(':nombre', $usu->getUsr_nombre());
            $consulta->bindValue(':ape_pat', $usu->getUsr_apellido_paterno());
            $consulta->bindValue(':ape_mat', $usu->getUsr_apellido_materno());
            $consulta->bindValue(':email', $usu->getUsr_email());
            $consulta->bindValue(':celular', $usu->getUsr_celular());
            $consulta->execute();
            $estado='bien';

        } catch (PDOException $e) {
            // echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
            $bad = $e->getMessage();
            $cel = 'UK_numero_celular_USR';
            $email = 'UK_email_USR';

            $cel_coincidencia = strpos($bad, $cel);
            $email_coincidencia = strpos($bad, $email);
            if ($cel_coincidencia !== false) { ?>
                <div class="alert alert-danger alert-dismissible fade show " role="alert">
                    <strong>Error!</strong> El numero de celular ya existe, ingrese otro numero de celular
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php
            }elseif ($email_coincidencia !== false) {?>            
                <div class="alert alert-danger alert-dismissible fade show " role="alert">
                    <strong>Error!</strong> El correo electronico ya existe, ingrese otra dirreción de correo
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php
            };
            $estado='mal';
        }
        return $estado;        
    }

    public function Validar_pass($pass1, $pass2)
    {
        $errores = [];
        $pass1 = trim($pass1);
        $pass2 = trim($pass2);
        if (empty($pass1)) {
            $errores['pass1'] = "El campo Contraseña es requerido";
        } elseif (strlen($pass1) < 8 || strlen($pass1) > 20) {
            $errores['pass1'] = "La contraseña debe tener de 8 a 20 caracteres, sin espacios en blanco";        }
        if (empty($pass2)) {
            $errores['pass2'] = "El campo Repetir Contraseña es requerido";
        } elseif ($pass1 != $pass2) {
            $errores['pass2'] = "Las contraseñas no coinciden";
        }
        return $errores;
    }
    
    public function cambiar_pass($conexion, $uid, $pass)
    {
        try {
            $sql = "CALL SP_update_clave_usuario($uid, $pass)";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $estado='bien';

        } catch (PDOException $e) {
            // echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
            ?>
              <div class="alert alert-danger alert-dismissible fade show " role="alert">
              <strong>Error!</strong> Debido a un problema , no se pudo actualizar la contraseña por el momento
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            <?php
            $estado='mal';
        }
        return $estado;
    }
}
?>