<?php
class img_perritos{
    private $img_perro_id;
    private $perro_id;
    private $img_perro_foto;
    private $img_perro_nombre;
    private $img_perro_tipo;
    private $img_perro_estado;

    public function __construct($img_perro_id, $perro_id, $img_perro_foto, $img_perro_nombre,$img_perro_tipo, $img_perro_estado){
        $this->img_perro_id = $img_perro_id;
        $this->perro_id = $perro_id;
        $this->img_perro_foto = $img_perro_foto;
        $this->img_perro_nombre = $img_perro_nombre;
        $this->img_perro_tipo = $img_perro_tipo;
        $this->img_perro_estado = $img_perro_estado;
    }

    public function getImg_perro_id(){
        return $this->img_perro_id;
    }
    public function getPerro_id(){
        return $this->perro_id;
    }
    public function getImg_perro_foto(){
        return $this->img_perro_foto;
    }
    public function getImg_perro_nombre(){
        return $this->img_perro_nombre;
    }
    public function getImg_perro_tipo(){
        return $this->img_perro_tipo;
    }
    public function getImg_perro_estado(){
        return $this->img_perro_estado;
    }

        
    public function setImg_perro_id($img_perro_id){
        $this->img_perro_id = $img_perro_id;
    }
    public function setPerro_id($perro_id){
        $this->img_perro_id = $img_perro_id;
    }
    public function setImg_perro_foto($img_perro_foto){
        $this->img_perro_foto = $img_perro_foto;
    }
    public function setImg_perro_nombre($img_perro_nombre){
        $this->img_perro_nombre = $img_perro_nombre;
    }
    public function setImg_perro_tipo($img_perro_tipo){
        $this->img_perro_tipo = $img_perro_tipo;
    }
    public function setImg_perro_estado($img_perro_estado){
        $this->img_perro_estado = $img_perro_estado;
    }
}
?>