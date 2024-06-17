<?php

namespace Core;

use PDO;

class Database
{

    public PDO $connection;
    public $statement;

//    public function __construct($config, $username = 'id21834925_slam2325', $password = 'P4$$w0rd'){
    public function __construct($config, $username = 'root', $password = ''){

        $dsn = "mysql:".http_build_query($config, '',';');

        $this->connection = new PDO($dsn,$username,$password,[
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }

    public function query($query, $params = []): Database
    {
        $this->statement = $this->connection->prepare($query);

        $this->statement->execute($params);

        return $this;

    }

    public function get()
    {
        return $this->statement->fetchAll();
    }

    public function find()
    {
        return $this->statement->fetch();
    }

    public function findOrFail()
    {
        $result = $this->find();

        if(!$result){
            abort(Response::NOT_FOUND);
        }

        return $result;
    }

}
