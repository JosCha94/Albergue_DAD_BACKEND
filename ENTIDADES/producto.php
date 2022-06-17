<?php
    class Producto{
        private $cat_id;
        private $product_nombre;
        private $product_precio;
        private $product_igv;
        private $product_stock;
        private $product_descripcion;
        private $product_tipo_perro;
        private $product_estado;

        public function __construct($cat_id, $product_nombre, $product_precio, $product_igv, $product_stock, $product_descripcion, $product_tipo_perro, $product_estado){
            $this->cat_id = $cat_id;
            $this->product_nombre = $product_nombre;
            $this->product_precio = $product_precio;
            $this->product_igv = $product_igv;
            $this->product_stock = $product_stock;
            $this->product_descripcion = $product_descripcion;
            $this->product_tipo_perro = $product_tipo_perro;
            $this->product_estado = $product_estado;
        }

        public function getCat_id(){
            return $this->cat_id;
        }
        public function getProduct_nombre(){
            return $this->product_nombre;
        }
        public function getProduct_precio(){
            return $this->product_precio;
        }
        public function getProduct_igv(){
            return $this->product_igv;
        }
        public function getProduct_stock(){
            return $this->product_stock;
        }
        public function getProduct_descripcion(){
            return $this->product_descripcion;
        }
        public function getProduct_tipo_perro(){
            return $this->product_tipo_perro;
        }
        public function getProduct_estado(){
            return $this->product_estado;
        }


        public function setCat_id($cat_id){
            $this->cat_id = $cat_id;
        }
        public function setProduct_nombre($product_nombre){
            $this->product_nombre = $product_nombre;
        }
        public function setProduct_precio($product_precio){
            $this->product_precio = $product_precio;
        }
        public function setProduct_igv($product_igv){
            $this->product_igv = $product_igv;
        }
        public function setProduct_stock($product_stock){
            $this->product_stock = $product_stock;
        }
        public function setProduct_descripcion($product_descripcion){
            $this->product_descripcion = $product_descripcion;
        }
        public function setProduct_tipo_perro($product_tipo_perro){
            $this->product_tipo_perro = $product_tipo_perro;
        }
        public function setProduct_estado($product_estado){
            $this->product_estado = $product_estado;
        }


    }
?>