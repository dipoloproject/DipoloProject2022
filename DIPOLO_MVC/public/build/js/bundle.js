document.addEventListener('DOMContentLoaded', function() {
    evenListeners();
});//cuando se cargan los archivos .html, .css y .js

function evenListeners() {
    const menuHamburguesa = document.querySelector('.menu-hamburguesa');
    menuHamburguesa.addEventListener('click', navegacionResponsive)
}

function navegacionResponsive() {
    const menuSlide = document.querySelector('.navegacion-principal');
    const enlacesMenuSlide = document.querySelector('.enlaces-nologo');

    //menuSlide.classList.toggle('enlaces-navegacion-principal');
    menuSlide.classList.toggle('muestra-menu-slide');
    //enlacesMenuSlide.classList.toggle('enlaces-menu-slide');
}