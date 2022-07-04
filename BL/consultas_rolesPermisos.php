<?php
class Consulta_RolesPermisos{
    // ------------------------------------------------
    //             ROLES PERMISOS
    // ------------------------------------------------
    public function listarRolesPermisos($conexion)
    {
        try {
            $sql = "CALL SP_select_rolesPermisos_admin()";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $user = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $user;
        } catch (PDOException $e) {
            // echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
?>
            <div class="alert alert-danger alert-dismissible fade show " role="alert">
                <strong class="fs-3">Error!</strong><br>Debido a un problema, por el momento no se puede listar los roles y permisos

            </div>

        <?php
        }
    }

    public function cambiar_estado_PermisoRol($conexion, $Rolid, $Permisoid, $PR_estado)
    {
        try {
            $sql = "CALL SP_update_estado_RolPermiso_admin($Rolid, $Permisoid, :estado)";
            $consulta = $conexion->prepare($sql);
            $consulta->bindParam(':estado', $PR_estado);
            $consulta->execute();
            $estado='bien';

        } catch (PDOException $e) {
            //  echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
            ?>
              <div class="alert alert-danger alert-dismissible fade show " role="alert">
              <strong>Error!</strong><br> Debido a un problema, no se pudo cambiar el acceso del permiso para el rol, intentelo mas tarde
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            <?php
            $estado='mal';
        }
        return $estado;
    }

    public function asignarPermisoRol($conexion, $idRol, $idPermiso)
    {
        try {
            $sql = "CALL SP_asignar_permiso_rol_admin($idRol, $idPermiso)";
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
                    <strong class="fs-3">Error!</strong><br>No se puede asignar el permiso al rol debia a que ya lo tiene
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php
            } else { ?>
                <div class="alert alert-danger alert-dismissible fade show " role="alert">
                    <strong class="fs-3">Error!</strong><br>Debido a un problema, por el momento no se puede asignar el permiso al rol
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
<?php                
            }
            $resultado = 'mal';
        }
        return $resultado;
    }

    // ------------------------------------------------
    //                     ROLES 
    // ------------------------------------------------

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

    public function cambiar_estado_rol($conexion, $Rolid, $R_estado)
    {
        try {
            $sql = "CALL SP_update_estado_Rol_admin($Rolid, :estado)";
            $consulta = $conexion->prepare($sql);
            $consulta->bindParam(':estado', $R_estado);
            $consulta->execute();
            $estado='bien';

        } catch (PDOException $e) {
            // echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
            ?>
              <div class="alert alert-danger alert-dismissible fade show " role="alert">
              <strong>Error!</strong> Debido a un problema, no se pudo cambiar el estado del rol, intentelo mas tarde
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            <?php
            $estado='mal';
        }
        return $estado;
    }

    public function detalleRol($conexion, $id)
    {
        try {
            $sql = "CALL SP_select_Rol_id_admin($id)";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $pdtid = $consulta->fetch(PDO::FETCH_ASSOC);
            return $pdtid;
        } catch (PDOException $e) {
            // echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
            ?>
            <div class="alert alert-danger alert-dismissible fade show " role="alert">
              <strong>Error!</strong><br> Debido a un problema, no se pudo mostrar los datos del Rol
            </div>  
            <?php
        }
    }

    public function update_rol($conexion, $nombreRol, $descripRol, $id)
    {
        try {
            $sql = "CALL SP_update_Rol_admin($id, :nombre, :descrip)";
            $consulta = $conexion->prepare($sql);
            $consulta->bindParam(':nombre', $nombreRol);
            $consulta->bindParam(':descrip', $descripRol); 
            $consulta->execute();
            $estado = 'bien';
        } catch (PDOException $e) {
              echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
            ?>
                <div class="alert alert-danger alert-dismissible fade show " role="alert">
                    <strong>Error!</strong><br> Debido a un problema no se ha podido actualizar los datos del rol, intentelo mas tarde
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php            
            $estado = 'fallo';
        }
        return $estado;
    }

    // ------------------------------------------------
    //                  PERMISOS
    // ------------------------------------------------

    public function listarPermisos($conexion)
    {
        try {
            $sql = "CALL SP_select_Permisos_admin()";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $user = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $user;
        } catch (PDOException $e) {
            // echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
        ?>
            <div class="alert alert-danger alert-dismissible fade show " role="alert">
                <strong class="fs-3">Error!</strong><br>Debido a un problema, por el momento no se puede listar los permisos

            </div>

        <?php
        }
    }

    public function cambiar_estado_permiso($conexion, $PermisoId, $P_estado)
    {
        try {
            $sql = "CALL SP_update_estado_Permiso_admin($PermisoId, :estado)";
            $consulta = $conexion->prepare($sql);
            $consulta->bindParam(':estado', $P_estado);
            $consulta->execute();
            $estado='bien';

        } catch (PDOException $e) {
            // echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
            ?>
              <div class="alert alert-danger alert-dismissible fade show " role="alert">
              <strong>Error!</strong> Debido a un problema, no se pudo cambiar el estado del rol, intentelo mas tarde
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            <?php
            $estado='mal';
        }
        return $estado;
    }

    public function Validar_RolPermiso($nombre, $descripcion)
    {
        $errores = [];
        $RolPerNombre = trim($nombre);
        $RolPerDescripcion= trim($descripcion);


        if (empty($RolPerNombre)) {
            $errores['catego'] = "El nombre es requerido";
        }elseif (strlen($RolPerNombre) > 50) {
            $errores['catego'] = "El nombre no debe tener mas de 50 caracteres";
        }elseif (!preg_match("/^[a-zA-Z\sñáéíóúÁÉÍÓÚÑ]+$/", $RolPerNombre)) {
            $errores['catego'] = "El nombre solo debe de tener letras";
        }
        if (empty( $RolPerDescripcion)) {
            $errores['descrip'] = "La descripcion es requerida";
        } elseif (strlen($RolPerDescripcion) > 120) {
            $errores['descrip'] = "La descripcion no debe tener mas de 120 letras";
        } elseif (!preg_match("/^[a-zA-Z0-9\sñáéíóúÁÉÍÓÚÑ(,.;)]+$/", $RolPerDescripcion)) {
            $errores['descrip'] = "La descripcion no puede tener signos como @ $ & % # etc";
        }

        return $errores;
    }

    public function detallePermiso($conexion, $id)
    {
        try {
            $sql = "CALL SP_select_Permiso_id_admin($id)";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $pdtid = $consulta->fetch(PDO::FETCH_ASSOC);
            return $pdtid;
        } catch (PDOException $e) {
            // echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
            ?>
            <div class="alert alert-danger alert-dismissible fade show " role="alert">
              <strong>Error!</strong><br> Debido a un problema, no se pudo mostrar los datos del Permiso
            </div>  
            <?php
        }
    }

    public function update_permiso($conexion, $nombrePer, $descripPer, $id)
    {
        try {
            $sql = "CALL SP_update_Permiso_admin($id, :nombre, :descrip)";
            $consulta = $conexion->prepare($sql);
            $consulta->bindParam(':nombre', $nombrePer);
            $consulta->bindParam(':descrip', $descripPer); 
            $consulta->execute();
            $estado = 'bien';
        } catch (PDOException $e) {
              echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
            ?>
                <div class="alert alert-danger alert-dismissible fade show " role="alert">
                    <strong>Error!</strong><br> Debido a un problema no se ha podido actualizar los datos del rol, intentelo mas tarde
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php            
            $estado = 'fallo';
        }
        return $estado;
    }

}

?>