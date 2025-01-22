<?php

namespace App\Model;

require_once("../config/configBD.php");

use App\config;
use PDO;
use PDOException;

class ORM {
    private $pdo;
    private $table;
    private $schema;

    public function __construct($table,$schema) {

        $this->table = $table;
        $this->schema = $schema;

        try
        {
            $datos_servidor=MANEJADOR.':host='.SERVIDOR.';dbname='.BD;
            $this->pdo = new PDO($datos_servidor, USUARIO, CLAVE);
            $this->pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        }
        catch(PDOException $e)
        {
            echo $e->getMessage()." --- ".$e->getLine();
        }
    }

    // CREATE
    public function insert(array $data) {

        $columns = implode(", ", array_keys($data));
        $placeholder = ":" . implode(", :", array_keys($data));

        $sql = "INSERT INTO {$this->schema}.{$this->table} ($columns) VALUES ($placeholder)";
        $stmt = $this->pdo->prepare($sql);

        // Vincular los valores a los placeholders con bindValue
        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
        
        return $stmt->execute();
    }

    //READ
    public function select(
        $column = [], //Los array de aqui no son array asociativos
        $joins = [], //LOS ARRAY DEL PARAMETRO JOIN SON ASOCIATIVOS Y SON LAS TABLAS QUE SE UTILIZARAN PARA HACER EL JOIN
        $where = [], //LOS ARRAY QUE RECIBE EL WHERE SON ASOCIATIVOS, EL KEY DEL ARRAY HACE REFERENCIA A LA COLUMNA Y EL VALOR QUE TIENE QUE ENCONTRARSE EN ESA COLUMNA EN LA BD CORRESPONDE AL VALOR DEL KEY
        $limit = null
        ) 
    {

        //si le envian column como un array vacio entonces se seleccionan todos los campos por defecto
        if(empty($column) || !is_array($column)){
            $column = ["*"];
        }

        // construir la consulta
        $query = "SELECT " . implode(", ", $column) . " FROM {$this -> schema}.{$this -> table}";

        // agreagar consultas JOIN
        foreach ($joins as $join) {
            $query .= " " . strtoupper($join['type']) . " JOIN " . $join['table'] . " ON " . $join['on'];
        }

        // agregar consulta WHERE
        if (!empty($where)) {
            $query .= " WHERE " . implode(" AND ", array_map(function ($column) {
                return "$column = :$column";
            }, array_keys($where)));
        }

        // agregar clausula LIMIT
        if ($limit !== null) {
            $query .= " LIMIT $limit";
        }

        // preparar la consulta
        $stmt = $this->pdo->prepare($query);

        // Vincular parametros
        foreach ($where as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        // Execute and fetch results
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    // UPDATE
    public function update(
        array $data //  los datos para actualizar la consulta, se reciben en un array asociativo
        , array $id                        //el identificador para actualizar el campo o campos de la tabla
    ) {
        try{
            $set = "";
            foreach ($data as $key => $value) {
                $set .= "$key = :$key, ";
            }

            //se extrae el identificador que viene de la base de datos
            $column_id = array_keys($id);
            $value_column_id = array_values($id);

            $set = rtrim($set, ", ");
            $sql = "UPDATE {$this->schema}.{$this->table} SET $set WHERE $column_id[0] = $value_column_id[0]";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute($data);
        }
        catch(PDOException $e)
        {
            echo $e->getMessage()." --- ".$e->getLine();
        }
    }

    // DELETE
    public function delete($id) {

        $placeholders = implode(",", array_fill(0, count($id), "?"));
        $sql = "DELETE FROM {$this->table} WHERE id IN ($placeholders)";
        $stmt = $this->pdo->prepare($sql);
    
        return $stmt->execute($id); // Pasamos el array de IDs directamente
        $stmt->bindValue(":value", $value);

        return $stmt->execute();
    }
}
?>
