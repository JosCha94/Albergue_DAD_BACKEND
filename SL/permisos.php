<?php
class autorizacion
{
    public function logueado($mysesion)
    {
        if ($mysesion == null || $mysesion == '') {
            $log = 'false';
        } else {
            $log = 'true';
        }
        return $log;
    }

    public function activeRol($estado, $id)
    {
        $Rol = $estado;
        $array = json_decode($Rol, true);
        foreach ($array as $key => $value) :
            if (in_array($value['id'], $id)) {
                $res = 'true';
            }
        endforeach;
        return $res;
    }

    public function activeRolPermi($permisos, $id)
    {
        $perRol = $permisos;
        $array = json_decode($perRol, true);
        foreach ($array as $key => $value) :
            if (in_array($value['id'], $id)) {
                $per = 'true';
            }
        endforeach;
        return $per;
    }

    public function permisosEspeciales($permisos, $id)
    {
        $perEsp = $permisos;
        $array = json_decode($perEsp, true);
        foreach ($array as $key => $value) :
            if (in_array($value['id'], $id)) {
                $per = 'true';
            }
        endforeach;
        return $per;
    }

    public function roles_permitidos_btn($conexion)
    {
        try {
            $sql = "CALL SP_select_permisos_area_admin()";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $PerRolBtn = $consulta->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            //  echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
            $PerRolBtn = 'fallo';
?>
            <div class="alert alert-danger alert-dismissible fade show " role="alert">
                <strong class="fs-3">Error!</strong><br> Debido a un problema no se pudo cargar los permisos

            </div>
<?php
        }
        return $PerRolBtn;
    }

    public function RolPermitido($permisos)
    {
        $array = json_decode($permisos, true);
        $perRol = array();
        foreach ($array as $key => $value) :
            array_push($perRol, $value['id']);

        endforeach;
        return $perRol;
    }

    public function RolActual($roles)
    {      
        $array = json_decode($roles, true);
        foreach ($array as $key => $value) :
            if ($value['id'] == 1) {
                $rolActual = $value['id'];
                break;
            } else {
                $rolActual = $value['id'];
            }
        endforeach;
        return $rolActual;
    }
}
?>