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
    caselles.forEach(casella => { // Corregit per utilitzar forEach amb 'casella'
        casella.addEventListener('dragover', e => e.preventDefault()); // Permetre drop
        casella.addEventListener('drop', function(e) {
            e.preventDefault();
            if (!fitxaArrossegada) return; // Comprova si hi ha una fitxa arrossegada

            const origen = fitxaArrossegada.parentNode.dataset;
            const destino = this.dataset; // Utilitza 'this' per referir-se a la casella sobre la qual es fa el drop

            // Suposem que tens els inputs en el teu formulari per aquests valors
            document.getElementById('origenFila').value = origen.fila;
            document.getElementById('origenColumna').value = origen.columna;
            document.getElementById('destinoFila').value = destino.fila;
            document.getElementById('destinoColumna').value = destino.columna;

            document.getElementById('movimentForm').submit(); // Envía el formulari
        });
    });
});