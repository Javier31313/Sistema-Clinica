<?php

namespace App\Models;

use mysqli;

class Model
{

    protected $db_host = DB_HOST;
    protected $db_user = DB_USER;
    protected $db_pass = DB_PASS;
    protected $db_name = DB_NAME;

    protected $connection;
    protected $query;

    public function __construct() {
        $this->connection();
    }

    public function connection() {

        $this->connection = new mysqli($this->db_host, $this->db_user, $this->db_pass, 
        $this->db_name);

        if($this->connection->connect_error) {
            die('Error de conexión: '. $this->connection->connect_error);
        }
    }

    public function query($sql) { //Metodo solo para hacer la consulta y se guarda en: protected $query
        $this->query = $this->connection->query($sql);
        return $this; //Esto retorna el propio objeto y su funcion es que en ClientesController podamos concatenar el metodo por el cual se mostrará
    }

    public function first(){
        return $this->query->fetch_assoc();
    }

    public function get() {
        return $this->query->fetch_all(MYSQLI_ASSOC);
    }

    //Consultas
    public function all() {
        $sql = "SELECT * FROM {$this->table}"; //{$this->table} es $tabla en ClienteModel.php quien contiene la tabla
        return $this->query($sql)->get();
    }

    public function find($id) {
        //SELECT * FROM clientes WHERE id = 1
        $sql = "SELECT * FROM {$this->table} WHERE id = {$id}";
        return $this->query($sql)->first();
    }

    public function where($column,$operator,$value=null) {
        //SELECT * FROM clientes WHERE nombre_empresa = 'nombre_ejemplo'

        if($value == null) { // si $value se queda nulo o toma el valor de nulo lo que quiere decir que no se definio en su parametro ningun valor
            $value = $operator; // value toma el valor de operator ya que es el segundo parametro.
            $operator = '=';
        }

        $sql = "SELECT * FROM {$this->table} WHERE {$column} {$operator} '{$value}' ";
        return $this->query($sql); // no se define por cual metodo lo va a mostrar porque lo hacemos desde ClientesController.php
    }

    public function create($data) {
        // INSERT INTO clientes (nombre_empresa, correo_empresarial) VALUES ('','')

        $columns = array_keys($data);
        $columns = implode(', ',$columns);

        $values = array_values($data);
        $values = "'" . implode("', '",$values). "'";

        $sql = "INSERT INTO {$this->table} ({$columns}) VALUES ({$values})";

        $this->query($sql);

        $insert_id = $this->connection->insert_id;

        return $this->find($insert_id);
    }

    public function update($id,$data) {
        // UPDATE clientes SET nombre_empresa = '', correo_empresarial = '' WHERE id = 1

        $fields = [];

        foreach($data as $key => $values) {
            $fields[] = "{$key} = '{$values}'";//definimos la forma que tiene que ser la sentencia
        }

        $fields = implode(', ', $fields);

        $sql = "UPDATE {$this->table} SET {$fields} WHERE id = {$id}";

        $this->query($sql);

        return $this->find($id);
    }

    public function delete($id) {
        //DELETE FROM clientes WHERE id = 1

        $sql = "DELETE FROM {$this->table} WHERE id = {$id}";
        $this->query($sql);

        return "ELIMINADO";
    }
}