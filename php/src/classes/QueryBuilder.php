<?php

namespace Damero;

use PDO;

class QueryBuilder
{
    public static function sql($class, $values=null, $limit = null, $offset = null)
    {
        $table = $class::$nameTable;
        $conn = Connection::get();
        $sql = "SELECT * FROM $table";
        if ($values) {
            $sql .= " WHERE ";
            foreach (array_keys($values) as $key => $id) {
                if ($key != 0) {
                    $sql .= " AND $id=:$id";
                } else {
                    $sql .= "$id=:$id";
                }
            }
        }
        if (isset($limit) && isset($offset)) {
            $sql .= " LIMIT $limit OFFSET $offset";
        }
        $sentence = $conn->prepare($sql);
        foreach ($values??[] as $key => $value) {
            $sentence->bindValue(":$key", $value);
        }
        $sentence -> setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE , $class);
        $sentence -> execute();
        return  $sentence->fetchAll();
    }

    public static function find($class, $id)
    {
        $table = $class::$nameTable;
        $conn = Connection::get();
        $sql = "SELECT * FROM $table WHERE id = :id";
        $sentence = $conn->prepare($sql);
        $sentence->bindValue(":id", $id);
        $sentence -> setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE , $class);
        $sentence -> execute();
        if ($sentence->rowCount() == 1) {
            return  $sentence->fetch();
        }
        return null;
    }

    public static function all($class,$limit = null, $offset = null)
    {
        $table = $class::$nameTable;
        $conn = Connection::get();
        $sql = "SELECT * FROM $table";
        if (isset($limit) && isset($offset)) {
            $sql .= " LIMIT $limit OFFSET $offset";
        }
        $sentence = $conn->prepare($sql);
        $sentence -> setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE , $class);
        $sentence -> execute();

        return  $sentence->fetchAll();
    }

    public static function insert($class, $values)
    {
        $table = $class::$nameTable;
        $conn = Connection::get();
        $sql = "INSERT INTO $table (";
        foreach (array_keys($values) as $key => $id) {
            if ($key != 0) {
                $sql .= ','.$id;
            } else {
                $sql .= $id;
            }
        }
        $sql .= ") VALUES (";
        foreach (array_keys($values) as $key => $id) {
            if ($key != 0) {
                $sql .= ',:'.$id;
            } else {
                $sql .= ':'.$id;
            }
        }
        $sql .= ")";
        $sentence = $conn->prepare($sql);
        foreach ($values as $key => $value) {
            $sentence->bindValue(":$key", $value);
        }

        $sentence -> execute();
        return $conn->lastInsertId();
    }

    public static function update($class, $values, $id)
    {
        $table = $class::$nameTable;
        $conn = Connection::get();
        $sql = "UPDATE $table SET ";
        foreach (array_keys($values) as $key => $value) {
            if ($key != 0) {
                $sql .= ','.$value.'=:'.$value;
            } else {
                $sql .= $value.'=:'.$value;
            }
        }
        $sql .= " WHERE id=:id";
        $sentence = $conn->prepare($sql);
        foreach ($values as $key => $value) {
            $sentence->bindValue(":$key", $value);
        }
        $sentence->bindValue(":id", $id);
        $sentence -> execute();
        return $id;
    }

    public static function delete($class, $id)
    {
        $table = $class::$nameTable;
        $conn = Connection::get();
        $sql = "DELETE FROM $table WHERE id=:id";
        $sentence = $conn->prepare($sql);
        $sentence->bindValue(":id", $id);
        $lines = $sentence -> execute();
        if ($lines == 0) {
            throw new Exception("No se ha podido eliminar el registro");
        } else {
            return $lines;
        }
    }
}
