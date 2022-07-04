<?php
class Categoria{
    private $cat_nombre;
    private $cat_descripcion;

    public function __construct($cat_nombre, $cat_descripcion){
        $this->cat_nombre = $cat_nombre;
        $this->cat_descripcion = $cat_descripcion;
    }

    public function getCat_nombre(){
        return $this->cat_nombre;
    }
    public function getCat_descripcion(){
        return $this->cat_descripcion;
    }


    public function setCat_nombre($cat_nombre){
        $this->cat_nombre = $cat_nombre;
    }
    public function setCat_descripcion($cat_descripcion){
        $this->cat_descripcion = $cat_descripcion;
    }
}
?>