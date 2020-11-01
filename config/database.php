<?php

//TODO: da modificare

class Database
{
    private string $host = "localhost";
    private string $db_name = "VaesDB";
    private string $username = "root";
    private string $password = "";
    public $conn;
 
    public function getConnection()
	{
 
        $this->conn = null;
 
        try{
				$this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password,array(PDO::ATTR_PERSISTENT => true));
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
