<?php

class Tauler {
    private $tamany; // Tamany del tauler
    private $caselles = []; // Array per emmagatzemar objectes Casella

    public function __construct($tamany = 8) {
        $this->tamany = $tamany;
        $this->inicialitzarCaselles();
    }

    private function inicialitzarCaselles() {
        for ($fila = 0; $fila < $this->tamany; $fila++) {
            for ($columna = 0; $columna < $this->tamany; $columna++) {
                $colorCasella = ($fila + $columna) % 2 == 0 ? 'blanc' : 'negre';
                $ocupant = null;
                if ($colorCasella == 'negre') {
                    if ($fila < 3) {
                        $ocupant = 'jugador1';
                    } elseif ($fila > 4) {
                        $ocupant = 'jugador2';
                    }
                }
                $this->caselles[$fila][$columna] = new Casella($colorCasella, $ocupant);
            }
        }
    }

    public function obtenirCaselles() {
        return $this->caselles;
    }

    public function paint() {
        echo '<div class="taula-de-dames">';
        foreach ($this->caselles as $fila) {
            foreach ($fila as $casella) {
                $classeOcupant = $casella->ocupant ? " fitxa-{$casella->ocupant}" : "";
                echo "<div class='casella {$casella->color}{$classeOcupant}'></div>";
            }
        }
        echo '</div>';
    }
}
