document.addEventListener('DOMContentLoaded', function() {
    const body = document.body;
    const circulo = document.querySelector('.circulo');
    const iconoModo = document.querySelector('.modo-oscuro ion-icon'); // Selecciona el ícono de modo
    const textoModo = document.querySelector('.modo-oscuro .modo'); // Selecciona el texto del modo
    const logo = document.getElementById('logo');
    const barraLateral = document.querySelector('.barra-lateral');
    const spans = document.querySelectorAll('span');
    const palanca = document.querySelector('.switch');
    const menu = document.querySelector('.menu');
    const main = document.querySelector('main');

    // Función para activar o desactivar el modo oscuro
    function toggleDarkMode(active) {
        if (active) {
            body.classList.add('dark-mode');
            circulo.classList.add('prendido');
            localStorage.setItem('darkMode', 'true');
            iconoModo.name = 'moon'; 
            textoModo.textContent = 'Oscuro'; // Cambia el texto a Claro cuando el modo oscuro está activo
        } else {
            body.classList.remove('dark-mode');
            circulo.classList.remove('prendido');
            localStorage.setItem('darkMode', 'false');
            iconoModo.name = 'partly-sunny'; 
            textoModo.textContent = 'Claro'; // Cambia el texto a Oscuro cuando el modo oscuro está inactivo
        }
    }

    // Verifica el estado guardado en localStorage al cargar la página
    function checkDarkModeSetting() {
        const darkMode = localStorage.getItem('darkMode');
        toggleDarkMode(darkMode === 'true');
    }

    checkDarkModeSetting();

    menu.addEventListener('click', () => {
        barraLateral.classList.toggle('max-barra-lateral');
        if (barraLateral.classList.contains('max-barra-lateral')) {
            menu.children[0].style.display = 'none';
            menu.children[1].style.display = 'block';
        } else {
            menu.children[0].style.display = 'block';
            menu.children[1].style.display = 'none';
        }
        if (window.innerWidth <= 320) {
            barraLateral.classList.add('mini-barra-lateral');
            main.classList.add('min-main');
            spans.forEach((span) => {
                span.classList.add('oculto');
            });
        }
    });

    palanca.addEventListener('click', () => {
        let isDarkModeActive = body.classList.contains('dark-mode');
        toggleDarkMode(!isDarkModeActive);
    });

    logo.addEventListener('click', () => {
        barraLateral.classList.toggle('mini-barra-lateral');
        main.classList.toggle('min-main');
        spans.forEach((span) => {
            span.classList.toggle('oculto');
        });
    });
});
