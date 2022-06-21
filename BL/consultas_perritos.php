<?php
Class Consulta_perrito
{
    public function listarPerritos($conexion)
    {
        try {
            $sql = "CALL SP_mostrar_perritos()";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $perrito = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $perrito;
        } catch (PDOException $e) {
            // echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
            ?>
            <div class="alert alert-danger alert-dismissible fade show " role="alert">
                <strong class="fs-3">Error!</strong><br>Debido a un problema, por el momento no se puede listar los perritos

            <?php
        }
    }

    public function listarPerritosPorId($conexion, $id)
    {
        try {
            $sql = "CALL SP_admin_select_perrito_byId($id)";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $perId = $consulta->fetch(PDO::FETCH_ASSOC);
            return $perId;
        } catch (PDOException $e) {
            // echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
            ?>
            <div class="alert alert-danger alert-dismissible fade show " role="alert">
                <strong class="fs-3">Error!</strong><br>Debido a un problema, por el momento no se puede listar los perritos

            <?php
        }
    }



    public function listarImgs_perritos($conexion, $id)
    {
        try {
            $sql = "CALL SP_listar_img_byId($id)";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $imgs = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $imgs;
        } catch (PDOException $e) {
            // echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
            ?>
            <div class="alert alert-danger alert-dismissible fade show " role="alert">
                <strong class="fs-3">Error!</strong><br>Debido a un problema, por el momento no se puede listar los perritos

            <?php
        }
    }



}



?>