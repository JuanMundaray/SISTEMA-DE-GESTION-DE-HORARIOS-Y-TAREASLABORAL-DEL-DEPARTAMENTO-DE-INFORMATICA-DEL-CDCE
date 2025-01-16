<?php

namespace App\Model;

require_once("configurarBD.php");

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
    public function insert($data) {
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

    // READ ALL
    public function getAll() {
        try{
            $sql = "SELECT * FROM {$this->schema}.{$this->table}";
            $stmt = $this->pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        catch(PDOException $e)
        {
            echo $e->getMessage()." --- ".$e->getLine();
        }
    }

    // UPDATE
    public function update($data, $id) {
        try{
            $set = "";
            foreach ($data as $key => $value) {
                $set .= "$key = :$key, ";
            }
            $set = rtrim($set, ", ");
            $sql = "UPDATE {$this->schema}.{$this->table} SET $set WHERE id = :id";
            $data['id'] = $id;
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute($data);
        }
        catch(PDOException $e)
        {
            echo $e->getMessage()." --- ".$e->getLine();
        }
    }

    // SOFT DELETE
    public function delete($value,$column = "id") {

        date_default_timezone_set('America/Caracas');
        $delete_at=date('Y-m-d H:i:s');
        $sql = "UPDATE {$this->schema}.{$this->table} SET delete_at = '$delete_at' WHERE $column = :value";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":value", $value);

        return $stmt->execute();
    }
}
?>
