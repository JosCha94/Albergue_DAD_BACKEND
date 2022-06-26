// AÑO-----------------------------------
var anio = (new Date).getFullYear();
$(document).ready(function () {
    $(".anio").text(anio);
});
// ----------AÑO-------------


// PERMITE SOLO 3 FOTOS A FORMULARIO AGREGAR PERRITOS
// const input = document.querySelector('#add_img');

// // Listen for files selection
// input.addEventListener('change', (e) => {
//     // Retrieve all files
//     const files = input.files;

//     // Check files count
//     if (files.length > 3) {
//         alert(`Only 2 files are allowed to upload.`);
//         return;
//     }
// });

// //TOGGLE BUTTON ON CLICK
// function clickMe() {
//     var text = document.getElementById("popup");
//     text.classList.toggle("hide");
//     text.classList.toggle("show");
//   }

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

$(document).ready(function() {
    $('#tablaVentas').DataTable({
        "scrollX": true
    });
});

$(document).ready(function() {
    $('#tablaDetalleVentas').DataTable({
        // "scrollX": true
    });
});

$(document).ready(function() {
    $('#solicitudesAdop').DataTable({
        // "scrollX": true
    });
});

$(document).ready(function() {
    $('#agendaAdop').DataTable({
        // "scrollX": true
    });
});

$(document).ready(function() {
    $('#adopFinal').DataTable({
        // "scrollX": true
    });
});

$(document).ready(function() {
    $('#suscip').DataTable({
        // "scrollX": true
    });
});

$(document).ready(function() {
    $('#tipoSusci').DataTable({
        // "scrollX": true
    });
});


//funcion para confirmar delete
function checkDelete() {
let status  = confirm( "¿Estás seguro que deseas eliminar esta foto?" );
return status;

}

