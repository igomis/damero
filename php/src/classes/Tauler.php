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
        echo '<div class="capcalera-coordenades"></div>'; // Espai buit a l'esquerra superior
        for ($col = 0; $col < 8; $col++) {
            echo "<div class='coordenada'>".chr(65+$col)."</div>"; // A, B, C...
        }
        echo '<div class="buit"></div>'; // Final de fila de capçalera
        foreach ($this->caselles as $filaNum => $fila) {
            echo "<div class='coordenada'>".($filaNum+1)."</div>"; // Coordenades de fila
            foreach ($fila as $casella) {
                $classeOcupant = $casella->ocupant ? " fitxa-{$casella->ocupant}" : "";
                echo "<div class='casella {$casella->color}{$classeOcupant}'></div>";
            }
            echo "<div class='coordenada'>".($filaNum+1)."</div>";
        }
        echo '<div class="buit"></div>'; // Espai buit a l'inici de la fila inferior
        for ($col = 0; $col < 8; $col++) {
            echo "<div class='coordenada'>".chr(65+$col)."</div>"; // A, B, C...
        }
        echo '<div class="capcalera-coordenades"></div>';
        echo '</div>';
    }

    public function moureFitxa($origenFila, $origenColumna, $destiFila, $destiColumna) {
        // Verificar que les coordenades estan dins dels límits del tauler
        if ($origenFila < 0 || $origenFila >= $this->tamany || $origenColumna < 0 || $origenColumna >= $this->tamany ||
            $destiFila < 0 || $destiFila >= $this->tamany || $destiColumna < 0 || $destiColumna >= $this->tamany) {
            return false; // Coordenades fora dels límits
        }

        $casellaOrigen = $this->caselles[$origenFila][$origenColumna];
        $casellaDesti = $this->caselles[$destiFila][$destiColumna];

        // Verificar que la casella d'origen té una fitxa i la de destinació està buida
        if ($casellaOrigen->ocupant && !$casellaDesti->ocupant && $casellaDesti->color == 'negre') {
            // Realitzar el moviment
            $casellaDesti->ocupant = $casellaOrigen->ocupant;
            $casellaOrigen->ocupant = null;
            return true; // Moviment realitzat amb èxit
        }

        return false; // Moviment invàlid
    }
}
