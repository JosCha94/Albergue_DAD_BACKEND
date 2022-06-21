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

            <?php
        }
    }



    
  
}
?>