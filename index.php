<?php
session_start();
error_reporting(0);
session_regenerate_id(true);
require_once 'SL/permisos.php';
require_once('DAL/conexion.php');
$conexion = conexion::conectar();
$log = new autorizacion();
$logueado = $log->logueado($_SESSION['usuario']);
$rolActual = $log->RolActual($_SESSION['usuario'][2]);

$info = json_decode($_SESSION['usuario'][1]);

if($_SESSION['usuario'] == null || $_SESSION['usuario'] == ''):

        $_SESSION['permisos'] = $log->roles_permitidos_btn($conexion);

endif;
$_SESSION['permisos'] = $log->roles_permitidos_btn($conexion);
$PermisosRolBtn = $_SESSION['permisos'];


$usuarios = $log->RolPermitido($PermisosRolBtn['area_usuarios_admin']);
$RolPermisos = $log->RolPermitido($PermisosRolBtn['area_RolPermisos_admin']);
$perritos = $log->RolPermitido($PermisosRolBtn['area_perritos_admin']);
$adopciones = $log->RolPermitido($PermisosRolBtn['area_adopciones_admin']);
$suscripciones = $log->RolPermitido($PermisosRolBtn['area_suscripciones_admin']);
$productos = $log->RolPermitido($PermisosRolBtn['area_productos_admin']);
$ventas = $log->RolPermitido($PermisosRolBtn['area_ventas_admin']);
$donaciones = $log->RolPermitido($PermisosRolBtn['area_donaciones_admin']);
$blog = $log->RolPermitido($PermisosRolBtn['area_blog_admin']);

$modulo = $_GET['modulo'] ?? '';

