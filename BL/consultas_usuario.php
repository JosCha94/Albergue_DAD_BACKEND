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
}
?>