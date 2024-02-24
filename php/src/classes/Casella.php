<?php
namespace Damero;
class Casella {
    public $fila;
    public $columna;
    public $color;
    public $ocupant; // Null si està buida, o 'jugador1', 'jugador2'
    public $tipus; // 'fitxa' o 'dama'

    /**
     * @return mixed|null
     */
    public function getOcupant()
    {
        return $this->ocupant;
    } // 'blanc' o 'negre'
    public function __construct($fila, $columna, $color, $ocupant = null,$tipus = 'fitxa') {
        $this->fila = $fila;
        $this->columna = $columna;
        $this->color = $color;
        $this->ocupant = $ocupant;
        $this->tipus = $tipus;
    }

    public function __toString()
    {

        $string =  "<div class='casella {$this->color}' data-fila='{$this->fila}' data-columna='{$this->columna}'>";
        if ($this->ocupant){
            $classeOcupant = $this->ocupant ? " {$this->tipus}-{$this->ocupant}" : "";
            $draggable = $this->ocupant ? 'draggable="true"' : '';
            $string .= "<div class='fitxa {$this->color} {$classeOcupant}' {$draggable}></div>";
        }
        $string .= "</div>";
        return $string;
    }

    public function getColumna()
    {
        return chr(64+$this->columna);
    }
}
