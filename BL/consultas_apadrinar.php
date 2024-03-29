<?php

class Consulta_suscripcion
{

    public function listarSuscripAdmin($conexion)
    {
        try {
            $sql = "CALL SP_admin_select_suscipciones()";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $sus = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $sus;
        } catch (PDOException $e) {
            // echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
            ?>
            <div class="alert alert-danger alert-dismissible fade show " role="alert">
                <strong class="fs-3">Error!</strong><br>Debido a un problema, por el momento no se puede listar las suscripciones
            </div>

            <?php
        }
    }
    public function listarTipoSuscripcion($conexion)
    {
        try {
            $sql = "CALL SP_mostrar_tipoSucripcion()";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $sus = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $sus;
        } catch (PDOException $e) {
            // echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
            ?>
            <div class="alert alert-danger alert-dismissible fade show " role="alert">
                <strong class="fs-3">Error!</strong><br>Debido a un problema, por el momento no se puede listar las suscripciones
            </div>
            <?php
        }
    }

    

    public function cancelar_suscipcion($conexion, $id)
    {
        try {
            $sql = "CALL SP_admin_cancelar_suscri($id)";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $estado='bien';

        } catch (PDOException $e) {
            // echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
            ?>
              <div class="alert alert-danger alert-dismissible fade show " role="alert">
                <strong>Error!</strong> Devido a un error en la base de datos, no se pudo deshabilitar el producto
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            <?php
            $estado='mal';
        }
        return $estado;
    }

    public function habilitar_suscripcion($conexion, $id)
    {
        try {
            $sql = "CALL SP_admin_habilitar_suscri($id)";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $estado='bien';

        } catch (PDOException $e) {
            // echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
            ?>
              <div class="alert alert-danger alert-dismissible fade show " role="alert">
                <strong>Error!</strong> Devido a un error en la base de datos, no se pudo deshabilitar el producto
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            <?php
            $estado='mal';
        }
        return $estado;
    }

    public function listarTipo_suscri($conexion, $id)
    {
        try {
            $sql = "CALL SP_admin_select_tipoSuscri($id)";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $sus = $consulta->fetch(PDO::FETCH_ASSOC);
            return $sus;
        } catch (PDOException $e) {
            // echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
            ?>
            <div class="alert alert-danger alert-dismissible fade show " role="alert">
                <strong class="fs-3">Error!</strong><br>Debido a un problema, por el momento no se puede listar las suscripciones
            </div>

            <?php
        }
    }

    
    public function update_tipoSus($conexion, $id, $tipo)
    {
        try {
            $sql = "CALL SP_admin_update_tipoSus($id, :nombre, :precio, :descripcion, :estado)";
            $consulta = $conexion->prepare($sql);
            $consulta->bindValue(':nombre', $tipo->getS_tipo_nombre());
            $consulta->bindValue(':precio', $tipo->getS_tipo_precio());
            $consulta->bindValue(':descripcion', $tipo->getS_tipo_descripcion());
            $consulta->bindValue(':estado', $tipo->getS_tipo_estado());
            $consulta->execute();
            $estado = 'bien';
        } catch (PDOException $e) {
            // echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
            ?>
                <div class="alert alert-danger alert-dismissible fade show " role="alert">
                    <strong>Error!</strong><br> Debido a un error no se ha podido actualizar los datos del producto, intentelo mas tarde
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php            
            $estado = 'fallo';
        }
        return $estado;
    }
    
    
}
?>


