<?php

namespace Damero;


class Game {
    private $datetime = null;
    private $idUser;
    private $id;

    public static $nameTable = 'partida';

    public function __construct() {
    }

    public function getId() {
        return $this->id;
    }

    public function getDatetime()
    {
        return $this->datetime;
    }

    public static function find($id)
    {
        return QueryBuilder::find(Game::class,$id);
    }

    public function delete(){
        return QueryBuilder::delete(Game::class, $this->id);
    }

}
