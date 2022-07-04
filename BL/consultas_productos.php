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

    public function insetar_producto($conexion, $pdto)
    {
        try {
            $sql = "CALL SP_insertar_producto_admin(:categoria, :nombre, :precio, :stock, :descrip, :tamano, :estado)";
            $consulta = $conexion->prepare($sql);
            $consulta->bindParam(':categoria', $pdto->getProduct_categoria());
            $consulta->bindParam(':nombre', $pdto->getProduct_nombre());
            $consulta->bindParam(':precio', $pdto->getProduct_precio());
            $consulta->bindParam(':stock', $pdto->getProduct_stock());
            $consulta->bindParam(':descrip', $pdto->getProduct_descripcion()); 
            $consulta->bindParam(':tamano', $pdto->getProduct_size_perro());
            $consulta->bindParam(':estado', $pdto->getProduct_estado()); 
            $consulta->execute();
            $estado = 'bien';
        } catch (PDOException $e) {
            // echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
            ?>
                <div class="alert alert-danger alert-dismissible fade show " role="alert">
                    <strong>Error!</strong><br> Debido a un problema no se ha podido agregar el producto, intentelo mas tarde
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php            
            $estado = 'fallo';
        }
        return $estado;
    }

    public function Validar_registroPdt($pdto)
    {
        $errores = [];
        $category = trim($pdto->getProduct_categoria());
        $producto = trim($pdto->getProduct_nombre());
        $precio = trim($pdto->getProduct_precio());
        $stock = (int)trim($pdto->getProduct_stock());
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
        } elseif (!preg_match("/^[a-zA-Z\sñáéíóúÁÉÍÓÚÑ]+$/", $producto)) {
            $errores['pdt'] = "El nombre del producto solo debe de tener letras";
        }

        if (empty($precio)) {
            $errores['precio'] = "El campo Precio es requerido";
        } elseif ($precio < 0) {
            $errores['precio'] = "El Precio no puede ser un numero negativo";
        } elseif (!preg_match('/^\d{1,3}(\.\d{1,2})?$/', $precio)) {
            $errores['precio'] = "El Precio despues del punto decimal puede tener maximo 2 numeros decimales";
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
        } elseif (strlen($descrip) < 40) {
            $errores['descrip'] = "La descripcion debe tener mas de 40 caracteres";
        } elseif (!preg_match("/^[a-zA-Z0-9\sñáéíóúÁÉÍÓÚÑ(,.;)]+$/", $descrip)) {
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

    public function detalleProducto($conexion, $id)
    {
        try {
            $sql = "CALL SP_select_producto_id_admin($id)";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $pdtid = $consulta->fetch(PDO::FETCH_ASSOC);
            return $pdtid;
        } catch (PDOException $e) {
            // echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
            ?>
            <div class="alert alert-danger alert-dismissible fade show " role="alert">
              <strong>Error!</strong><br> Debido a un problema, no se pudo mostrar los datos del producto
            </div>
            <?php
        }
    }

    public function update_producto($conexion, $pdto, $id)
    {
        try {
            $sql = "CALL SP_update_producto_admin($id, :categoria, :nombre, :precio, :stock, :descrip, :tamano, :estado)";
            $consulta = $conexion->prepare($sql);
            $consulta->bindParam(':categoria', $pdto->getProduct_categoria());
            $consulta->bindParam(':nombre', $pdto->getProduct_nombre());
            $consulta->bindParam(':precio', $pdto->getProduct_precio());
            $consulta->bindParam(':stock', $pdto->getProduct_stock());
            $consulta->bindParam(':descrip', $pdto->getProduct_descripcion()); 
            $consulta->bindParam(':tamano', $pdto->getProduct_size_perro());
            $consulta->bindParam(':estado', $pdto->getProduct_estado()); 
            $consulta->execute();
            $estado = 'bien';
        } catch (PDOException $e) {
            // echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
            ?>
                <div class="alert alert-danger alert-dismissible fade show " role="alert">
                    <strong>Error!</strong><br> Debido a un problema no se ha podido actualizar el producto, intentelo mas tarde
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php            
            $estado = 'fallo';
        }
        return $estado;
    }

    public function cambia_estado_producto($conexion, $Puid, $Pestado)
    {
        try {
            $sql = "CALL SP_update_estado_Producto_admin($Puid, :estado)";
            $consulta = $conexion->prepare($sql);
            $consulta->bindParam(':estado', $Pestado);
            $consulta->execute();
            $estado='bien';

        } catch (PDOException $e) {
            //  echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
            ?>
              <div class="alert alert-danger alert-dismissible fade show " role="alert">
              <strong>Error!</strong> Debido a un problema , no se pudo cambiar el estado del producto
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            <?php
            $estado='mal';
        }
        return $estado;
    }

    public function listarImgProducto($conexion, $id)
    {
        try {
            $sql = "CALL SP_select_img_producto_id_admin($id)";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $pdtImgid = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $pdtImgid;
        } catch (PDOException $e) {
            // echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
            ?>
            <div class="alert alert-danger alert-dismissible fade show " role="alert">
              <strong>Error!</strong><br> Debido a un problema, no se pudo mostrar imagenes del producto
            </div>
            <?php
        }
    }

    public function eliminarImgProducto($conexion, $id)
    {
        try {
            $sql = "CALL SP_delete_img_producto_id_admin($id)";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $estado='bien';

        } catch (PDOException $e) {
            // echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
            ?>
            <div class="alert alert-danger alert-dismissible fade show " role="alert">
              <strong>Error!</strong><br> Debido a un problema, no se pudo eliminar la imagen del producto
            </div>

            <?php
            $estado='mal';
        }
        return $estado;
    }

    public function cambia_estado_Imgproducto_Desac($conexion, $Imgid)
    {
        try {
            $sql = "CALL SP_update_estado_Desac_img_producto_admin($Imgid)";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $estado='bien';

        } catch (PDOException $e) {
            // echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
            ?>
              <div class="alert alert-danger alert-dismissible fade show " role="alert">
              <strong>Error!</strong> Debido a un problema, no se pudo cambiar la visibilidad de la imagen producto, intentelo mas tarde
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            <?php
            $estado='mal';
        }
        return $estado;
    }

    public function cambia_estado_Imgproducto_Acti($conexion, $Imgid)
    {
        try {
            $sql = "CALL SP_update_estado_Acti_img_producto_admin($Imgid)";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $estado='bien';

        } catch (PDOException $e) {
            // echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
            ?>
              <div class="alert alert-danger alert-dismissible fade show " role="alert">
              <strong>Error!</strong> Debido a un problema, no se pudo cambiar la visibilidad de la imagen producto, intentelo mas tarde
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            <?php
            $estado='mal';
        }
        return $estado;
    }

    public function insertar_fotoProducto($conexion, $img)
    {
        try {
            $sql = "CALL SP_agrega_img_producto_id_admin(:p_id, :fNombre, :foto, :fTipo)";
            $consulta = $conexion->prepare($sql);
            $consulta->bindValue(':p_id', $img->getId_producto());
            $consulta->bindValue(':fNombre', $img->getImg_producto_nombre());
            $consulta->bindValue(':foto', $img->getImg_producto_foto());
            $consulta->bindValue(':fTipo', $img->getImg_producto_tipo());
            $consulta->execute();
            $estado = 'bien';
        } catch (PDOException $e) {
            // echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
            ?>
                <div class="alert alert-danger alert-dismissible fade show " role="alert">
                    <strong>Error!</strong><br> Debido a un error no se ha podido agregar la foto del producto, intentelo mas tarde
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php            
            $estado = 'fallo';
        }
        return $estado;
    }
}
// ---------------------------------
//          CLASE CATEGORIA
// ---------------------------------
class Consulta_categoria{
    public function listarCategorias($conexion)
    {
        try {
            $sql = "CALL SP_select_categorias_admin()";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $pdtImgid = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $pdtImgid;
        } catch (PDOException $e) {
            // echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
            ?>
            <div class="alert alert-danger alert-dismissible fade show " role="alert">
              <strong>Error!</strong><br> Debido a un problema, no se pudo listar las categorias
            </div>
            <?php
        }
    }

