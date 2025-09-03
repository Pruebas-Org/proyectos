// Función para obtener el valor del localStorage, o establecer uno por defecto si no existe
function getLocalStorageValue(key, defaultValue) {
    let value = localStorage.getItem(key);
    return value !== null ? JSON.parse(value) : defaultValue;
}

// Función para establecer el valor en localStorage
function setLocalStorageValue(key, value) {
    localStorage.setItem(key, JSON.stringify(value));
}

// Inicializa los arrays desde localStorage
let currentUser = getLocalStorageValue('current_user', null);
let notificationIds = getLocalStorageValue('notification_ids_' + currentUser, []);
let messageIds = getLocalStorageValue('message_ids_' + currentUser, []);

function allUsr() {
    $.ajax({
        url: allUsrDate,
        type: 'POST',
        success: function(response) {
            $('#usuarios').html(response);
        }
    });
}

function getNot() {
    $.ajax({
        url: getNoti,
        type: 'POST',
        success: function(response) {
            $('#notificaciones').html(response);
        }
    });
}

function getMess() {
    $.ajax({
        url: getAllMessage,
        type: 'POST',
        success: function(response) {
            $('#mensajes').html(response);
        }
    });
}

function sendMessage(){
   
    var mensaje = $('#mensaje').val();
    var tiponoti = $('#tipoSelectnoti').val();
    var usr = $('#usuarios').val();

    console.log('mensaje:', mensaje);
    console.log('tipo:', tiponoti);
    console.log('usuario:', usr);

    if(verifVacio()){
        $.ajax({
            url: sendNoti,
            type: 'POST',
            data: {
                mensaje: mensaje,
                tiponoti: tiponoti,
                usr: usr
                },
            success: function(response) {
                console.log(response);

                }
                    });
    }else{
        alert('No se puede enviar un mensaje vacio');
    }
}

function verifVacio(){
    var usr = $('#usuarios').val();
    var mensaje = $('#mensaje').val();

    if(usr == '' || mensaje == ''){
        return false;
    }else{
        return true;

    }
}



function loadDetails(tipo,id) {
    switch(tipo) {
        case 1:
        var messageContent = $('#contenidoNot-' + id).text();
        var fecha = $('#diaHoraNot-' + id).text();
        var titulo = 'Notificación';
        break;
        case 2:
        var messageContent = $('#contenidoMes-' + id).text();
        var fecha = $('#diaHoraMes-' + id).text();
        var titulo = 'Mensaje';
        break;
    }
      $('#messageContent').text(messageContent);
      $('#time').text(fecha);
      $('#messageModalLabel').text(titulo);
      $('#messageModal').modal('show');

      $.ajax({
        url: leida + '/' + id,
        type: 'POST',
        success: function(response) {
            updateMessageCount();
            updateNotCount();
            getNot();
            getMess();
        },
        error: function(error) {
            console.log('Error al marcar la notificación como leída');
        }
    });
}

function updateMessageCount() {
    $.ajax({
        url: getMessageCount, 
        type: 'GET',
        success: function(response) {
            $('#messagesDropdown .badge-counter').text(response);
        },
        error: function(xhr, status, error) {
            console.error('Error al actualizar el contador de mensajes:', error);
        }
    });
}

function updateNotCount() {
    $.ajax({
        url: getNotCount, 
        type: 'GET',
        success: function(response) {
            $('#alertsDropdown .badge-counter').text(response);
        },
        error: function(xhr, status, error) {
            console.error('Error al actualizar el contador de mensajes:', error);
        }
    });
}

function checkNewNotifications() {
    $.ajax({
        url: newNoti, // Cambia a la URL correcta
        type: 'GET',
        success: function(response) {
            try {
                // Si la respuesta es una cadena, conviértela a objeto
                if (typeof response === 'string') {
                    response = JSON.parse(response);
                }

                console.log(response); // Verifica la estructura del objeto response

                let newNotificationCount = response.notification_count;
                let newMessageCount = response.message_count;
                let userId = response.id_user;
                let newNotificationIds = response.new_notifications_ids;
                let newMessageIds = response.new_messages_ids;

                // Verificar si el usuario ha cambiado
                if (userId !== currentUser) {
                    currentUser = userId;
                    setLocalStorageValue('current_user', currentUser);
                    notificationIds = [];
                    messageIds = [];
                }

                // Verificar y mostrar las notificaciones nuevas
                let newNotifications = newNotificationIds.filter(id => !notificationIds.includes(id));
                let newMessages = newMessageIds.filter(id => !messageIds.includes(id));


                if (newNotifications.length > 0 || newMessages.length > 0) {
                    let message = '';

                    if (newNotifications.length > 0) {
                        message += 'Tienes ' + newNotifications.length + ' nuevas notificaciones. ';
                    }

                    if (newMessages.length > 0) {
                        message += 'Tienes ' + newMessages.length + ' nuevos mensajes.';
                    }

                    showNotificationToast(message);
                    getNot(); // Actualiza el dropdown
                    getMess(); // Actualiza el dropdown
                    updateMessageCount(); // Actualiza el contador de mensajes
                    updateNotCount(); // Actualiza el contador de notificaciones
                }

                // Actualizar los arrays en localStorage
                notificationIds = [...notificationIds, ...newNotifications];
                messageIds = [...messageIds, ...newMessages];
                setLocalStorageValue('notification_ids_' + currentUser, notificationIds);
                setLocalStorageValue('message_ids_' + currentUser, messageIds);
            } catch (e) {
                console.error('Error al procesar la respuesta JSON:', e);
            }
        },
        error: function(error) {
            console.log('Error al verificar nuevas notificaciones');
        }
    });
}



function showNotificationToast(message) {

    toastr.success(message, 'Nueva Notificacion/Mensaje', {
        closeButton: true,
        progressBar: true,
        positionClass: 'toast-top-right',
        timeOut: '8000'
    });
}


$(document).ready(function(){
    allUsr();
    getNot();
    getMess();
    checkNewNotifications(); 
    // Configurar la función para ejecutarse cada 20 segundos
    setInterval(checkNewNotifications, 20000);
});