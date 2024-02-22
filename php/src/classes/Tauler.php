<?php
namespace Damero;
use Damero\Exempcions\MovementException;
use PHPUnit\Exception;

class Tauler {

    private $tamany; // Tamany del tauler
    private $caselles = []; // Array per emmagatzemar objectes Casella

    public function __construct($tamany = 8) {
        $this->tamany = $tamany;
        $this->inicialitzarCaselles();
    }

    public function obtenirCaselles() {
        return $this->caselles;
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



    public function __toString() {
        $string = $this->capCoord();
        foreach ($this->caselles as $filaNum => $fila) {
            $string.= "<div class='coordenada'>".($filaNum)."</div>"; // Coordenades de fila
            foreach ($fila as $casella) {
                $string .= $casella;
            }
            $string.= "<div class='coordenada'>".($filaNum)."</div>";
        }
        $string .= $this->capCoord();
        return $string;
    }

    private function capCoord(){
        $string ='<div class="buit"></div>'; // Espai buit a l'esquerra superior
        for ($col = 1; $col < 9; $col++) {
            $string.= "<div class='coordenada'>".chr(64+$col)."</div>"; // A, B, C...
        }
        $string.= '<div class="buit"></div>'; // Final de fila de capçalera
        return $string;
    }

    public function moureFitxa($origenFila, $origenColumna, $destiFila, $destiColumna, $tornActual) {

        $this->coordenadesCorrectes($origenFila, $origenColumna, $destiFila, $destiColumna);
        $casellaOrigen = $this->caselles[$origenFila][$origenColumna];
        $this->tornCorrecte($casellaOrigen, $tornActual);
        $casellaDesti = $this->caselles[$destiFila][$destiColumna];

        // Verificar que la casella d'origen té una fitxa i la de destinació està buida
        if (!$this->capturaCorrecta($casellaOrigen, $casellaDesti)){
            $this->movimentCorrecte($casellaOrigen, $casellaDesti);
        }
        $this->mou($casellaOrigen, $casellaDesti);
    }
    /**
     * @param $casellaOrigen
     * @param $tornActual
     * @return void
     * @throws \Exception
     */
    private function tornCorrecte($casellaOrigen, $tornActual): void
    {
        if ($casellaOrigen->ocupant !== $tornActual) {
            throw new MovementException('No pots moure la fitxa de l\'oponent');
        }
    }

    private function mou($casellaOrigen,$casellaDesti){
        $casellaDesti->ocupant = $casellaOrigen->ocupant;
        $casellaOrigen->ocupant = null;
        $_SESSION['tauler'] = serialize($this);
    }

    private function coordenadesCorrectes(...$coords){
        foreach ($coords as $coord){
            if ($coord < 1 || $coord > $this->tamany) {
                throw new MovementException('Coordenades fora de linea');
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
        if (!$casellaOrigen || !$casellaDesti){
            throw new MovementException('Casella fora tauler');
        }
        if (!$casellaOrigen->ocupant) {
            throw new MovementException('Casella origen buida');
        }
        if ($casellaDesti->ocupant) {
            throw new MovementException('Casella desti ocupada');
        }
        if ($casellaDesti->color == 'blanc') {
            throw new MovementException('Moviment a casella blanca');
        }
        $diferenciaFila = abs($casellaDesti->fila - $casellaOrigen->fila);
        $diferenciaColumna = abs($casellaDesti->columna - $casellaOrigen->columna);
        if ($diferenciaFila === 1 && $diferenciaColumna === 1) {
            if ($casellaOrigen->ocupant === 'jugador1') {
                if ($casellaDesti->fila <> $casellaOrigen->fila-1 ) {
                    throw new MovementException('Moviment arrere');
                }
            } else {
                if ($casellaDesti->fila <> $casellaOrigen->fila + 1) {
                    throw new MovementException('Moviment endarrere');
                }
            }
        } else {
            throw new MovementException('Dos columnes o files de diferencia');
        }
    }


    private function capturaCorrecta(
        $casellaOrigen,
        $casellaDesti,
        $captura = true
    ): bool {
        if ($casellaOrigen && $casellaDesti && !$casellaDesti->ocupant) {
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
                    if ($captura) {
                        $casellaCaptura->ocupant = null;
                    }
                    return true;
                }
            }
        }
        return false;
    }



    public function comptarFitxes(string $string)
    {
        $fitxes = 0;

        foreach ($this->caselles as $files) {
            foreach ($files as $casella){
                if ($casella->getOcupant() === $string) {
                    $fitxes++;
                }
            }
        }
        return $fitxes;
    }

    public function potMoure($jugador) {
        for ($fila = 1; $fila <= $this->tamany; $fila++) {
            for ($columna = 1; $columna <= $this->tamany; $columna++) {
                $casellaActual = $this->caselles[$fila][$columna];
                if ($casellaActual->ocupant === $jugador) {
                    if ($this->comprovarMovimentsFitxa($casellaActual)) {
                        return true; // Hi ha almenys un moviment vàlid.
                    }
                }
            }
        }
        return false; // No s'ha trobat cap moviment vàlid.
    }

    private function comprovarMovimentsFitxa($casella) {
        $jugador = $casella->ocupant;
        $direccions = $jugador === 'jugador2' ? [[1, -1], [1, 1]] : [[-1, -1], [-1, 1]]; // Direccions de moviment per a cada jugador

        foreach ($direccions as $direccio) {
            $destiFila = $casella->fila + $direccio[0];
            $destiColumna = $casella->columna + $direccio[1];
            $desti = $this->caselles[$destiFila][$destiColumna]??null;
            if ($desti) {
                try {
                    $this->movimentCorrecte($casella, $desti);
                    return true;
                } catch (MovementException $e) {
                }
            }

            // Comprovar captura
            $destiFilaCaptura = $casella->fila + 2 * $direccio[0];
            $destiColumnaCaptura = $casella->columna + 2 * $direccio[1];
            $desti = $this->caselles[$destiFilaCaptura][$destiColumnaCaptura]??null;
            if ( $this->capturaCorrecta($casella,$desti,false)) {
                return true;
            }
        }

        return false;
    }
}
