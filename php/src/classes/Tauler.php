<?php

class Tauler {
    private $tamany; // Tamany del tauler, per exemple, 8 per un tauler 8x8

    public function __construct($tamany = 8) {
        $this->tamany = $tamany;
    }

    public function generarHTML() {
        $html = '<div class="taula-de-dames">';
        for ($fila = 0; $fila < $this->tamany; $fila++) {
            for ($columna = 0; $columna < $this->tamany; $columna++) {
                $classeCasella = ($fila + $columna) % 2 == 0 ? 'blanc' : 'negre';
                $html .= "<div class='$classeCasella'></div>";
            }
        }
        $html .= '</div>';
        return $html;
    }
}
