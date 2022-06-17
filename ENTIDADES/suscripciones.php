<?php

class suscripcion{
    private $usr_id;
    private $rol_id;
    private $tipo_id;
    private $suscrip_estado;
    private $suscrip_tiempo;
    private $suscrip_fecha_inicio;

    public function __construct($usr_id, $rol_id, $tipo_id, $suscrip_tiempo){
        $this->usr_id = $usr_id;
        $this->rol_id = $rol_id;
        $this->tipo_id = $tipo_id;
        $this->suscrip_tiempo = $suscrip_tiempo;
    }


    public function getUsr_id(){
        return $this->usr_id;
    }
    public function getRol_id(){
        return $this->rol_id;
    }
    public function getTipo_id(){
        return $this->tipo_id;
    }
    public function getSuscrip_tiempo(){
        return $this->suscrip_tiempo;
    }
    


    public function setUsr_id($usr_id){
        $this->usr_id = $usr_id;
    }
    public function setRol_id($rol_id){
        $this->rol_id = $rol_id;
    }
    public function setTipo_id($tipo_id){
        $this->tipo_id = $tipo_id;
    }
    public function setSuscrip_tiempo($suscrip_tiempo){
        $this->suscrip_tiempo = $suscrip_tiempo;
    }
    
    

}

?>