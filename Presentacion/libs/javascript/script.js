
// AÑO-----------------------------------
var anio = (new Date).getFullYear();
$(document).ready(function () {
    $(".anio").text(anio);
});
// ----------AÑO-------------

$(document).ready(function () {
    $.extend($.fn.dataTable.defaults, {
        language: { url: "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json" }
    });

    $('#tablaPerritos').DataTable({
        "scrollX": true
    });
    $('#tablaVentas').DataTable({
        "scrollX": true
    });
    $('#tablaProductos').DataTable({
        "scrollX": true
    });
    $('#tablaUsuarios').DataTable({
        "scrollX": true
    });
    $('#tablaRolesPermisos').DataTable({
        "scrollX": true
    });
    $('#tablaRoles').DataTable({
        // "scrollX": true
    });
    $('#tablaPermisos').DataTable({
        // "scrollX": true
    });
    $('#tablaDetalleVentas').DataTable({
        // "scrollX": true
    });

    $('#solicitudesAdop').DataTable({});
    $('#tipoSusci').DataTable({});
    $('#agendaAdop').DataTable({});
    $('#adopFinal').DataTable({});
    $('#suscip').DataTable({});
    $('#tablaDonaciones').DataTable({});
    $('#tablaBlog').DataTable({});
    $('#tablaUserRol').DataTable({});
    $('#tablaUserEsp').DataTable({});
    $('#tablaBtnRol').DataTable({});


});


//funcion para confirmar delete
function checkDelete() {
    let status = confirm("¿Estás seguro que deseas realizar este cambio?");
    return status;

}

