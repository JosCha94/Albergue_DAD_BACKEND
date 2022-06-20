<?php
class Consulta_adopcion{

    //MUESTRA TODOS LOS DATOS DE LA TABLA ADOPCIONES
    public function ad_listar_adiociones($conexion) {
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

    public function ad_update_estado_adop($conexion, $id) {
        try{
            $sql = "CALL SP_admin_updateEstado_adopcion($id)";
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

 
}
?>
