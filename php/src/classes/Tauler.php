<?php
namespace Damero;
class Tauler {
    private $tamany; // Tamany del tauler
    private $caselles = []; // Array per emmagatzemar objectes Casella

    public function __construct($tamany = 8) {
        $this->tamany = $tamany;
        $this->inicialitzarCaselles();
    }

    private function inicialitzarCaselles() {
        for ($fila = 1; $fila < $this->tamany+1; $fila++) {
            for ($columna = 1; $columna < $this->tamany+1; $columna++) {
                $colorCasella = ($fila + $columna) % 2 == 0 ? 'blanc' : 'negre';
                $ocupant = null;
                if ($colorCasella == 'negre' && ($fila < 4 || $fila > 5)) {
                    $ocupant = $fila < 4 ? 'jugador2' : 'jugador1';
                }
                $this->caselles[$fila][$columna] = new Casella($fila, $columna, $colorCasella, $ocupant);
            }
        }
    }

    public function obtenirCaselles() {
        return $this->caselles;
    }

    public function paint() {
        echo '<div class="taula-de-dames">';
        echo '<div class="capcalera-coordenades"></div>'; // Espai buit a l'esquerra superior
        for ($col = 1; $col < 9; $col++) {
            echo "<div class='coordenada'>".chr(64+$col)."</div>"; // A, B, C...
        }
        echo '<div class="buit"></div>'; // Final de fila de capçalera
        foreach ($this->caselles as $filaNum => $fila) {
            echo "<div class='coordenada'>".($filaNum)."</div>"; // Coordenades de fila
            foreach ($fila as $casella) {
                echo $casella;
            }
            echo "<div class='coordenada'>".($filaNum)."</div>";
        }
        echo '<div class="buit"></div>'; // Espai buit a l'inici de la fila inferior
        for ($col = 1; $col < 9; $col++) {
            echo "<div class='coordenada'>".chr(64+$col)."</div>"; // A, B, C...
        }
        echo '<div class="capcalera-coordenades"></div>';
        echo '</div>';
    }

    public function moureFitxa($origenFila, $origenColumna, $destiFila, $destiColumna) {
        // Verificar que les coordenades estan dins dels límits del tauler
        if ($origenFila < 1 || $origenFila >= $this->tamany || $origenColumna < 1 || $origenColumna >= $this->tamany ||
            $destiFila < 1 || $destiFila >= $this->tamany || $destiColumna < 1 || $destiColumna >= $this->tamany) {
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
