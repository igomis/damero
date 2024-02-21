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
        $this->comprovarEstatJoc();
        // Comprova si el moviment és vàlid, realitza el moviment, i actualitza l'estat del joc si cal
        if ($this->tauler->moureFitxa($origenFila, $origenColumna, $destiFila, $destiColumna, $this->tornActual)) {
            // Moviment vàlid, potser comprova si hi ha un guanyador o si s'ha acabat el joc

            // Canvia el torn
            $this->canviarTorn();
            $_SESSION['partida'] = serialize($this);
        } else {
            // Maneig d'error: Moviment invàlid
            echo "Moviment invàlid. Si us plau, prova un altre cop.";
        }
    }

    public function finalitzada() {
        return $this->estatJoc === "acabat";
    }

    private function comprovarEstatJoc() {
        // Comprova si algun dels jugadors no té fitxes
        $fitxesJugador1 = $this->tauler->comptarFitxes('jugador1');
        $fitxesJugador2 = $this->tauler->comptarFitxes('jugador2');

        if ($fitxesJugador1 == 0 || $fitxesJugador2 == 0) {
            $this->estatJoc = "acabat";
            $this->guanyador = $fitxesJugador1 > 0 ? "jugador1" : "jugador2";
            return;
        }

        // Comprova si el jugador actual no té moviments vàlids
        // Això pot requerir una funció que revisi tots els moviments possibles per al jugador actual
        $potMoure = $this->tauler->potMoure($this->tornActual);
        if (!$potMoure) {
            $this->estatJoc = "acabat";
            // El guanyador és l'altre jugador
            $this->guanyador = $this->tornActual === "jugador1" ? "jugador2" : "jugador1";
            return;
        }

        // Si arribem aquí, el joc continua
        $this->estatJoc = "en curs";
    }


    // Mètodes addicionals segons necessari, com ara getters per l'estat del joc, qui té el torn, etc.
}
