<?php

require_once('config.php');

class Database
{
    private $connection;

    function __construct()
    {
        $this->open_db_connection();
    }

    public function open_db_connection()
    {
        $this->connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $this->connection->set_charset("utf8");
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    public function get_connection()
    {
        return $this->connection;
    }

    public function query($sql)
    {
        $result = $this->connection->query($sql);
        if (!$result) {
            echo 'Query failed<br>';
            echo 'SQL=' . $sql;
            echo '<br>';
            die($this->connection->error);
        } else {
            return $result;
        }
    }
}
$database = new Database();
