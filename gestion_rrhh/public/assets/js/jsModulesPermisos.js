function agregarDetalle() {
    var moduloSelect = $('#modulosSelect option:selected');
    var moduloId = moduloSelect.val();
    var moduloNombre = moduloSelect.text();
    var exists = false;

    $('#tipoSelect').prop('disabled', true);
    // Verificar si el texto del módulo ya existe en la tabla
    $('#dataTableBody tr').each(function() {
        if ($(this).find('td:eq(1)').text() === moduloNombre) {
            exists = true;
            return false; // salir del bucle each
        }
    });

    if (!exists) {
        var newRow = `
            <tr data-modulo-id="${moduloId}">
                <td>${moduloId}</td>
                <td>${moduloNombre}</td>
                <td align="center"><a  onclick="eliminarModulo(this)"><i class="fas fa-trash"></i></a></td>
            </tr>
        `;
        $('#dataTableBody').append(newRow);
    } else {
        alert('El módulo ya está agregado.');
    }
}


function eliminarModulo(moduloId) {
        var row = moduloId.closest('tr');
            if (row) {
                // Eliminar la fila de la tabla
                row.remove();
            } else {
                console.error("No se encontró la fila para eliminar.");
            }
}

function finalizarPermisos() {
    var tipoSelect = $('#tipoSelect option:selected');
    var tipoId = tipoSelect.val();
    var moduloIds = [];

    $('#dataTableBody tr').each(function() {
        var id = $(this).find('td:eq(0)').text();
        moduloIds.push(id);
    });

    $.ajax({
        url: updatePermisos, // Reemplaza esto con la URL de tu controlador
        type: 'POST',
        data: {
            moduloIds: moduloIds,
            tipoId :tipoId
        },
        success: function(response) {
            alert('Permisos guardados exitosamente.');
        },
        error: function() {
            alert('Error al guardar permisos.');
        }
    });
}





function getPermisos(){
    var tipo = $('#tipoSelect option:selected').val();
  
    //llamado ajax 
    $.ajax({
        url: permisos,
        type: "POST",
        datatype: "JSON",
        data: {tipo: tipo},
        success: function (respuesta) {
            actualizarTabla(respuesta);
            }
            });
}

function actualizarTabla(data) {
    var dataTableBody = $('#dataTableBody');
    dataTableBody.empty(); // Limpiar tabla

    // Crear filas con los datos de los módulos
    data.forEach(function(modulo) {
        var newRow = `
            <tr>
                <td>${modulo.Id}</td>
                <td>${modulo.NombreItem}</td>
                <td align="center"><a  onclick="eliminarModulo(this)"><i class="fas fa-trash"></i></a></td>
            </tr>
        `;
        dataTableBody.append(newRow);
    });
}
//llamar a la funcion getPermisos cada vez q se actualiza la pagina 
$(document).ready(function(){
    getPermisos();
    });