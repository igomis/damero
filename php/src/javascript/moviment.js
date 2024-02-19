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
            e.preventDefault(); // Permetre deixar anar
        });

        casella.addEventListener('drop', e => {
            e.preventDefault(); // Evitar comportament per defecte
            if (!casella.querySelector('.fitxa') && fitxaArrossegada) {
                casella.appendChild(fitxaArrossegada); // Moure la fitxa a la nova casella
                fitxaArrossegada = null;
            }
        });
    });
});