<?php

class tipo_suscripcion{
    private $s_tipo_nombre;
    private $s_tipo_descripcion;
    private $s_tipo_precio;
    private $s_tipo_tiempo;
    private $s_tipo_estado;
    private $s_tipo_fecha_creacion;

    public function __construct($s_tipo_nombre, $s_tipo_descripcion, $s_tipo_precio, $s_tipo_tiempo, $s_tipo_estado, $s_tipo_fecha_creacion){
        $this->s_tipo_nombre = $s_tipo_nombre;
        $this->s_tipo_descripcion = $s_tipo_descripcion;
        $this->s_tipo_precio = $s_tipo_precio;
        $this->s_tipo_tiempo = $s_tipo_tiempo;
        $this->s_tipo_estado = $s_tipo_estado;
        $this->s_tipo_fecha_creacion = $s_tipo_fecha_creacion;
        
    }

    public function getS_tipo_nombre(){
        return $this->s_tipo_nombre;
    }
    public function getS_tipo_descripcion(){
        return $this->s_tipo_descripcion;
    }
    public function getS_tipo_precio(){
        return $this->s_tipo_precio;
    }
    public function getS_tipo_tiempo(){
        return $this->s_tipo_tiempo;
    }
    public function getS_tipo_estado(){
        return $this->s_tipo_estado;
    }
    public function getS_tipo_fecha_creacion(){
        return $this->s_tipo_fecha_creacion;
    }


    public function setS_tipo_nombre($s_tipo_nombre){
        $this->s_tipo_nombre = $s_tipo_nombre;
    }
    public function setS_tipo_descripcion($s_tipo_descripcion){
        $this->s_tipo_descripcion = $s_tipo_descripcion;
    }
    public function setS_tipo_precio($s_tipo_precio){
        $this->s_tipo_precio = $s_tipo_precio;
    }
    public function setS_tipo_tiempo($s_tipo_tiempo){
        $this->s_tipo_tiempo = $s_tipo_tiempo;
    }
    public function setS_tipo_estado($s_tipo_estado){
        $this->s_tipo_estado = $s_tipo_estado;
    }
    public function setS_tipo_fecha_creacion($s_tipo_fecha_creacion){
        $this->s_tipo_fecha_creacion = $s_tipo_fecha_creacion;
    }

}

?>