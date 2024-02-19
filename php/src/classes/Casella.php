<?php

class Casella {
    public $fila;
    public $columna;
    public $color; // 'blanc' o 'negre'
    public $ocupant; // Null si està buida, o 'jugador1', 'jugador2'

    public function __construct($fila, $columna, $color, $ocupant = null) {
        $this->fila = $fila;
        $this->columna = $columna;
        $this->color = $color;
        $this->ocupant = $ocupant;
    }

    public function __toString()
    {

        $string =  "<div class='casella {$this->color}' data-fila='{$this->fila}' data-columna='{$this->columna}'>";
        if ($this->ocupant){
            $classeOcupant = $this->ocupant ? " fitxa-{$this->ocupant}" : "";
            $draggable = $this->ocupant ? 'draggable="true"' : '';
            $string .= "<div class='fitxa {$this->color} {$classeOcupant}' {$draggable}></div>";
        }
        $string .= "</div>";
        return $string;
    }
}
