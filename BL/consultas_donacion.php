<?php
class Consulta_donacion
{
    public function listarDonaciones($conexion)
    {
        try {
            $sql = "CALL SP_select_donaciones()";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $donacion = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $donacion;
        } catch (PDOException $e) {
            // echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
            ?>
            <div class="alert alert-danger alert-dismissible fade show " role="alert">
                <strong class="fs-3">Error!</strong><br>Debido a un problema, por el momento no se pueden mostrar las donaciones, intentelo mas tarde por favor.
            </div>
            <?php
        }
    }   
}
?>