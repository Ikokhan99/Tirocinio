<?php

class Database
{
    private $host = //"193.205.204.226";
    "localhost";
    private $db_name = //"VaesDB";
        "VAESDB2";
    private $username = //"vaes";
    "root";
    private $password =//"54es!";
    "";
    public $conn;
 
    public function getConnection(): PDO
    {
 
        $this->conn = null;
 
        try{
				$this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password,array(PDO::ATTR_PERSISTENT => false));
				$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}
		catch(PDOException $e)
			{
				error_log('PDOException - ' . $e->getMessage(), 0);
				http_response_code(500);
				die('Internal Server Error');
			}
 
        return $this->conn;
    }
}
