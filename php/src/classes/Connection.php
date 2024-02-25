<?php
namespace Damero;

use PDO;
use PDOException;

include_once $_SERVER['DOCUMENT_ROOT']."/config/database.inc.php";

class Connection
{

    private $connection;

    public function __construct()
    {
        try {
            $this->connection = new PDO(DSN, USUARIO, PASSWORD);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Falló la conexión: ' . $e->getMessage();
            die();
        }
    }

    public function getConnection(): PDO
    {
        return $this->connection;
    }

    public static function get(): PDO
    {
        $conn = new Connection();
        return $conn->getConnection();
    }

}
