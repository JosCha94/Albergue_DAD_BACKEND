<?php

class conexion
{
    static public function conectar()
    {
        $contrasena = "";
        $usuario = "root";
        $BaseDeDatos = "albergue_dogs_3";
        $servidor = "localhost";
        try {
            $conexion = new PDO("mysql:host=$servidor; dbname=$BaseDeDatos", $usuario, $contrasena, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // echo "Ocurrió un ERROR con la base de datos: " . $e->getMessage();
?>
            <div style="height: 100vh;  display: flex;
             justify-content: center;
             align-items: center;">
                <div style="margin:auto auto;">
                    <h1 style="text-align: center">
                        <strong style="color:red; font-size: 2.5em;">Error!</strong>
                    </h1>
                    <div style="padding: 15px;
                     color: #C70039;
                     font-size: 1.3em;
                     font-weight: 500;">
                        No se puede establecer una conexión ya que el equipo de destino denegó expresamente dicha conexión
                    </div>
                </div>
            </div>
<?php
            $conexion = 'fallo';
        }
        return $conexion;
    }
}
?>