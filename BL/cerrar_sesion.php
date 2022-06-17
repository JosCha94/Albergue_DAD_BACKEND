<?php
    session_start();
    if (isset($_REQUEST['sesion']) && $_REQUEST['sesion'] == 'cerrar') {
        session_destroy();
        header("Location: ../index.php");
      };
?>