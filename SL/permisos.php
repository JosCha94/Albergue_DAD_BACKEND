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
            if (in_array($value['id'] , $id)) {
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
            if (in_array($value['id'] , $id)) {
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
            if (in_array($value['id'] , $id)) {
                $per = 'true';
            }
        endforeach;
        return $per;
    }
}
?>