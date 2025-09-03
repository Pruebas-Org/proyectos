function agregar(){
    var selectedOption = $('#tipoSelectHorario option:selected');
    var id = selectedOption.val();
    var horario = selectedOption.text();
    var dias = [];
    if (document.getElementById('lun').checked) dias.push("Lun");
    if (document.getElementById('mar').checked) dias.push("Mar");
    if (document.getElementById('mie').checked) dias.push("Mié");
    if (document.getElementById('jue').checked) dias.push("Jue");
    if (document.getElementById('vie').checked) dias.push("Vie");
    if (document.getElementById('sab').checked) dias.push("Sáb");
    if (document.getElementById('dom').checked) dias.push("Dom");
//si algun dia esta vacio mostrar mensaje 
if(dias.length == 0){
    alert(
        "Debe seleccionar al menos un día"
    );
}else{
 //verificar si el id ya se encuentra en la tabla
 var existe = false;
 $('#dataTableBody').each(function() {
    if ($(this).find('td:eq(0)').text() == id) {
        existe = true;
        alert('El Horario ya se encuentra en la tabla, por favor seleccione otro');
        }else{
     var newRow = '<tr>' +
                     '<td>' + id + '</td>' +
                     '<td align="center">' + JSON.stringify(dias) + '</td>' +
                     '<td align="center">' + horario + '</td>' +
                     '<td align="center"><a  onclick="eliminarDetalle(this)"><i class="fas fa-trash"></i></a></td>' +
                 '</tr>';

     // Agregar la nueva fila al cuerpo de la tabla
     $('#dataTableBody').append(newRow);
        }
        });
    }
}

function eliminarDetalle(button) {
    var row = button.closest('tr');
    if (row) {
        var horario = parseFloat($(row).find('td:eq(0)').text());

        // Eliminar la fila de la tabla
        row.remove();
    } else {
        console.error("No se encontró la fila para eliminar.");
    }
}

function agregarUsuario(){
    var dias = [];
    var horarios = [];
    var datos=[];
    var nombre = $('#nombre').val();
    var apellidos = $('#apellidos').val();
    var selectedOption = $('#tipoSelectEquipo option:selected');
    var tipoEquipo = selectedOption.val();
    var selectedOptiontipo = $('#tipoSelectTipo option:selected');
    var tipo = selectedOptiontipo.val();
    var fechaNac = $('#fechNac').val();
    var fechaIng = $('#fechaIng').val();
    var correo = $('#email').val();
    var telefono = $('#movil').val();
    var foto = $('#foto')[0].files[0];
    var password = $('#password').val();
    var password2 = $('#password2').val();
    //agregar los datos a datos[]
    var formData = new FormData();
    formData.append('nombre', nombre);
    formData.append('apellidos', apellidos);
    formData.append('tipoEquipo', tipoEquipo);
    formData.append('tipo', tipo);
    formData.append('fechaNac', fechaNac);
    formData.append('fechaIng', fechaIng);
    formData.append('correo', correo);
    formData.append('telefono', telefono);
    formData.append('password', password);
    formData.append('password2', password2);
    formData.append('foto', foto);


    $('#dataTableBody tr').each(function() {
        var row = $(this);
        var id = row.find('td:eq(0)').text();
        var dias = row.find('td:eq(1)').text();
        var horario = row.find('td:eq(2)').text();
        horarios.push({
            id: id,
            dias: dias,
            horario: horario
        });
    });

    formData.append('horarios', JSON.stringify(horarios));

    if(verfPass() && camposVacios() && verfDias()){
        Swal.fire({
            title: '¿Estás seguro?',
            text: '¿Quieres agregar el nuevo usuario?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sí',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'POST',
                    url: finalizarCompraUrl,
                    data:formData,
                    processData: false, // Importante para enviar FormData
                    contentType: false,
                    complete: function(xhr, textStatus) {
                        if(xhr.status == 200){
                            Swal.fire({
                                title: '¡Éxito!',
                                text: 'El usuario se ha agregado correctamente',
                                icon: 'success'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    Swal.fire({
                                        title: "Redireccionando...",
                                        text: "Serás redireccionado para un nuevo usuario",
                                        icon: "info",
                                        timer: 2000,
                                        showConfirmButton: false,
                                    }).then((result) => {
                                        location.reload();
                                    });
                                }
                            });
                        }else{
                            Swal.fire({
                                title: 'Error',
                                text: 'No se ha podido agregar el usuario',
                                icon: 'error'
                            });
                        }
                        }
                })
            }
            });
    }else{
        Swal.fire({
            title: "Nuevo Usuario",
            text: "Por favor verifique la información",
            icon: "warning",
            confirmButtonText: "Aceptar"
        });
    }


    }