$Rol = $_SESSION['usuario'][2];
$array = json_decode($Rol, true);
foreach ($array as $key => $value) :
    $resRol = $value['id'];
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
                                                        case ("usuarios"): echo " - Usuarios "; break;
                                                        case ("rolesPermisos"): echo " - Roles y permisos "; break;
                                                        case ("adoptar"): echo " - Adopciones "; break;
                                                        case ("perritos"): echo " - Perritos "; break;
                                                        case ("apadrinar"): echo " - Apadrinar ";break;
                                                        case ("admin_apadrinar"): echo " - Apadrinar ";  break;
                                                        case ("productos"): echo " - Productos "; break;
                                                        case ("ventas"): echo " - Ventas "; break;
                                                        case ("donar"): echo " - Donación "; break;
                                                        case ("blog"): echo " - Blog "; break;
                                                        case ("admin_post"): echo " - Blog "; break;
                                                        case ("perfil-usuario"): echo " - Perfil de Administrador "; break;
                                                        case ("admin_adoptar"): echo " - Admin Adopciones "; break;
                                                        case ("agrega-categoria"): echo " - Categorias"; break;
                                                        case ("admin_perritos"): echo " - Perritos Admin"; break;
                                                        case ("admin_roles_permisos"): echo " - Roles y Permisos Admin";  break;
                                                        case ("update-user"):  echo " - Perfil usuario"; break;
                                                        case ("admin_post"): echo " - admin Post"; break;
                                                        case ("admin_apadrinar"): echo " - admin Suscripciones"; break;
                     
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
                        <h2 style="color:#E8630a">Área Administrativa del Albergue</h2>
                    </marquee>
                <?php else : ?>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <?php $rolPermitUsu = $log->activeRol($_SESSION['usuario'][2], $usuarios);
                            if ($rolPermitUsu == 'true') : ?>
                                <li class="nav-item ">
                                    <a class="nav-link <?php echo ($modulo == "usuarios") ? " active " : " " ?> mx-2" href="index.php?modulo=usuarios">Usuarios</a>
                                </li>
                            <?php endif; ?>
                            <?php $rolPermitRP = $log->activeRol($_SESSION['usuario'][2], $RolPermisos);
                            if ($rolPermitRP == 'true') : ?>
                                <li class="nav-item ">
                                    <a class="nav-link <?php echo ($modulo == "rolesPermisos" || $modulo == "admin_roles_permisos") ? " active " : " " ?> mx-2" href="index.php?modulo=rolesPermisos">Roles y Permisos</a>
                                </li>
                            <?php endif; ?>
                            <?php $rolPermitDogs = $log->activeRol($_SESSION['usuario'][2], $perritos);
                            if ($rolPermitDogs == 'true') : ?>
                                <li class="nav-item ">
                                    <a class="nav-link <?php echo ($modulo == "perritos" || $modulo == "admin_perritos") ? " active " : " " ?> mx-2" href="index.php?modulo=perritos">Perritos</a>
                                </li>
                            <?php endif; ?>
                            <?php $rolPermitAdop = $log->activeRol($_SESSION['usuario'][2], $adopciones);
                            if ($rolPermitAdop == 'true') : ?>
                                <li class="nav-item ">
                                    <a class="nav-link <?php echo ($modulo == "adoptar" || $modulo == "adoptar-single" || $modulo == "admin_adoptar") ? " active " : " " ?> mx-2" href="index.php?modulo=adoptar">Adopciones</a>
                                </li>
                            <?php endif; ?>
                            <?php $rolPermitSuscrip = $log->activeRol($_SESSION['usuario'][2], $suscripciones);
                            if ($rolPermitSuscrip == 'true') : ?>
                                <li class="nav-item ">
                                    <a class="nav-link <?php echo ($modulo == "apadrinar" || $modulo == "admin_apadrinar") ? " active " : " " ?> mx-2" href="index.php?modulo=apadrinar">Suscripciones</a>
                                </li>
                            <?php endif; ?>
                            <?php $rolPermitPdt = $log->activeRol($_SESSION['usuario'][2], $productos);
                            if ($rolPermitPdt == 'true') : ?>
                                <li class="nav-item">
                                    <a class="nav-link <?php echo ($modulo == "productos" || $modulo == "agrega-producto" || $modulo == "agrega-categoria") ? " active " : " " ?> mx-2" href="index.php?modulo=productos">Productos</a>
                                </li>
                            <?php endif; ?>
                            <?php $rolPermitSales = $log->activeRol($_SESSION['usuario'][2], $ventas);
                            if ($rolPermitSales == 'true') : ?>
                                <li class="nav-item">
                                    <a class="nav-link <?php echo ($modulo == "ventas") ? " active " : " " ?> mx-2" href="index.php?modulo=ventas">Ventas</a>
                                </li>
                            <?php endif; ?>
                            <?php $rolPermitDona = $log->activeRol($_SESSION['usuario'][2], $donaciones);
                            if ($rolPermitDona == 'true') : ?>
                                <li class="nav-item">
                                    <a class="nav-link <?php echo ($modulo == "donar") ? " active " : " " ?> mx-2" href="index.php?modulo=donar">Donaciones</a>
                                </li>
                            <?php endif; ?>
                            <?php $rolPermitBlog = $log->activeRol($_SESSION['usuario'][2], $blog);
                            if ($rolPermitBlog == 'true') : ?>
                                <li class="nav-item">
                                    <a class="nav-link <?php echo ($modulo == "blog" || $modulo == "admin_post") ? " active " : " " ?> mx-2" href="index.php?modulo=blog">Blog</a>
                                </li>
                            <?php endif; ?>
                        </ul>
                        <?php if ($logueado == null || $logueado == 'false') {
                        ?>
                            <!-- <button type="button" class="btn btn-login m-3" data-bs-toggle="modal" data-bs-target="#ModalLogin">Iniciar Sesion</button> -->
                        <?php
                        } else {
                        ?>
                            <div class="dropdown mx-4">
                                <a class="dropdown-toggle text-uppercase text-white" type="button" id="dropdownMenuUser" data-bs-toggle="dropdown" aria-expanded="false">
                                    <?php echo $info->nick; ?>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end p-3" aria-labelledby="dropdownMenuUser">
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
            if ($modulo == "usuarios") {
                include_once "Presentacion/vistas/usuarios.php";
            }
            if ($modulo == "rolesPermisos") {
                include_once "Presentacion/vistas/roles_permisos.php";
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
            if ($modulo == "agrega-categoria") {
                include_once "Presentacion/vistas/admin_categoria.php";
            }
            if ($modulo == "perritos") {
                include_once "Presentacion/vistas/perritos.php";
            }
            if ($modulo == "admin_perritos") {
                include_once "Presentacion/vistas/admin_perritos.php";
            }
            if ($modulo == "admin_roles_permisos") {
                include_once "Presentacion/vistas/admin_RolesPermisos.php";
            }
            if ($modulo == "update-user") {
                include_once "Presentacion/vistas/update-usuario.php";
            }
            if ($modulo == "admin_post") {
                include_once "Presentacion/vistas/admin_post.php";
            }
            if ($modulo == "admin_apadrinar") {
                include_once "Presentacion/vistas/admin_apadrinar.php";
            }            

            ?>
        </div>

        <!-- FOOTER -->
        <?php if ($logueado == null || $logueado == 'false') : ?>

        <?php else : ?>
            <footer class="footer-area">
                <!--== Start Footer Main ==-->
                <div class="footer-main mt-5">
                    <div class="container pt--0 pb--0">
                        <div class="row">
                            <div class="col-md-6 col-lg-3">
                                <div class="widget-item widget-about">
                                    <h4 class="widget-title">Planet Dog</h4>
                                    <p class="desc">Albergue</p>
                                    <div class="social-icons">
                                        <a href=""></i></a>
                                        <a href=""></i></a>
                                        <a href=""></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="widget-item nav-menu-item1">
                                    <h4 class="widget-title">Información</h4>
                                    <div class="widget-menu-wrap">
                                        <ul class="nav-menu">
                                            <li><a href="#">Acerca de nosotros</a></li>
                                            <li><a href="">Políticas de privacidad</a></li>
                                            <li><a href="">Términos y condiciones</a></li>
                                            <li><a href="">Contáctanos</a></li>
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
                                    <h4 class="widget-title">Información de contacto</h4>
                                    <div class="widget-contact-info">
                                        <p class="contact-info-desc">Si tienes alguna duda o pregunta, por favor escribenos a: <a href="mailto://demo@example.com">demo@example.com</a></p>
                                        <div class="contact-item">
                                            <div class="icon">
                                                <i class="pe-7s-map-marker"></i>
                                            </div>
                                            <div class="info">
                                                <p>Direccion:<br>Calle 200</p>
                                            </div>
                                        </div>
                                        <div class="contact-item phone-info">
                                            <div class="icon">
                                                <i class="pe-7s-phone"></i>
                                            </div>
                                            <div class="info">
                                                <p><i class="fa-brands fa-whatsapp"></i> <span>Escríbenos al WhatsApp</span> <br><a href="">+51 999 888 333</a></p>
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
        <?php endif; ?>


    </body>
<?php endif; ?>
<!-- LINKS SCRIPT -->

<script src="Presentacion/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="Presentacion\libs\fontawesome\js\all.min.js"></script>
<script src="Presentacion/libs/javascript/jquery-3.6.0.min.js"></script>
<script src="Presentacion/libs/javascript/script.js"></script>
<script src="Presentacion\libs\datatable\jquery.dataTables.min.js"></script>
<script src="Presentacion\libs\datatable\dataTables.bootstrap5.min.js"></script>

</html>