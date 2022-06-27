// AÑO-----------------------------------
var anio = (new Date).getFullYear();
$(document).ready(function () {
    $(".anio").text(anio);
});
// ----------AÑO-------------
$(document).ready(function() {
    $('#tablaPerritos').DataTable({
        "scrollX": true});
    $('#tablaVentas').DataTable({
        "scrollX": true});
    $('#tablaProductos').DataTable({
        "scrollX": true});
    $('#tablaClientes').DataTable({
        "scrollX": true});
});

$(document).ready(function() {
    $('#tablaDetalleVentas').DataTable({});
    $('#solicitudesAdop').DataTable({});
    $('#tipoSusci').DataTable({});
    $('#agendaAdop').DataTable({});
    $('#adopFinal').DataTable({});
    $('#suscip').DataTable({});
});


//funcion para confirmar delete
function checkDelete() {
let status  = confirm( "¿Estás seguro que deseas realizar este cambio?" );
return status;

}

