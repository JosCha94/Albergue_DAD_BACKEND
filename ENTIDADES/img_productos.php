<?php
class img_producto{
    private $id_producto;
    private $img_producto_nombre;
    private $img_producto_foto;    
    private $img_producto_tipo;

    public function __construct($id_producto, $img_producto_nombre, $img_producto_foto,$img_producto_tipo){
        $this->id_producto = $id_producto;
        $this->img_producto_nombre = $img_producto_nombre;
        $this->img_producto_foto = $img_producto_foto;
        $this->img_producto_tipo = $img_producto_tipo;
    }

    public function getId_producto(){
        return $this->id_producto;
    }
    public function getImg_producto_nombre(){
        return $this->img_producto_nombre;
    }
    public function getImg_producto_foto(){
        return $this->img_producto_foto;
    }
    public function getImg_producto_tipo(){
        return $this->img_producto_tipo;
    }

    public function setId_producto($id_producto){
        $this->id_producto = $id_producto;
    }
    public function setImg_producto_nombre($img_producto_nombre){
        $this->img_producto_nombre = $img_producto_nombre;
    }
    public function setImg_producto_foto($img_producto_foto){
        $this->img_producto_foto = $img_producto_foto;
    }
    public function setImg_producto_tipo($img_producto_tipo){
        $this->img_producto_tipo = $img_producto_tipo;
    }
}