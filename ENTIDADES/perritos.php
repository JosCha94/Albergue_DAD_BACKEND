<?php
class perritos{
    private $perro_nombre;
    private $perro_peso;
    private $perro_tamano;
    private $perro_nacimiento;
    private $perro_sexo;
    private $perro_actividad;
    private $perro_descripcion;

    public function __construct($perro_nombre, $perro_peso, $perro_tamano, $perro_nacimiento, $perro_sexo, $perro_actividad, $perro_descripcion){
        $this->perro_nombre = $perro_nombre;
        $this->perro_peso = $perro_peso;
        $this->perro_tamano = $perro_tamano;
        $this->perro_nacimiento = $perro_nacimiento;
        $this->perro_sexo = $perro_sexo;
        $this->perro_actividad = $perro_actividad;
        $this->perro_descripcion = $perro_descripcion;
    }

    
    public function getPerro_nombre(){
        return $this->perro_nombre;
    }
    public function getPerro_peso(){
        return $this->perro_peso;
    }
    public function getPerro_tamano(){
        return $this->perro_tamano;
    }
    public function gerPerro_nacimiento(){
        return $this->perro_nacimiento;
    }
    public function getPerro_sexo(){
        return $this->perro_sexo;
    }
    public function getPerro_actividad(){
        return $this->perro_actividad;
    }
    public function getPerro_descripcion(){
        return $this->perro_descripcion;
    }





    public function setPerro_nombre($perro_nombre){
        return $this->perro_nombre=$perro_nombre;
    }
    public function setPerro_peso($perro_peso){
        return $this->perro_peso=$perro_peso;
    }
    public function setPerro_tamano($perro_tamano){
        return $this->perro_tamano=$perro_tamano;
    }
    public function setPerro_nacimiento($perro_nacimiento){
        return $this->perro_nacimiento=$perro_nacimiento;
    }
    public function setPerro_sexo($perro_sexo){
        return $this->perro_sexo=$perro_sexo;
    }
    public function setPerro_actividad($perro_actividad){
        return $this->perro_actividad=$perro_actividad;
    }
    public function setPerro_descripcion($perro_descripcion){
        return $this->perro_descripcion=$perro_descripcion;
    }

}
?>