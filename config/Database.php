<?php

class Database
{
    private $host = 'localhost';
    private $dbname = 'api';
    private $username = 'root';
    private $password = '';

    public function getConnexion()
    {
        $connect = null;

        try {
            $connect = new PDO(
                "mysql:host=$this->host;dbname=$this->dbname",
                $this->username,
                $this->password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
            );
        } catch (\PDOException $e) {
            echo "Connection failed : " . $e->getMessage();
        }
        return $connect;
    }
}
