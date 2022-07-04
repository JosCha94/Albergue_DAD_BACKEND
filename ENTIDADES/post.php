<?php
class Post{
    private $post_id;
    private $post_autor;
    private $post_titulo;
    private $post_imagen;
    private $post_nombre_img;
    private $post_tipo_img;
    private $post_descripcion;
    private $post_estado;
    private $post_fecha_creacion;
    private $post_fecha_cambio;


    public function __construct($post_id, $post_autor, $post_titulo, $post_imagen, $post_nombre_img, $post_tipo_img, $post_descripcion, $post_estado, $post_fecha_creacion, $post_fecha_cambio){
        $this->post_id = $post_id;
        $this->post_autor = $post_autor;
        $this->post_titulo = $post_titulo;
        $this->post_imagen = $post_imagen;
        $this->post_nombre_img = $post_nombre_img;
        $this->post_tipo_img = $post_tipo_img;
        $this->post_descripcion = $post_descripcion;
        $this->post_estado = $post_estado;
        $this->post_fecha_creación = $post_fecha_creacion;
        $this->post_fecha_cambio = $post_fecha_cambio;
    }

    public function getPost_id(){
        return $this->post_id;
    }
    public function getPost_autor(){
        return $this->post_autor;
    }
    public function getPost_titulo(){
        return $this->post_titulo;
    }
    public function getPost_imagen(){
        return $this->post_imagen;
    }
    public function getPost_nombre_img(){
        return $this->post_nombre_img;
    }
    public function getPost_tipo_img(){
        return $this->post_tipo_img;
    }
    public function getPost_descripcion(){
        return $this->post_descripcion;
    }
    public function getPost_estado(){
        return $this->post_estado;
    }
    public function getPost_fecha_creacion(){
        return $this->post_fecha_creacion;
    }
    public function getPost_fecha_cambio(){
        return $this->post_fecha_cambio;
    }

    public function setPost_id($post_id){
        $this->post_id = $post_id;
    }
    public function setPost_autor($post_autor){
        $this->post_autor = $post_autor;
    }
    public function setPost_titulo($post_titulo){
        $this->post_titulo = $post_titulo;
    }
    public function setPost_imagen($post_imagen){
        $this->post_imagen = $post_imagen;
    }
    public function setPost_nombre_img($post_nombre_img){
        $this->post_nombre_img = $post_nombre_img;
    }
    public function setPost_tipo_img($post_tipo_img){
        $this->post_tipo_img = $post_tipo_img;
    }
    public function setPost_descripcion($post_descripcion){
        $this->post_descripcion = $post_descripcion;
    }
    public function setPost_estado($post_estado){
        $this->post_estado = $post_estado;
    }
    public function setPost_fecha_creacion($post_fecha_creacion){
        $this->post_fecha_creación = $post_fecha_creacion;
    }
    public function setPost_fecha_cambio($post_fecha_cambio){
        $this->post_fecha_cambio = $post_fecha_cambio;
    }
}
?>