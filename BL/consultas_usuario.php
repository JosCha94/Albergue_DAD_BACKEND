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

    public function listarRoles($conexion)
    {
        try {
            $sql = "CALL SP_select_Roles_admin()";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $user = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $user;
        } catch (PDOException $e) {
            // echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
        ?>
            <div class="alert alert-danger alert-dismissible fade show " role="alert">
                <strong class="fs-3">Error!</strong><br>Debido a un problema, por el momento no se puede listar los roles

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
                    <strong class="fs-3">Error!</strong><br>Debido a un problema, por el momento no se puede asignar el rol al usuario de
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
<?php                
            }
            $resultado = 'mal';
        }
        return $resultado;
    }

    public function desactivar_UserRol($conexion, $idUser, $idRol)
    {
        try {
            $sql = "CALL SP_Desactiva_UserRol_admin($idUser, $idRol)";
            $consulta = $conexion->prepare($sql);
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

    public function activar_UserRol($conexion, $idUser, $idRol)
    {
        try {
            $sql = "CALL SP_Activa_UserRol_admin($idUser, $idRol)";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $estado='bien';

        } catch (PDOException $e) {
              echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
            ?>
              <div class="alert alert-danger alert-dismissible fade show " role="alert">
              <strong>Error!</strong> Debido a un problema , no se pudo activar el rol al usuario
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            <?php
            $estado='mal';
        }
        return $estado;
    }

    public function deshabilitar_User($conexion, $idUser)
    {
        try {
            $sql = "CALL SP_Deshabilitar_User_admin($idUser)";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $estado='bien';

        } catch (PDOException $e) {
            //  echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
            ?>
              <div class="alert alert-danger alert-dismissible fade show " role="alert">
              <strong>Error!</strong> Debido a un problema , no se pudo desactivar al usuario
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            <?php
            $estado='mal';
        }
        return $estado;
    }

    public function habilitar_User($conexion, $idUser)
    {
        try {
            $sql = "CALL SP_Habilitar_User_admin($idUser)";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $estado='bien';

        } catch (PDOException $e) {
              echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
            ?>
              <div class="alert alert-danger alert-dismissible fade show " role="alert">
              <strong>Error!</strong> Debido a un problema , no se pudo activar al usuario
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            <?php
            $estado='mal';
        }
        return $estado;
    }

}
?>