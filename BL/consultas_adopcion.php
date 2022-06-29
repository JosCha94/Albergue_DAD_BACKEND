<?php
class Consulta_adopcion{

    //MUESTRA TODOS LOS DATOS DE LA TABLA ADOPCIONES
    public function ad_listar_adopciones($conexion) {
        try{
            $sql = "CALL SP_admin_select_adopciones()";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $adop = $consulta->fetchall(PDO::FETCH_ASSOC);
            return $adop;
        } catch (PDOException $e) {
            echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
        }
    }

    public function mostrar_datosAdo($conexion, $id) {
        try{
            $sql = "CALL SP_admin_select_datos_adopcion($id)";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $adop = $consulta->fetch(PDO::FETCH_ASSOC);
            return $adop;
        } catch (PDOException $e) {
            echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
        }
    }


    public function updateEstadoAdop($conexion, $idAdop, $entrevista)
    {
        try {
            $sql = "CALL SP_admin_updateEstado_adopcion($idAdop, :fechaHora)";
            $consulta = $conexion->prepare($sql);
            $consulta->bindValue(':fechaHora', $entrevista->getEntrevista());
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

    public function ad_listar_entrevista($conexion) {
        try{
            $sql = "CALL SP_admin_select_entrevistas()";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $entre = $consulta->fetchall(PDO::FETCH_ASSOC);
            return $entre;
        } catch (PDOException $e) {
            echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
        }
    }

    public function ad_listar_finalizadas($conexion) {
        try{
            $sql = "CALL SP_admin_select_adop_final()";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $final = $consulta->fetchall(PDO::FETCH_ASSOC);
            return $final;
        } catch (PDOException $e) {
            echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
        }
    }


    public function rechazar_adopcion($conexion, $ado_id)
    {
        try {
            $sql = "CALL SP_admin_adop_rechazar($ado_id)";
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

    public function aceptar_adopcion($conexion, $ado_id, $obs)
    {
        try {
            $sql = "CALL SP_admin_adop_aceptar($ado_id, :observaciones)";
            $consulta = $conexion->prepare($sql);
            $consulta->bindValue(':observaciones', $obs->getObservaciones());
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

    
    public function user_mail($conexion, $adId) {
        try{
            $sql = "CALL SP_admin_user_mail($adId)";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $mail = $consulta->fetch(PDO::FETCH_ASSOC);
            return $mail;
        } catch (PDOException $e) {
            echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
            ?>
            <!-- <div class="alert alert-danger alert-dismissible fade show " role="alert">
                <strong>Error!</strong> Devido a un error en la base de datos, no se pudo deshabilitar el producto
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div> -->
            <?php

        }
    }


 
}


