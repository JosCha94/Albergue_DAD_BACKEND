<?php
class Post{
    private $post_id;
    private $post_autor;
    private $post_titulo;
    private $post_descripcion;
    private $post_estado;



    public function __construct($post_autor, $post_titulo, $post_descripcion, $post_estado){

        $this->post_autor = $post_autor;
        $this->post_titulo = $post_titulo;
        $this->post_descripcion = $post_descripcion;
        $this->post_estado = $post_estado;
    }


    public function getPost_autor(){
        return $this->post_autor;
    }
    public function getPost_titulo(){
        return $this->post_titulo;
    }
    public function getPost_descripcion(){
        return $this->post_descripcion;
    }
    public function getPost_estado(){
        return $this->post_estado;
    }


    public function setPost_autor($post_autor){
        $this->post_autor = $post_autor;
    }
    public function setPost_titulo($post_titulo){
        $this->post_titulo = $post_titulo;
    }
    public function setPost_descripcion($post_descripcion){
        $this->post_descripcion = $post_descripcion;
    }
    public function setPost_estado($post_estado){
        $this->post_estado = $post_estado;
    }
}
?>