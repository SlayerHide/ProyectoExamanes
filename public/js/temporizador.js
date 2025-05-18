document.addEventListener('DOMContentLoaded', function () {
    let duracion = window.DURACION_EXAMEN || 300;

    const reloj = document.getElementById('reloj');
    const formulario = document.querySelector('form');
    const alarma = document.getElementById('alarma');

    const timer = setInterval(() => {
        let minutos = Math.floor(duracion / 60);
        let segundos = duracion % 60;

        reloj.textContent = `${String(minutos).padStart(2, '0')}:${String(segundos).padStart(2, '0')}`;

        if (duracion <= 0) {
            clearInterval(timer);
            if (alarma) alarma.play();
            alert('¡Tiempo terminado! Enviando el examen automáticamente.');
            formulario.submit();
        }

        duracion--;
    }, 1000);
});
