<?php
class Consulta_producto
{
    public function listarProductos($conexion)
    {
        try {
            $sql = "CALL SP_productos_admin()";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $user = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $user;
        } catch (PDOException $e) {
            // echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
?>
            <div class="alert alert-danger alert-dismissible fade show " role="alert">
                <strong class="fs-3">Error!</strong><br>Debido a un problema, por el momento no se puede listar los productos

            </div>

            <?php
        }
    }

    public function listarCategorias($conexion)
    {
        try {
            $sql = "CALL SP_select_categorias()";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $categorias = $consulta->fetchAll(PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {
            // echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
            $categorias = 'falloCatego';
        ?>
            <div class="alert alert-danger alert-dismissible fade show " role="alert">
                <strong class="fs-3">Error!</strong><br> Ocurrió un ERROR y no se puede mostrar los filtros

            </div>

        <?php
        }
        return $categorias;
    }

    public function insetar_producto($conexion, $usu)
    {
        try {
            $sql = "CALL SP_insertar_usuario(:usuario, :clave, :nombre, :ape_pat, :ape_mat, :email, :celular)";
            $consulta = $conexion->prepare($sql);
            $consulta->bindValue(':usuario', $usu->getUsuario());
            $consulta->bindValue(':clave', $usu->getUsr_clave());
            $consulta->bindValue(':nombre', $usu->getUsr_nombre());
            $consulta->bindValue(':ape_pat', $usu->getUsr_apellido_paterno());
            $consulta->bindValue(':ape_mat', $usu->getUsr_apellido_materno());
            $consulta->bindValue(':email', $usu->getUsr_email());
            $consulta->bindValue(':celular', $usu->getUsr_celular());
            $consulta->execute();
            $estado = 'bien';
        } catch (PDOException $e) {
            // echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
            $bad = $e->getMessage();
            $cel = 'UK_numero_celular_USR';
            $email = 'UK_email_USR';

            $cel_coincidencia = strpos($bad, $cel);
            $email_coincidencia = strpos($bad, $email);
            if ($cel_coincidencia !== false) { ?>
                <div class="alert alert-danger alert-dismissible fade show " role="alert">
                    <strong>Error!</strong> El numero de celular ya existe, ingrese otro numero de celular
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php
            } elseif ($email_coincidencia !== false) { ?>
                <div class="alert alert-danger alert-dismissible fade show " role="alert">
                    <strong>Error!</strong> El correo electronico ya existe, ingrese otra dirreción de correo
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
<?php
            };
            $estado = 'mal';
        }
        return $estado;
    }

    public function Validar_registroPdt($pdto)
    {
        $errores = [];
        $category = trim($pdto->getProduct_categoria());
        $producto = trim($pdto->getProduct_nombre());
        $precio = trim($pdto->getProduct_precio());
        $stock = trim($pdto->getProduct_stock());
        $descrip = trim($pdto->getProduct_descripcion());
        $sizeDog = trim($pdto->getProduct_size_perro());
        $estado = trim($pdto->getProduct_estado());

        if (empty($category)) {
            $errores['catego'] = "Campo Categoria es requerido";
        }
        if (empty($producto)) {
            $errores['pdt'] = "El nombre del producto es requerido";
        } elseif (strlen($producto) < 5 || strlen($producto) > 50) {
            $errores['pdt'] = "El nombre del producto debe tener no menos de 5 caracteres";
        } elseif (ctype_alpha($producto) == false) {
            $errores['pdt'] = "El nombre del producto solo debe de tener letras";
        }

        if (empty($precio)) {
            $errores['precio'] = "El campo Precio es requerido";
        } elseif ($precio < 0) {
            $errores['precio'] = "El Precio no puede ser un numero negativo";
        } elseif (is_float($precio) && preg_match('/^\d{1,3}(\.\d{1,2})?$/', $precio)) {
            $errores['precio'] = "El Precio debe tener punto decimal y maximo 2 numeros decimales";
        }

        if (empty($stock)) {
            $errores['stock'] = "El campo Stock es requerido";
        } elseif (!is_int($stock)) {
            $errores['stock'] = "El Stock debe ser un numero entero";
        } elseif ($stock < 0) {
            $errores['stock'] = "El Stock no puede ser un numero negativo";
        } elseif ($stock > 32760) {
            $errores['stock'] = "El Stock no puede ser mayor a 32760";
        }

        if (empty($descrip)) {
            $errores['descrip'] = "La descripcion del producto es requerida";
        } elseif (strlen($descrip) > 40) {
            $errores['descrip'] = "La descripcion debe tener mas de 40 caracteres";
        } elseif (preg_match("/^[a-zA-Z0-9\sñ(,.;)]+$/", $descrip)) {
            $errores['descrip'] = "La descripcion no puede tener signos como @ $ & % # etc";
        }

        if (empty($sizeDog)) {
            $errores['tamano'] = "El campo Tamaño de perrito es requerido";
        }
        if (empty($estado)) {
            $errores['celu'] = "El campo Estado es requerido";
        }
        return $errores;
    }
}
?>