    public function cambia_estado_categoria($conexion, $Cuid, $Cestado)
    {
        try {
            $sql = "CALL SP_update_estado_Categoria_admin($Cuid, :estado)";
            $consulta = $conexion->prepare($sql);
            $consulta->bindParam(':estado', $Cestado);
            $consulta->execute();
            $estado='bien';

        } catch (PDOException $e) {
            //  echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
            ?>
              <div class="alert alert-danger alert-dismissible fade show " role="alert">
              <strong>Error!</strong> Debido a un problema , no se pudo cambiar el estado de la categoria
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            <?php
            $estado='mal';
        }
        return $estado;
    }

    public function Validar_registroCat($cat)
    {
        $errores = [];
        $categoria = trim($cat->getCat_nombre());
        $descripcion= trim($cat->getCat_descripcion());


        if (empty($categoria)) {
            $errores['catego'] = "El nombre de la Categoria es requerido";
        }elseif (strlen($categoria) < 4 || strlen($categoria) > 50) {
            $errores['catego'] = "El nombre de la categoria no debe tener no menos de 5 caracteres";
        }elseif (!preg_match("/^[a-zA-Z\sñáéíóúÁÉÍÓÚÑ]+$/", $categoria)) {
            $errores['catego'] = "El nombre de la categoria solo debe de tener letras";
        }
        if (empty($descripcion)) {
            $errores['descrip'] = "La descripcion de la categoria es requerida";
        } elseif (strlen($descripcion) > 150) {
            $errores['descrip'] = "La descripcion de la categoria no debe tener mas de 150 letras";
        } elseif (!preg_match("/^[a-zA-Z0-9\sñáéíóúÁÉÍÓÚÑ(,.;)]+$/", $descripcion)) {
            $errores['descrip'] = "La descripcion no puede tener signos como @ $ & % # etc";
        }

        return $errores;
    }

