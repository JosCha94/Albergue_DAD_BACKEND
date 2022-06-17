<?php
class Categoria{
    private $cat_id;
    private $cat_nombre;
    private $cat_descripcion;
    private $cat_estado;

    public function __construct($cat_id, $cat_nombre, $cat_descripcion, $cat_estado){
        $this->cat_id = $cat_id;
        $this->cat_nombre = $cat_nombre;
        $this->cat_descripcion = $cat_descripcion;
        $this->cat_estado = $cat_estado;
    }

    public function getCat_id(){
        return $this->cat_id;
    }
    public function getCat_nombre(){
        return $this->cat_nombre;
    }
    public function getCat_descripcion(){
        return $this->cat_descripcion;
    }
    public function getCat_estado(){
        return $this->cat_estado;
    }

    public function setCat_id($cat_id){
        $this->cat_id = $cat_id;
    }
    public function setCat_nombre($cat_nombre){
        $this->cat_nombre = $cat_nombre;
    }
    public function setCat_descripcion($cat_descripcion){
        $this->cat_descripcion = $cat_descripcion;
    }
    public function setCat_estado($cat_estado){
        $this->cat_estado = $cat_estado;
    }
}
?>