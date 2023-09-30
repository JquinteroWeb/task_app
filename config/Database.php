<?php


class Database
{
    private static $instance = null;
    private $conn;

    private $host;
    private $username;
    private $password;
    private $database_name;
    private $port;
    private $engine;

    private function __construct()
    {
        try {
            $config = parse_ini_file('config.ini', true);
            $this->host = isset($config['database']['hostname']) ? $config['database']['hostname'] : 'localhost';
            $this->port = isset($config['database']['port']) ? $config['database']['port'] : '5432';
            $this->username = isset($config['database']['username']) ? $config['database']['username'] : 'postgres';
            $this->password = isset($config['database']['password']) ? $config['database']['password'] : '';
            $this->database_name = isset($config['database']['database_name']) ? $config['database']['database_name'] : 'postgres';
            $this->engine = isset($config['database']['engine']) ? $config['database']['engine'] : 'mysql';

            $this->conn = new PDO("$this->engine:host=$this->host:$this->port;dbname=$this->database_name", $this->username, $this->password);            
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return $this->conn;
    }
}

