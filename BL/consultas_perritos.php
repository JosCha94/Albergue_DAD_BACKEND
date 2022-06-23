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

    public function insertar_perrito($conexion, $perro)
    {
        try {
            $sql = "CALL SP_admin_insertar_perrito(:nombre, :peso, :tamano, :fNacimiento, :sexo, :actividad, :descripcion)";
            $consulta = $conexion->prepare($sql);
            $consulta->bindValue(':nombre', $perro->getPerro_nombre());
            $consulta->bindValue(':peso', $perro->getPerro_peso());
            $consulta->bindValue(':tamano', $perro->getPerro_tamano());
            $consulta->bindValue(':fNacimiento', $perro->gerPerro_nacimiento());
            $consulta->bindValue(':sexo', $perro->getPerro_sexo()); 
            $consulta->bindValue(':actividad', $perro->getPerro_actividad());
            $consulta->bindValue(':descripcion', $perro->getPerro_descripcion()); 
            $consulta->execute();
            $estado = 'bien';
        } catch (PDOException $e) {
            // echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
            ?>
                <div class="alert alert-danger alert-dismissible fade show " role="alert">
                    <strong>Error!</strong><br> Debido a un error no se ha podido agregar el perrito, intentelo mas tarde
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php            
            $estado = 'fallo';
        }
        return $estado;
        
    }

    public function Validar_registroPerrito($perro)
    {
        $errores = [];
        $p_nom = trim($perro->getPerro_nombre());
        $p_peso = trim($perro->getPerro_peso());
        $p_tamano = trim($perro->getPerro_tamano());
        $p_nacimento = trim($perro->gerPerro_nacimiento());
        $p_sexo = trim($perro->getPerro_sexo());
        $p_actividad = trim($perro->getPerro_actividad());
        $p_descrip = trim($perro->getPerro_descripcion());

        if (empty($p_nom)) {
            $errores['nombre'] = "El campo Nombre es obligatorio";
        }
        if (empty($p_peso)) {
            $errores['peso'] = "El campo peso es obligatorio";
        } elseif ($p_peso < 0) {
            $errores['peso'] = "El peso no puede ser un numero negativo";
        } elseif (!preg_match('/^\d{1,3}(\.\d{1,2})?$/', $p_peso)) {
            $errores['peso'] = "El peso debe tener como maximo 2 numeros decimales";
        }
        if (empty($p_tamano)) {
            $errores['tamano'] = "El campo tamaño es obligatorio";
        }
        if (empty($p_nacimento)) {
            $errores['nacimiento'] = "El campo fecha de naciomiento es obligatorio";
        }
        if (empty($p_sexo)) {
            $errores['sexo'] = "El campo sexo es obligatorio";
        }
        if (empty($p_actividad)) {
            $errores['actividad'] = "El campo actividad es obligatorio";
        }
        if (empty($p_descrip)) {
            $errores['descrip'] = "La descripcion del perrito es obligatoria";
        } elseif (strlen($p_descrip) < 15) {
            $errores['descrip'] = "La descripcion debe tener mas de 15 caracteres";
        } elseif (!preg_match("/^[a-zA-Z0-9\sñáéíóúÁÉÍÓÚÑ(,.;)]+$/", $p_descrip)) {
            $errores['descrip'] = "La descripcion no puede tener signos como @ $ & % # etc";
        }
        return $errores;
    }

    
    public function insertar_fotoPerrito($conexion, $img)
    {
        try {
            $sql = "CALL SP_admin_insertar_fotoPerrito(:p_id, :foto, :fNombre, :fTipo)";
            $consulta = $conexion->prepare($sql);
            $consulta->bindValue(':p_id', $img->getPerro_id());
            $consulta->bindValue(':foto', $img->getImg_perro_foto());
            $consulta->bindValue(':fNombre', $img->getImg_perro_nombre());
            $consulta->bindValue(':fTipo', $img->getImg_perro_tipo());
            $consulta->execute();
            $estado = 'bien';
        } catch (PDOException $e) {
            // echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
            ?>
                <div class="alert alert-danger alert-dismissible fade show " role="alert">
                    <strong>Error!</strong><br> Debido a un error no se ha podido agregar el perrito, intentelo mas tarde
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php            
            $estado = 'fallo';
        }
        return $estado;
    }



}



?>