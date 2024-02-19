<?php

class Casella {
    public $color; // 'blanc' o 'negre'
    public $ocupant; // Null si està buida, o 'jugador1', 'jugador2'

    public function __construct($color, $ocupant = null) {
        $this->color = $color;
        $this->ocupant = $ocupant;
    }
}