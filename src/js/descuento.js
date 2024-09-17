(function() {

    const barraPorcentaje = document.getElementById('barraPorcentaje');

    if(barraPorcentaje) {

        const porcentajeSeleccionado = document.getElementById('porcentajeSeleccionado');
        const precioFinal = document.getElementById('precioFinal');
        const precioInicialElemento = document.getElementById('precioActual');
        const precioInicial = parseFloat(precioInicialElemento.innerText.replace('$', ''));
        barraPorcentaje.addEventListener('input', () => {
            const porcentaje = barraPorcentaje.value;
            const descuento = precioInicial * (porcentaje / 100);
            const precioConDescuento = precioInicial - descuento;
    
            porcentajeSeleccionado.textContent = porcentaje + '%';
            precioFinal.value = precioConDescuento.toFixed(2);
            porcentajeDescuento.value = porcentaje;
        });

    }

})();
