document.addEventListener('DOMContentLoaded', () => {
    const fitxes = document.querySelectorAll('.fitxa[draggable="true"]');
    let fitxaArrossegada = null;

    fitxes.forEach(fitxa => {
        fitxa.addEventListener('dragstart', e => {
            fitxaArrossegada = fitxa;
            e.dataTransfer.setData('text/plain', null); // Necessari per a alguns navegadors
        });
    });

    const caselles = document.querySelectorAll('.casella');
    caselles.forEach(casella => {
        casella.addEventListener('dragover', e => {
            e.preventDefault(); // Permite el drop
        });

        casella.addEventListener('drop', e => {
            e.preventDefault(); // Prevenir comportamiento por defecto

            // Obtener las coordenadas o identificadores de origen y destino
            const origen = fitxaArrossegada.parentNode.dataset;
            const destino = casella.dataset;

            // Preparar los datos a enviar
            const datos = { origenFila: origen.fila, origenColumna: origen.columna, destiFila: destino.fila , destiColumna: destino.columna};

            // Realizar petición al servidor PHP
            fetch('http://localhost/api/validarMoviment.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(datos),
            })
                .then(response => response.json())
                .then(data => {
                    if (data.valid) {
                        // Si el movimiento es válido, mover la pieza
                        casella.appendChild(fitxaArrossegada);
                    } else {
                        // Si el movimiento no es válido, devolver la pieza a su posición original
                        fitxaArrossegada.parentNode.appendChild(fitxaArrossegada);
                    }
                    fitxaArrossegada = null; // Limpiar la referencia
                })
                .catch(error => {
                    console.error('Error en la petición:', error);
                    // Manejar errores, posiblemente revertir el movimiento
                    fitxaArrossegada.parentNode.appendChild(fitxaArrossegada);
                    fitxaArrossegada = null;
                });
        });
    });
});