<?php

class Tauler {
    private $tamany; // Tamany del tauler, típicament 8 per a dames
    private $dades;

    public function __construct($tamany = 8) {
        $this->tamany = $tamany;
        $this->taulerInicial();
    }

    public function taulerInicial() {
        $this->dades = [];
        for ($fila = 0; $fila < $this->tamany; $fila++) {
            for ($columna = 0; $columna < $this->tamany; $columna++) {
                // Definim el color de la casella
                $colorCasella = ($fila + $columna) % 2 == 0 ? 'blanc' : 'negre';
                $fitxa = null;

                // Posicionem les fitxes per a cada jugador en les tres primeres files de cada costat
                if ($colorCasella == 'negre' && $fila < 3) {
                    $fitxa = 'fitxa-jugador1';
                } elseif ($colorCasella == 'negre' && $fila > 4) {
                    $fitxa = 'fitxa-jugador2';
                }

                $this->dades[$fila][$columna] = ['color' => $colorCasella, 'fitxa' => $fitxa];
            }
        }
    }

    public function paint() {
        echo '<div class="taula-de-dames">';
        foreach ($this->dades as $fila) {
            foreach ($fila as $casella) {
                $classeFitxa = $casella['fitxa'] ? " " . $casella['fitxa'] : "";
                echo "<div class='{$casella['color']}{$classeFitxa}'></div>";
            }
        }
        echo '</div>';
    }
}
