<?php
    class Producto{

        private $product_categoria;
        private $product_nombre;
        private $product_precio;
        private $product_stock;
        private $product_descripcion;
        private $product_size_perro;
        private $product_estado;

        public function __construct( $product_categoria,$product_nombre, $product_precio, $product_stock, $product_descripcion, $product_size_perro,  $product_estado){
            $this->product_categoria = $product_categoria;
            $this->product_nombre = $product_nombre;
            $this->product_precio = $product_precio;      
            $this->product_stock = $product_stock;
            $this->product_descripcion = $product_descripcion;
            $this->product_size_perro = $product_size_perro;
            $this->product_estado = $product_estado;

        }

        public function getProduct_categoria(){
            return $this->product_categoria;
        }
        public function getProduct_nombre(){
            return $this->product_nombre;
        }
        public function getProduct_precio(){
            return $this->product_precio;
        }
        public function getProduct_stock(){
            return $this->product_stock;
        }
        public function getProduct_descripcion(){
            return $this->product_descripcion;
        }
        public function getProduct_size_perro(){
            return $this->product_size_perro;
        }
        public function getProduct_estado(){
            return $this->product_estado;
        }


        public function setProduct_categoria($product_categoria){
            $this->product_categoria = $product_categoria;
        }
        public function setProduct_nombre($product_nombre){
            $this->product_nombre = $product_nombre;
        }
        public function setProduct_precio($product_precio){
            $this->product_precio = $product_precio;
        }
        public function setProduct_stock($product_stock){
            $this->product_stock = $product_stock;
        }
        public function setProduct_descripcion($product_descripcion){
            $this->product_descripcion = $product_descripcion;
        }
        public function setProduct_size_perro($product_size_perro){
            $this->product_size_perro = $product_size_perro;
        }
        public function setProduct_estado($product_estado){
            $this->product_estado = $product_estado;
        }


    }
