document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    // Limpia cualquier instancia anterior del calendario y su contenido.
    // Esto es importante para asegurar que FullCalendar se inicializa en un div limpio.
    if (calendarEl) {
        calendarEl.innerHTML = '';
    }

    // Realiza la llamada AJAX para obtener los datos de asistencia
    $.ajax({
        url: allAsist,
        type: 'POST',
        dataType: 'json', // ¡IMPORTANTE! Espera una respuesta JSON del servidor
        success: function(response) {

            // Ahora, inicializa y renderiza FullCalendar DENTRO de la función success
            // para asegurar que los datos estén disponibles.
            var calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: ['dayGrid', 'timeGrid', 'list', 'interaction'],
                defaultView: 'timeGridWeek',
                height: 'auto',
                locale: 'es',
                firstDay: 1,
                dayMaxEvents: true,
                nowIndicator: true,
                allDaySlot: false,
                slotLabelInterval: { hours: 1 },
                slotEventOverlap: false,
                slotMinTime: '06:00:00',
                slotMaxTime: '23:00:00',
                businessHours: {
                    daysOfWeek: [1, 2, 3, 4, 5], // Lunes a Viernes
                    startTime: '06:00', // Comienza a las 06:00
                    endTime: '23:00' // Termina a las 23:00
                },
                // Aquí asignas los eventos directamente desde la respuesta AJAX
                events: response // Asigna el array 'response' directamente aquí
            });

            calendar.render(); // Renderiza el calendario después de inicializarlo con los eventos

            // Si tienes un problema donde las dimensiones no se calculan bien (como la altura 0 que tuviste),
            // a veces llamar a updateSize() después del render puede ayudar.
            calendar.updateSize(); 

        },
        error: function(xhr, status, error) {
            // Manejo de errores si la llamada AJAX falla
            console.error("Error en la llamada AJAX: " + status + " - " + error);
            console.log(xhr.responseText); // Muestra la respuesta del servidor en caso de error
            alert("Error al cargar los eventos. Por favor, revisa la consola para más detalles.");

            // Si hay un error, puedes renderizar el calendario sin eventos o con un mensaje de error
            var calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: ['dayGrid', 'timeGrid', 'list', 'interaction'],
                // ... (el resto de tus configuraciones de calendario) ...
                events: [] // Renderiza un calendario vacío si hay un error
            });
            calendar.render();
        }
    });
});