function verfDias(){
 //-------------
    //Dias semanas
    var lunes = document.getElementById('lun').checked;
    var martes = document.getElementById('mar').checked;
    var miercoles = document.getElementById('mie').checked;
    var jueves = document.getElementById('jue').checked;
    var viernes = document.getElementById('vie').checked;
    var sabado = document.getElementById('sab').checked;
    var domingo = document.getElementById('dom').checked;
    //----------------
    if(lunes  == false && martes  == false && miercoles  == false 
        && jueves  == false && viernes  == false && sabado  == false && domingo  == false){
            Swal.fire({
                title: "Nuevo Usuario",
                text: "Por favor seleccione al menos un dia",
                icon: "warning",
                confirmButtonText: "Aceptar"
            });
        return false;
    }else{
        return true;
    }
}

function verfPass(){
    //verificar q password y password2 sea iguales 
    var password = $('#password').val();
    var password2 = $('#password2').val();
    if(password != password2){
        $('#password').css('border-color', 'red');
        $('#password2').css('border-color', 'red');
        return false;
    }else{
        $('#password').css('border-color', 'green');
        $('#password2').css('border-color', 'green');
        return true;
    }
}

function camposVacios(){
    var nombre = $('#nombre').val();
    var apellidos = $('#apellidos').val();
    var selectedOption = $('#tipoSelectEquipo option:selected');
    var tipoEquipo = selectedOption.val();
    var selectedOptiontipo = $('#tipoSelectTipo option:selected');
    var tipo = selectedOptiontipo.val();
    var fechaNac = $('#fechNac').val();
    var fechaIng = $('#fechaIng').val();
    var correo = $('#email').val();
    var telefono = $('#movil').val();
    var password = $('#password').val();
    var password2 = $('#password2').val();

    var foto = $('#foto').value;
	
   
    
    var div = document.getElementById('fotodiv');

    // Verificar si la tabla está vacía
    var tableBody = $('#dataTableBody tr');
    var isTableEmpty = tableBody.length === 0;

    var table = document.getElementById('horarios');
    
    

    //verificar que no este vacio nada ni para ingresar la foto y lo q este vacio se ponga en rojo y cuando se complete se ponga en ver
    if(nombre == "" || apellidos == "" || fechaNac == ""|| fechaIng == ""|| correo == "" || telefono == "" || password == "" || password == ""|| isTableEmpty || foto == ""
    ){
        if(nombre == ""){
            $('#nombre').css('border-color', 'red');
        }else{
            $('#nombre').css('border-color', 'green');
        }
        if(apellidos == ""){
            $('#apellidos').css('border-color', 'red');
        }else{
            $('#apellidos').css('border-color', 'green');
        }
        if(fechaNac == ""){
            $('#fechNac').css('border-color', 'red');
        }else{
            $('#fechNac').css('border-color', 'green');
        }
        if(fechaIng == ""){
            $('#fechaIng').css('border-color', 'red');
        }else{
            $('#fechaIng').css('border-color', 'green');
        }
        if(correo == ""){
            $('#email').css('border-color', 'red');
        }else{
            $('#email').css('border-color', 'green');
        }
        if(telefono == ""){
            $('#movil').css('border-color', 'red');
        }else{
            $('#movil').css('border-color', 'green');
        }
        if(password == ""){
            $('#password').css('border-color', 'red');
        }else{
            $('#password').css('border-color', 'green');
        }
        if(password2 == ""){
            $('#password2').css('border-color', 'red');
        }else{
            $('#password2').css('border-color', 'green');
        }
        if(isTableEmpty){
            // Cambiar el color del borde de la tabla
            table.style.border = '1px solid red';
            
            // Cambiar el color del borde de los encabezados (th)
            var headers = table.getElementsByTagName('th');
            for (var i = 0; i < headers.length; i++) {
                headers[i].style.border = '1px solid red';
            }
            
            // Cambiar el color del borde de las celdas (td)
            var cells = table.getElementsByTagName('td');
            for (var i = 0; i < cells.length; i++) {
                cells[i].style.border = '1px solid red';
            }
        }else{
            table.style.border = '1px solid green';
            
            // Cambiar el color del borde de los encabezados (th)
            var headers = table.getElementsByTagName('th');
            for (var i = 0; i < headers.length; i++) {
                headers[i].style.border = '1px solid green';
            }
            
            // Cambiar el color del borde de las celdas (td)
            var cells = table.getElementsByTagName('td');
            for (var i = 0; i < cells.length; i++) {
                cells[i].style.border = '1px solid green';
        }
        }
        if(foto = ''){
            
            div.style.border = '1px solid red'; // Cambia 'red' por el color que desees

        }
            return false;
        }else{
            return true;
    }
}


