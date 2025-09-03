$(document).ready(function() {
    let timerInterval;
    let startTime;
    let pauseStartTime;
    let accumulatedPauseTime = 0;

    const timeDisplay = $('#timeDisplay');
    const startBtn = $('#startBtn');
    const pauseBtn = $('#pauseBtn');
    const endBtn = $('#endBtn');

    const targetHours = 8; // 8 hours

    function formatTime(milliseconds) {
        const hours = Math.floor((milliseconds / (1000 * 60 * 60)) % 24);
        const minutes = Math.floor((milliseconds / 60000) % 60);
        const seconds = Math.floor((milliseconds / 1000) % 60);
        return `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
    }

    function updateDisplay() {
        const elapsedTime = Date.now() - startTime - accumulatedPauseTime;
        timeDisplay.val(formatTime(elapsedTime));
    }

    function startTimer() {
        startBtn.addClass('d-none');
        pauseBtn.removeClass('d-none');
        endBtn.removeClass('d-none');
        saveStartTime();
    }

    function pauseTimer() {
        clearInterval(timerInterval);
        accumulatedPauseTime += Date.now() - pauseStartTime;
        pauseBtn.text('Reanudar');
        savePauseStartTime();
    }

    function resumeTimer() {
        pauseStartTime = Date.now();
        timerInterval = setInterval(updateDisplay, 1000);
        pauseBtn.text('Pausa');
        savePauseEndTime();
    }

    function endTimer() {
        saveEndTime(timeDisplay.val());
        clearInterval(timerInterval);
        timeDisplay.val('00:00');
        startBtn.removeClass('d-none');
        pauseBtn.addClass('d-none');
        endBtn.addClass('d-none');
    }

    function saveStartTime() {
        const d = new Date();
        const time = `${d.getHours()}:${d.getMinutes()}:${d.getSeconds()}`;
        const date = `${d.getFullYear()}-${d.getMonth() + 1}-${d.getDate()}`;
        $.ajax({
            url: nuevaAsis,
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ "time": time, "date": date }),
            complete: function(xhr, textStatus) {
                if (xhr.status == 200) {
                    console.log("Se guardo el tiempo de inicio");
                    startTime = Date.now();
                    timerInterval = setInterval(updateDisplay, 1000);
                } else {
                    console.log("No se guardo el tiempo de inicio");
                }
            },
            error: function(xhr, status, error) {
                console.error('Error saving start time:', error);
            }
        });
    }

    function savePauseStartTime() {
        $.ajax({
            url: '/api/savePauseStartTime',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ pauseStartTime: new Date().toISOString() }),
            success: function(response) {
                console.log('Pause start time saved successfully');
            },
            error: function(xhr, status, error) {
                console.error('Error saving pause start time:', error);
            }
        });
    }

    function savePauseEndTime() {
        $.ajax({
            url: 'finAsis',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ pauseEndTime: new Date().toISOString() }),
            success: function(response) {
                console.log('Pause end time saved successfully');
            },
            error: function(xhr, status, error) {
                console.error('Error saving pause end time:', error);
            }
        });
    }

    function saveEndTime(horTrab) {
        
        const d = new Date();
        const time = `${d.getHours()}:${d.getMinutes()}:${d.getSeconds()}`;
        const date = `${d.getFullYear()}-${d.getMonth() + 1}-${d.getDate()}`;
        $.ajax({
            url: finAsis,
            method: 'POST',

            data:  {"horTrab": horTrab},
            success: function(response) {
                console.log('End time saved successfully');
            },
            error: function(xhr, status, error) {
                console.error('Error saving end time:', error);
            }
        });
    }


    function updateWorkHours() {
        $.ajax({
            url: horasTrab,
            method: 'POST',
            contentType: 'application/json',
            success: function(response) {
                if (response) {
                    const [hours, minutes, seconds] = response.split(':').map(Number);
                    const startTimestamp = new Date().setHours(hours, minutes, seconds, 0);
                    startTime = startTimestamp;
                    accumulatedPauseTime = 0;
                    timerInterval = setInterval(updateDisplay, 1000);
                    // Disable the start button since there is already a start time
                    startBtn.addClass('d-none');
                    pauseBtn.removeClass('d-none');
                    endBtn.removeClass('d-none');
                } else {
                    // If no previous time, enable start button
                    startBtn.removeClass('d-none');
                    pauseBtn.addClass('d-none');
                    endBtn.addClass('d-none');
                }
            },
  
        });
    }

    startBtn.on('click', startTimer);
    pauseBtn.on('click', function() {
        if (pauseBtn.text().trim() === 'Pausa') {
            pauseStartTime = Date.now();
            pauseTimer();
        } else {
            resumeTimer();
        }
    });
    endBtn.on('click', endTimer);

    updateWorkHours();
});
