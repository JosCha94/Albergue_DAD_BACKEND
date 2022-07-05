<?php
class Post{
    private $id_usr;
    private $rol_usr;
    private $post_titulo;
    private $post_autor;
    private $post_descripcion;
    private $post_estado;

    public function __construct($id_usr, $rol_usr, $post_titulo, $post_autor, $post_descripcion, $post_estado){
        $this->id_usr = $id_usr;
        $this->rol_usr = $rol_usr;
        $this->post_titulo = $post_titulo;
        $this->post_autor = $post_autor;
        $this->post_descripcion = $post_descripcion;
        $this->post_estado = $post_estado;
    }

    public function getId_usr(){
        return $this->id_usr;
    }
    public function getRol_usr(){
        return $this->rol_usr;
    }
    public function getPost_titulo(){
        return $this->post_titulo;
    }
    public function getPost_autor(){
        return $this->post_autor;
    }
    public function getPost_descripcion(){
        return $this->post_descripcion;
    }
    public function getPost_estado(){
        return $this->post_estado;
    }


    public function setId_usr($id_usr){
        $this->id_usr = $id_usr;
    }
    public function setRol_usr($rol_usr){
        $this->rol_usr = $rol_usr;
    }
    public function setPost_titulo($post_titulo){
        $this->post_titulo = $post_titulo;
    }
    public function setPost_autor($post_autor){
        $this->post_autor = $post_autor;
    } 
    public function setPost_descripcion($post_descripcion){
        $this->post_descripcion = $post_descripcion;
    }
    public function setPost_estado($post_estado){
        $this->post_estado = $post_estado;
    }


    
}
?>