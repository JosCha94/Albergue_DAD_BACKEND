<?php
session_start();
// error_reporting(0);
session_regenerate_id(true);
require_once 'SL/permisos.php';
require_once('DAL/conexion.php');
$conexion = conexion::conectar();
$log = new autorizacion();
$logueado = $log->logueado($_SESSION['usuario']);
$rolActi = $log->activeRol($_SESSION['usuario'][2], [1, 2]);

$modulo = $_GET['modulo'] ?? '';

$Rol = $_SESSION['usuario'][2];
$array = json_decode($Rol, true);
foreach ($array as $key => $value) :
    if ($value['id'] == 1) {
        $resRol = $value['id'];
    } elseif ($value['id'] == 2) {
        $resRol = $value['id'];
    }
endforeach;
$rolUs = $resRol;


switch ($error = 'SinError') {
    case ($conexion  == 'fallo'):
        $error = 'Error de conexión';
        break;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="adopcion, perritos, donaciones, albergues, suscripción">
    <meta name="description" content="Adopta un perrito en el albergue, dona para apoyar al albergue, suscribete a un plan para apadrinar, coprar productos para el perrito">
    <!-- LINKS HOJAS DE ESTILOS -->
    <link rel="stylesheet" href="Presentacion\libs\datatable\dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="Presentacion/libs/bootstrap/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="Presentacion\libs\datatable\bootstrap.min.css"> -->
    <link rel="stylesheet" href="Presentacion/libs/css/estilos.css">
    <link rel="stylesheet" href="Presentacion/libs/flaticon/flaticon.css">

    <!-- FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Thambi+2:wght@500&display=swap" rel="stylesheet">

    <title>Administracion de Albergue de perritos<?php
                                                    switch ($modulo) {
                                                        case ("clientes"):
                                                            echo " - Clientes ";
                                                            break;
                                                        case ("adoptar"):
                                                            echo " - Adopciones ";
                                                            break;
                                                        case ("apadrinar"):
                                                            echo " - Apadrinar ";
                                                            break;
                                                        case ("productos" || "agrega-producto"):
                                                            echo " - Productos ";
                                                            break;
                                                        case ("ventas"):
                                                            echo " - Ventas ";
                                                            break;
                                                        case ("donar"):
                                                            echo " - Donación ";
                                                            break;
                                                        case ("blog"):
                                                            echo " - Blog ";
                                                            break;
                                                        case ("perfil-usuario"):
                                                            echo " - Perfil de Administrador ";
                                                            break;
                                                    }
                                                    ?>

    </title>
</head>
<?php if ($error == 'SinError') : ?>

    <body>
        <!-- HEADER -->
        <div class="container-fluid" id="nav_principal">
            <nav class="navbar navbar-expand-lg navbar-dark bg-transparent container-fluid">

                <a class="navbar-brand" href="index.php?modulo=inicio">
                    <a href="index.php?modulo= "><img src="Presentacion/libs/images/doglogo.png" alt="logo" width="80em"></a>

                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <?php if ($logueado == null || $logueado == 'false') : ?>
                    <marquee behavior="alternate">
                        <h2 style="color:#E8630a">Area administrativa del Albergue</h2>
                    </marquee>

                <?php else : ?>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item ">
                                <a class="nav-link <?php echo ($modulo == "clientes") ? " active " : " " ?> mx-2" href="index.php?modulo=clientes">Clientes</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link <?php echo ($modulo == "perritos") ? " active " : " " ?> mx-2" href="index.php?modulo=perritos">Perritos</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link <?php echo ($modulo == "adoptar" || $modulo == "adoptar-single") ? " active " : " " ?> mx-2" href="index.php?modulo=adoptar">Adoptar</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link <?php echo ($modulo == "apadrinar") ? " active " : " " ?> mx-2" href="index.php?modulo=apadrinar">Apadrinar</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php echo ($modulo == "productos" || $modulo == "agrega-producto") ? " active " : " " ?> mx-2" href="index.php?modulo=productos">Productos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php echo ($modulo == "ventas") ? " active " : " " ?> mx-2" href="index.php?modulo=ventas">Ventas</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php echo ($modulo == "donar") ? " active " : " " ?> mx-2" href="index.php?modulo=donar">Donaciones</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php echo ($modulo == "blog") ? " active " : " " ?> mx-2" href="index.php?modulo=blog">Blog</a>
                            </li>
                        </ul>
                        <?php if ($logueado == null || $logueado == 'false') {
                        ?>
                            <!-- <button type="button" class="btn btn-login m-3" data-bs-toggle="modal" data-bs-target="#ModalLogin">Iniciar Sesion</button> -->
                        <?php
                        } else {
                        ?>
                            <div class="dropdown mx-4">
                                <a class="dropdown-toggle text-uppercase" type="button" id="dropdownMenuUser" data-bs-toggle="dropdown" aria-expanded="false">
                                    <?php echo $_SESSION['usuario'][1] ?>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuUser">
                                    <li>
                                        <a href="index.php?modulo=perfil-usuario">Mi perfil</a>
                                    </li>
                                    <li>
                                        <a href="BL/cerrar_sesion.php?modulo=&sesion=cerrar">Cerrar Sesión</a>
                                    </li>
                                </ul>
                            </div>
                        <?php
                        }
                        ?>

                    </div>
                <?php endif; ?>

            </nav>
        </div>
        <!-- <h1>HI</h1>
    <?php
    echo $rolUs;

    ?> -->


<!-- <?php echo $idEditProducto ?> -->

        <!-- BODY -->
        <div class="container mb-5">
            <?php
            if (isset($_GET['mensaje'])) {
            ?>
                <div class="alert alert-success alert-dismissible fade show float-right" role="alert">
                    <strong>Exito!</strong> <?php echo $_GET['mensaje']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php
            } else if (isset($_GET['error'])) {
            ?>
                <div class="alert alert-danger alert-dismissible fade show " role="alert">
                    <strong>Error!</strong> <?php echo $_GET['error']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php
            }
            if ($modulo == "" || $modulo == "inicio") {
                include_once "Presentacion/vistas/inicio.php";
            }
            if ($modulo == "adoptar") {
                include_once "Presentacion/vistas/adoptar.php";
            }
            if ($modulo == "apadrinar") {
                include_once "Presentacion/vistas/apadrinar.php";
            }
            if ($modulo == "productos") {
                include_once "Presentacion/vistas/productos.php";
            }
            if ($modulo == "donar") {
                include_once "Presentacion/vistas/donar.php";
            }
            if ($modulo == "blog") {
                include_once "Presentacion/vistas/blog.php";
            }
            if ($modulo == "ventas") {
                include_once "Presentacion/vistas/ventas.php";
            }
            if ($modulo == "clientes") {
                include_once "Presentacion/vistas/clientes.php";
            }
            if ($modulo == "perfil-usuario") {
                include_once "Presentacion/vistas/perfil-usuario.php";
            }
            if ($modulo == "admin_adoptar") {
                include_once "Presentacion/vistas/admin_adoptar.php";
            }
            if ($modulo == "agrega-producto") {
                include_once "Presentacion/vistas/admin_producto.php";
            }
            if ($modulo == "perritos") {
                include_once "Presentacion/vistas/perritos.php";
            }
            if ($modulo == "admin_perritos") {
                include_once "Presentacion/vistas/admin_perritos.php";
            }

            ?>
        </div>

        <!-- FOOTER -->
        <footer class="footer-area">
            <!--== Start Footer Main ==-->
            <div class="footer-main mt-5">
                <div class="container pt--0 pb--0">
                    <div class="row">
                        <div class="col-md-6 col-lg-3">
                            <div class="widget-item widget-about">
                                <h4 class="widget-title">About Us</h4>
                                <p class="desc">Lorem ipsum dolor sit amet, consectel adipisicing elit, sed do eiusmod temp incidid ut labore et dolo</p>
                                <div class="social-icons">
                                    <a href="" target="_blank" rel="noopener"><i class="fab fa-facebook"></i></a>
                                    <a href="" target="_blank" rel="noopener"><i class="fab fa-instagram"></i></a>
                                    <a href="" target="_blank" rel="noopener"><i class="fab fa-twitter"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="widget-item nav-menu-item1">
                                <h4 class="widget-title">Information</h4>
                                <div class="widget-menu-wrap">
                                    <ul class="nav-menu">
                                        <li><a href="about-us.html">Acerca de nosotros</a></li>
                                        <li><a href="account-login.html">Politicas de privacidad</a></li>
                                        <li><a href="account-login.html">Terminos y condiciones</a></li>
                                        <li><a href="contact.html">Contactanos</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="widget-item nav-menu-item2">
                                <h4 class="widget-title">Mapa del sitio</h4>
                                <div class="widget-menu-wrap">
                                    <ul class="nav-menu">
                                        <li><a href="index.php?modulo=adoptar">Adoptar</a></li>
                                        <li><a href="index.php?modulo=apadrinar">Apadrinar</a></li>
                                        <li><a href="index.php?modulo=tienda">Tienda virtual</a></li>
                                        <li><a href="index.php?modulo=donar">Donaciones</a></li>
                                        <li><a href="index.php?modulo=blog">Blog</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="widget-item">
                                <h4 class="widget-title">Informacion de contacto</h4>
                                <div class="widget-contact-info">
                                    <p class="contact-info-desc">Si tienes alguna duda o pregunta, por favor escribenos a: <a href="mailto://demo@example.com">demo@example.com</a></p>
                                    <div class="contact-item">
                                        <div class="icon">
                                            <i class="pe-7s-map-marker"></i>
                                        </div>
                                        <div class="info">
                                            <p>direccion calle <br>200, distrito.</p>
                                        </div>
                                    </div>
                                    <div class="contact-item phone-info">
                                        <div class="icon">
                                            <i class="pe-7s-phone"></i>
                                        </div>
                                        <div class="info">
                                            <p><i class="fa-brands fa-whatsapp"></i> <span>Escribenos al WhatsApp</span> <br><a href="">+51 999 888 333</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--== End Footer Main ==-->

            <!--== Start Footer Bottom ==-->
            <div class="footer-bottom">
                <div class="container pt--0 pb--0">
                    <div class="row">
                        <div class="col-12">
                            <div class="footer-bottom-content">
                                <div class="payment">
                                    <a href="account.html"><img src="Presentacion/libs/images/payment.webp" width="192" height="21" alt="Payment Logo"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid">
                        <div class="row">
                            <p class="text-center mt-3">© <span class="anio"></span> PlanetDog.com by FJF WEB SAC</p>
                        </div>
                    </div>
                </div>

            </div>

            <!--== End Footer Bottom ==-->
        </footer>
    

    </body>
<?php endif; ?>
<!-- LINKS SCRIPT -->

<script src="Presentacion/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="Presentacion\libs\fontawesome\js\all.min.js"></script>
<script src="Presentacion/libs/javascript/jquery-3.6.0.min.js"></script>
<script src="Presentacion/libs/javascript/script.js"></script>
<script src="Presentacion\libs\datatable\jquery.dataTables.min.js"></script>
<script src="Presentacion\libs\datatable\dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#tablaClientes').DataTable({
            "scrollX": true
        });
    });

    $(document).ready(function() {
        $('#tablaProductos').DataTable({
            "scrollX": true
        });
    });
   
    $(document).ready(function() {
        $('#tablaPerritos').DataTable({
            "scrollX": true
        });
    });
    
    

</script>





</html>