<?php

class adopcion{
    private $usr_id;
    private $rol_id;
    private $perro_id;
    private $adop_dueno;
    private $adop_razon;

    public function __construct($usr_id, $rol_id, $perro_id, $adop_dueno, $adop_razon){
        $this->usr_id = $usr_id;
        $this->rol_id = $rol_id;
        $this->perro_id = $perro_id;
        $this->adop_dueno = $adop_dueno;
        $this->adop_razon = $adop_razon;

    }

    public function getUsr_id(){
        return $this->usr_id;
    }
    public function getRol_id(){
        return $this->rol_id;
    }
    public function getPerro_id(){
        return $this->perro_id;
    }
    public function getAdop_dueno(){
        return $this->adop_dueno;
    }
    public function getAdop_razon(){
        return $this->adop_razon;
    }


    public function setUsr_id($usr_id){
        $this->usr_id = $usr_id;
    }
    public function setRol_id($rol_id){
        $this->rol_id = $rol_id;
    }
    public function setPerro_id($perro_id){
        $this->perro_id = $perro_id;
    }
    public function setAdop_dueno($adop_dueno){
        $this->adop_dueno = $adop_dueno;
    }
    public function setAdop_razon($adop_razon){
        $this->adop_razon = $adop_razon;
    }

  
}

class updt_estadoAdo{
    private $entrevista;

    public function __construct($entrevista){
        $this->entrevista = $entrevista;
    }

    public function getEntrevista(){
        return $this ->entrevista;
    }
    

    public function setEntrevista($entrevista){
        $this->entrevista = $entrevista;
    }



}


?>