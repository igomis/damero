<?php

namespace Damero;
use Damero\Exempcions\MovementException;

class Partida {
    private $tauler;
    private $tornActual;
    private $estatJoc; // Podria ser "en curs", "acabat", etc.
    private $guanyador; // "jugador1", "jugador2", o null si encara no hi ha guanyador
    private $obligat = false;
    private $dobleCaptura = null;
    private $moviments = [];

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

    public function getEstatJoc(): string
    {
        return $this->estatJoc;
    }

    public function getTorn(): string
    {
        return $this->tornActual;
    }

    public function getTornActual(): string
    {
        return $this->tornActual == 'jugador1'?'juguen blanques':'juguen negres';
    }


    public function canviarTorn() {
        $this->tornActual = ($this->tornActual === "jugador1") ? "jugador2" : "jugador1";
    }

    public function moureFitxa($origenFila, $origenColumna, $destiFila, $destiColumna) {
        if ($this->finalitzada()) {
            return 'La partida ha acabat. No es poden fer més moviments.';
        } else {
            try {
                $captura = $this->tauler->moureFitxa(
                    $origenFila,
                    $origenColumna,
                    $destiFila,
                    $destiColumna,
                    $this->tornActual,
                    $this->obligat,
                    $this->dobleCaptura);
                if (!$captura || !$this->tauler->teCapturesDisponibles($captura) ) {
                    $this->canviarTorn();
                    $this->dobleCaptura = null;
                } else {
                    $this->dobleCaptura = $captura;
                }
                $_SESSION['partida'] = serialize($this);
                $this->moviments[] = [
                    'origenFila' => $origenFila,
                    'origenColumna' => chr(64+$origenColumna),
                    'destiFila' => $destiFila,
                    'destiColumna' => chr(64+$destiColumna),
                ];
                $this->obligat = $this->comprovarEstatJoc();
                return 'Moviment realitzat correctament';
            }catch (MovementException $e) {
                return 'Moviment invàlid. Si us plau, prova un altre cop: '.$e->getMessage();
            }
        }
        // Comprova si el moviment és vàlid, realitza el moviment, i actualitza l'estat del joc si cal

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
            return false;
        }

        // Comprova si el jugador actual no té moviments vàlids
        // Això pot requerir una funció que revisi tots els moviments possibles per al jugador actual
        $potMoure = $this->tauler->potMoure($this->tornActual);
        if (!$potMoure) {
            $this->estatJoc = "acabat";
            // El guanyador és l'altre jugador
            $this->guanyador = $this->tornActual === "jugador1" ? "jugador2" : "jugador1";
            return 0;
        }

        // Si arribem aquí, el joc continua
        $this->estatJoc = "en curs";
        if ($potMoure === 1) { // va obligat a capturar
            return true;
        }
        return false;
    }


    // Mètodes addicionals segons necessari, com ara getters per l'estat del joc, qui té el torn, etc.
}
