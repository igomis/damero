<?php

namespace Damero;
class Partida {
    private $tauler;
    private $tornActual;
    private $estatJoc; // Podria ser "en curs", "acabat", etc.
    private $guanyador; // "jugador1", "jugador2", o null si encara no hi ha guanyador

    public function __construct() {
        $this->tauler = new Tauler(); // Suposem que tens una classe Tauler
        $this->tornActual = "jugador1"; // O tria aleatòriament qui comença
        $this->estatJoc = "en curs";
        $this->guanyador = null;
    }

    public function getTauler(): Tauler
    {
        return $this->tauler;
    }

    public function getTorn(): string
    {
        return $this->tornActual;
    }


    public function canviarTorn() {
        $this->tornActual = ($this->tornActual === "jugador1") ? "jugador2" : "jugador1";
    }

    public function moureFitxa($origenFila, $origenColumna, $destiFila, $destiColumna) {
        // Comprova si el moviment és vàlid, realitza el moviment, i actualitza l'estat del joc si cal
        if ($this->tauler->moureFitxa($origenFila, $origenColumna, $destiFila, $destiColumna, $this->tornActual)) {
            // Moviment vàlid, potser comprova si hi ha un guanyador o si s'ha acabat el joc
            $this->comprovarEstatJoc();

            // Canvia el torn
            $this->canviarTorn();
            $_SESSION['partida'] = serialize($this);
        } else {
            // Maneig d'error: Moviment invàlid
            echo "Moviment invàlid. Si us plau, prova un altre cop.";
        }
    }

    private function comprovarEstatJoc() {
        // Aquí hauries d'incloure la lògica per determinar si el joc ha acabat
        // i qui és el guanyador si n'hi ha. Això podria implicar comprovar si un jugador
        // no té moviments vàlids disponibles o si totes les fitxes d'un jugador han estat capturades.
    }

    // Mètodes addicionals segons necessari, com ara getters per l'estat del joc, qui té el torn, etc.
}
