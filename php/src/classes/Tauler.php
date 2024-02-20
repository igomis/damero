<?php
namespace Damero;
use PHPUnit\Exception;

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

    public function __toString() {
        $string ='<div class="taula-de-dames"><div class="capcalera-coordenades"></div>'; // Espai buit a l'esquerra superior
        for ($col = 1; $col < 9; $col++) {
            $string.= "<div class='coordenada'>".chr(64+$col)."</div>"; // A, B, C...
        }
        $string.= '<div class="buit"></div>'; // Final de fila de capçalera
        foreach ($this->caselles as $filaNum => $fila) {
            $string.= "<div class='coordenada'>".($filaNum)."</div>"; // Coordenades de fila
            foreach ($fila as $casella) {
                $string .= $casella;
            }
            $string.= "<div class='coordenada'>".($filaNum)."</div>";
        }
        $string .='<div class="buit"></div>'; // Espai buit a l'inici de la fila inferior
        for ($col = 1; $col < 9; $col++) {
            $string.= "<div class='coordenada'>".chr(64+$col)."</div>"; // A, B, C...
        }
        $string.= '<div class="capcalera-coordenades"></div>';
        $string.= '</div>';
        return $string;
    }

    public function moureFitxa($origenFila, $origenColumna, $destiFila, $destiColumna) {
        try {

            $this->coordenadesCorrectes($origenFila, $origenColumna, $destiFila, $destiColumna);

            $casellaOrigen = $this->caselles[$origenFila][$origenColumna];
            $casellaDesti = $this->caselles[$destiFila][$destiColumna];


            // Verificar que la casella d'origen té una fitxa i la de destinació està buida
            $this->movimentCorrecte($casellaOrigen, $casellaDesti);
            $this->capturaCorrecta($casellaOrigen, $casellaDesti);

            $this->mou($casellaOrigen, $casellaDesti);
        } catch (\Exception $e){
            $_SESSION['error'] = $e->getMessage();
            header('location:index.php');
        }

        return false; // Moviment invàlid
    }

    private function mou($casellaOrigen,$casellaDesti){
        $casellaDesti->ocupant = $casellaOrigen->ocupant;
        $casellaOrigen->ocupant = null;
        $_SESSION['tauler'] = serialize($this);
    }

    private function coordenadesCorrectes(...$coords){
        foreach ($coords as $coord){
            if ($coord < 1 || $coord > $this->tamany) {
                throw new \Exception('Coordenades fora de linea');
            }
        }
    }

    /**
     * @param $casellaOrigen
     * @param $casellaDesti
     * @return void
     * @throws \Exception
     */
    private function movimentCorrecte($casellaOrigen, $casellaDesti): void
    {
        if (! $casellaOrigen->ocupant || $casellaDesti->ocupant || $casellaDesti->color == 'blanc') {
            throw new \Exception('Error en les caselles');
        }
        // Verificar que el moviment es endavant
        if ($casellaOrigen->ocupant === 'jugador1') {
            if ($casellaDesti->fila > $casellaOrigen->fila) {
                throw new \Exception('Moviment endarrere');
            }
        } else {
            if ($casellaDesti->fila < $casellaOrigen->fila) {
                throw new \Exception('Moviment endarrere');
            }
        }
    }

    /**
     * @param $diferenciaFila
     * @param $diferenciaColumna
     * @param $origenFila
     * @param $destiFila
     * @param $origenColumna
     * @param $destiColumna
     * @param $casellaOrigen
     * @return void

    private function capturaCorrecta(
        $origenFila,
        $destiFila,
        $origenColumna,
        $destiColumna
    ): void {
        $diferenciaFila = abs($destiFila - $origenFila);
        $diferenciaColumna = abs($destiColumna - $origenColumna);
        if ($diferenciaFila === 2 && $diferenciaColumna === 2) {
            // Calcular la posició de la fitxa a ser capturada
            $filaCaptura = ($origenFila + $destiFila) / 2;
            $columnaCaptura = ($origenColumna + $destiColumna) / 2;
            $casellaOrigen = $this->caselles[$origenFila][$columnaCaptura];
            $casellaCaptura = $this->caselles[$filaCaptura][$columnaCaptura];

            // Comprovar si la casella conté una fitxa de l'oponent
            if ($casellaCaptura->ocupant && $casellaCaptura->ocupant !== $casellaOrigen->ocupant) {
                // Realitzar la captura
                $casellaCaptura->ocupant = null;
            }
        }
    }
     */

    private function capturaCorrecta(
        $casellaOrigen,
        $casellaDesti
    ): void {
        $diferenciaFila = abs($casellaDesti->fila - $casellaOrigen->fila);
        $diferenciaColumna = abs($casellaDesti->columna - $casellaOrigen->columna);
        if ($diferenciaFila === 2 && $diferenciaColumna === 2) {
            // Calcular la posició de la fitxa a ser capturada
            $filaCaptura = ($casellaOrigen->fila + $casellaDesti->fila) / 2;
            $columnaCaptura = ($casellaOrigen->columna + $casellaDesti->columna) / 2;
            $casellaCaptura = $this->caselles[$filaCaptura][$columnaCaptura];

            // Comprovar si la casella conté una fitxa de l'oponent
            if ($casellaCaptura->ocupant && $casellaCaptura->ocupant !== $casellaOrigen->ocupant) {
                // Realitzar la captura
                $casellaCaptura->ocupant = null;
            }
        }
    }
}
