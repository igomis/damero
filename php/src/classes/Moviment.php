<?php

namespace Damero;

class Moviment
{
    private $id;
    private $idPartida;
    private $ordre;
    private $origenFila;
    private $origenColumna;
    private $destiFila;
    private $destiColumna;

    public static string $nameTable = 'moviments';

    public function __construct(
        $idPartida=null,
        $ordre=null,
        $origenFila=null,
        $origenColumna=null,
        $destiFila=null,
        $destiColumna=null
    )
    {
        $this->idPartida = $idPartida;
        $this->ordre = $ordre;
        $this->origenFila = $origenFila;
        $this->origenColumna = $origenColumna;
        $this->destiFila = $destiFila;
        $this->destiColumna = $destiColumna;
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getIdPartida(): mixed
    {
        return $this->idPartida;
    }

    public function getOrdre(): mixed
    {
        return $this->ordre;
    }

    public function getOrigenFila(): mixed
    {
        return $this->origenFila;
    }

    public function getOrigenColumna(): mixed
    {
        return $this->origenColumna;
    }

    public function getDestiFila(): mixed
    {
        return $this->destiFila;
    }

    public function getDestiColumna(): mixed
    {
        return $this->destiColumna;
    }


}
