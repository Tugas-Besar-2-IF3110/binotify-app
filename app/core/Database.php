<?php

class Database {
    private $host = DB_HOST;
    private $user = DB_USERNAME;
    private $port = DB_PORT;
    private $password = DB_PASSWORD;
    private $db_name = DB_NAME;

    private $db_handler;
    private $statement;

    public function __construct() {
        $data_source_name = 'mysql:host='. $this->host .';port=' . $this->port . ';dbname=' . $this->db_name;

        $options = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        try {
            $this->db_handler = new PDO($data_source_name, $this->user, $this->password, $options);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function query($query) {
        $this->statement = $this->db_handler->prepare($query);
    }

    public function bind($param, $value, $type = null) {
        if( is_null($type) ) {
            switch( true ) {
                case is_int($value) :
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value) :
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value) :
                    $type = PDO::PARAM_NULL;
                    break;
                default :
                    $type = PDO::PARAM_STR;
            }
        }

        $this->statement->bindValue($param, $value, $type);
    }

    public function execute()
    {
        $this->statement->execute();
    }

    public function multiple()
    {
        $this->execute();
        return $this->statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function single()
    {
        $this->execute();
        return $this->statement->fetch(PDO::FETCH_ASSOC);
    }

    public function rowCount()
    {
        return $this->statement->rowCount();
    }
}

?>