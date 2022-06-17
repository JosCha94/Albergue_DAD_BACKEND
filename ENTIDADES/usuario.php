<?php
class Usuario{
    private $usuario;
    private $usr_clave;
    private $usr_nombre;
    private $usr_apellido_paterno;
    private $usr_apellido_materno;
    private $usr_email;
    private $usr_celular;

    public function __construct($usuario, $usr_clave, $usr_nombre, $usr_apellido_paterno, $usr_apellido_materno, $usr_email, $usr_celular){
        $this->usuario = $usuario;
        $this->usr_clave = $usr_clave;
        $this->usr_nombre = $usr_nombre;
        $this->usr_apellido_paterno = $usr_apellido_paterno;
        $this->usr_apellido_materno = $usr_apellido_materno;
        $this->usr_email = $usr_email;
        $this->usr_celular = $usr_celular;
    }

    public function getUsuario(){
        return $this->usuario;
    }
    public function getUsr_clave(){
        return $this->usr_clave;
    }
    public function getUsr_nombre(){
        return $this->usr_nombre;
    }
    public function getUsr_apellido_paterno(){
        return $this->usr_apellido_paterno;
    }
    public function getUsr_apellido_materno(){
        return $this->usr_apellido_materno;
    }
    public function getUsr_email(){
        return $this->usr_email;
    }
    public function getUsr_celular(){
        return $this->usr_celular;
    }
    

    public function setUsuario($usuario){
        $this->usuario = $usuario;
    }
    public function setUsr_clave($usr_clave){
        $this->usr_clave = $usr_clave;
    }
    public function setUsr_nombre($usr_nombre){
        $this->usr_nombre = $usr_nombre;
    }
    public function setUsr_apellido_paterno($usr_apellido_paterno){
        $this->usr_apellido_paterno = $usr_apellido_paterno;
    }
    public function setUsr_apellido_materno($usr_apellido_materno){
        $this->usr_apellido_materno = $usr_apellido_materno;
    }
    public function setUsr_email($usr_email){
        $this->usr_email = $usr_email;
    }
    public function setUsr_celular($usr_celular){
        $this->usr_celular = $usr_celular;
    }
}
?>