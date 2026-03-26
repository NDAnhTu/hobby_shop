<?php

namespace Core;

use PDO;

class Database
{
    public $connection;
    public $statement;

    public function __construct($username = 'root', $password = '')
    {
        $config = require base_path("config.php");
        $dsn = 'mysql:' . http_build_query($config['database'], '', ';');
        $this->connection = new PDO($dsn, $username, $password, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }
    public function query($query, $params = [])
    {
        $this->statement = $this->connection->prepare($query);
        $this->statement->execute($params);
        return $this;
    }

    public function getOnce()
    {
        return $this->statement->fetch();
    }

    public function getAll()
    {
        return $this->statement->fetchAll();
    }
}
