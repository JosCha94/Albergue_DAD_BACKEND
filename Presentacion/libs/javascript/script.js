// AÑO-----------------------------------
var anio = (new Date).getFullYear();
$(document).ready(function () {
    $(".anio").text(anio);
});
// ----------AÑO-------------

// FILTRO PRODUCTOS
$('.categoria').click(function () {
    var catego = $(this).attr('category');

    $('.producto').css('transform', 'scale(0)');
    function ocultaProduct() {
        $('.producto').hide();
    } setTimeout(ocultaProduct, 400);

    function verProduct() {
        $('.producto[category="' + catego + '"]').show();
        $('.producto[category="' + catego + '"]').css('transform', 'scale(1)');
    } setTimeout(verProduct, 400);

    // --------------------------------------------------

    // --------------------------------------------------

    $('.categoria[category="All"]').click(function () {
        function showAll() {
            $('.producto').show();
            $('.producto').css('transform', 'scale(1)');
        } setTimeout(showAll, 400);
    });
});

// --------------------------------------------------

// --------------------------------------------------

$('.sizes').click(function () {
    var talla = $(this).attr('size');

    $('.producto').css('transform', 'scale(0)');
    function ocultaProduct() {
        $('.producto').hide();
    } setTimeout(ocultaProduct, 400);

    function verTalla() {
        $('.producto[dog_size="' + talla + '"]').show();
        $('.producto[dog_size="' + talla + '"]').css('transform', 'scale(1)');
    } setTimeout(verTalla, 400);
});
// ---------FILTRO PRODUCTOS-----------------------        

// SCROLL-----------------------------------
$(".scroll_up").click(function () {
    jQuery('html,body').animate({ scrollTop: 0 }, 2000);
})
// ------------------SCROLL-----------------

//FILTRO PARA PAG. ADOPCIONES----------------//

//filtro para tamaño
$('.filtroT').click(function () {
    var filter = $(this).attr('tamano');

    $('.perrito').css('transform', 'scale(0)');
    function ocultaPerrito() {
        $('.perrito').hide();
    } setTimeout(ocultaPerrito, 400);

    function verPerrito() {
        $('.perrito[tamano="' + filter + '"]').show();
        $('.perrito[tamano="' + filter + '"]').css('transform', 'scale(1)');
    } setTimeout(verPerrito, 400);

    $('.filtro[tamano="All"]').click(function () {
        function showAll() {
            $('.perrito').show();
            $('.perrito').css('transform', 'scale(1)');
        } setTimeout(showAll, 400);
    });
});
//filtro para sexo
$('.filtroS').click(function () {
    var sexo = $(this).attr('sexo');

    $('.perrito').css('transform', 'scale(0)');
    function ocultaSexo() {
        $('.perrito').hide();
    } setTimeout(ocultaSexo, 400);

    function verSexo() {
        $('.perrito[sexo="' + sexo + '"]').show();
        $('.perrito[sexo="' + sexo + '"]').css('transform', 'scale(1)');
    } setTimeout(verSexo, 400);
});


//filtro para actividad
$('.filtroA').click(function () {
    var acti = $(this).attr('actividad');

    $('.perrito').css('transform', 'scale(0)');
    function ocultaActividad() {
        $('.perrito').hide();
    } setTimeout(ocultaActividad, 400);

    function verActividad() {
        $('.perrito[actividad="' + acti + '"]').show();
        $('.perrito[actividad="' + acti + '"]').css('transform', 'scale(1)');
    } setTimeout(verActividad, 400);
});


//filtro para edad
$('.filtroE').click(function () {
    var age1 = $(this).attr('edad1');
    var age2 = $(this).attr('edad2');
    var age3 = $(this).attr('edad3');

    $('.perrito').css('transform', 'scale(0)');
    function ocultarEdad() {
        $('.perrito').hide();
    } setTimeout(ocultarEdad, 400);

    function verEdad1() {
        $('.perrito[edad1="' + age1 + '"]').show();
        $('.perrito[edad1="' + age1 + '"]').css('transform', 'scale(1)');
    } setTimeout(verEdad1, 400);

    function verEdad2() {
        $('.perrito[edad2="' + age2 + '"]').show();
        $('.perrito[edad2="' + age2 + '"]').css('transform', 'scale(1)');
    } setTimeout(verEdad2, 400);

    function verEdad3() {
        $('.perrito[edad3="' + age3 + '"]').show();
        $('.perrito[edad3="' + age3 + '"]').css('transform', 'scale(1)');
    } setTimeout(verEdad3, 400);


});
//--------------FILTRO PARA PAG. ADOPCIONES----------------//

//FORMULARIOS PERFIL USUARIO----------------//
//////// NOOO VANNNN
function formPass() {
  
    if ($('#btn-changepass').text() === "Cambiar contraseña") {
        $('#formPass').removeClass('d-none');
        $('#btn-changepass').text("Cerrar Formulario");
        $('#btn-changedata').attr('disabled', true);
    }else if ($('#btn-changepass').text() === "Cerrar Formulario"){
        $('#formPass').addClass('d-none');
        $('#btn-changepass').text("Cambiar contraseña");
        $('#btn-changedata').attr('disabled', false);
    }    
};

function formData() {
  
    if ($('#btn-changedata').text() === "Actualizar datos") {
        $('#formData').removeClass('d-none');
        $('#btn-changedata').text("Cerrar Formulario");
        $('#btn-changepass').attr('disabled', true);
    }else if ($('#btn-changedata').text() === "Cerrar Formulario"){
        $('#formData').addClass('d-none');
        $('#btn-changedata').text("Actualizar datos");
        $('#btn-changepass').attr('disabled', false);
    }
    
};
//--------------FORMULARIOS PERFIL USUARIO----------------//