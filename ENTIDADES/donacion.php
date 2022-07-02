<?php
class Donacion{
    private $dona_nombres;
    private $dona_apellidos;
    private $dona_correo;
    private $dona_celular;
    private $dona_vaucher;
    private $dona_tipo_img;
    private $dona_monto;

    public function __construct( $dona_nombres, $dona_apellidos, $dona_correo, $dona_celular, $dona_vaucher, $dona_tipo_img, $dona_monto){
        $this->dona_nombres = $dona_nombres;
        $this->dona_apellidos = $dona_apellidos;
        $this->dona_correo = $dona_correo;
        $this->dona_celular = $dona_celular;
        $this->dona_vaucher = $dona_vaucher;
        $this->dona_tipo_img =$dona_tipo_img;
        $this->dona_monto = $dona_monto;
    }

    public function getDona_nombres(){
        return $this->dona_nombres;
    }
    public function getDona_apellidos(){
        return $this->dona_apellidos;
    }
    public function getDona_correo(){
        return $this->dona_correo;
    }
    public function getDona_celular(){
        return $this->dona_celular;
    }
    public function getDona_vaucher(){
        return $this->dona_vaucher;
    }
    public function getDona_tipo_img(){
        return $this->dona_tipo_img;
    } 
    public function getDona_monto(){
        return $this->dona_monto;
    }
    
    public function setDona_nombres($dona_nombres){
        $this->dona_nombres = $dona_nombres;
    }
    public function setDona_apellidos($dona_apellidos){
        $this->dona_apellidos = $dona_apellidos;
    }
    public function setDona_correo($dona_correo){
        $this->dona_correo = $dona_correo;
    }
    public function setDona_celular($dona_celular){
        $this->dona_celular = $dona_celular;
    }
    public function setDona_vaucher($dona_vaucher){
        $this->dona_vaucher = $dona_vaucher;
    }
    public function setDona_tipo_img($dona_tipo_img){
        $this->dona_tipo_img = $dona_tipo_img;
    }
    public function setDona_monto($dona_monto){
        $this->dona_monto = $dona_monto;
    }
}
?>