    public function insetar_categoria($conexion, $cat)
    {
        try {
            $sql = "CALL SP_insert_categoria_admin(:categoria, :descrip)";
            $consulta = $conexion->prepare($sql);
            $consulta->bindParam(':categoria', $cat->getCat_nombre());
            $consulta->bindParam(':descrip', $cat->getCat_descripcion()); 
            $consulta->execute();
            $estado = 'bien';
        } catch (PDOException $e) {
            // echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
            ?>
                <div class="alert alert-danger alert-dismissible fade show " role="alert">
                    <strong>Error!</strong><br> Debido a un problema no se ha podido agregar el producto, intentelo mas tarde
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php            
            $estado = 'fallo';
        }
        return $estado;
    }

    public function detalleCategoria($conexion, $id)
    {
        try {
            $sql = "CALL SP_select_categoria_id_admin($id)";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $pdtid = $consulta->fetch(PDO::FETCH_ASSOC);
            return $pdtid;
        } catch (PDOException $e) {
            // echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
            ?>
            <div class="alert alert-danger alert-dismissible fade show " role="alert">
              <strong>Error!</strong><br> Debido a un problema, no se pudo mostrar los datos de la categoria
            </div>  
            <?php
        }        
    }

    public function update_categoria($conexion, $cat, $id)
    {
        try {
            $sql = "CALL SP_update_categoria_admin($id, :categoria, :descrip)";
            $consulta = $conexion->prepare($sql);
            $consulta->bindParam(':categoria', $cat->getCat_nombre());
            $consulta->bindParam(':descrip', $cat->getCat_descripcion()); 
            $consulta->execute();
            $estado = 'bien';
        } catch (PDOException $e) {
            //  echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
            ?>
                <div class="alert alert-danger alert-dismissible fade show " role="alert">
                    <strong>Error!</strong><br> Debido a un problema no se ha podido actualizar la categoria, intentelo mas tarde
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php            
            $estado = 'fallo';
        }
        return $estado;
    }


}
?>