<?php
// 'user' object
include_once "./config/Foes.php";
//include_once "./config/pbkdf2.php";
class User
{
 
    // database connection and table name
    public $conn;
 
    // object properties
    public int $id;
    public int $sex; //bool
	public int $sexor;
	public int $age;
	public int $trusted;  //bool
    public int $q_order; //bool

    private $stmt;

	//constructor
    public function __construct($db)
	{
        $this->conn = $db;
        $this->sex = 0;
        $this->sexor=0;
        $this->trusted=1;
        $this->age = 18;
    }

	function create()
	{
		$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$q = "INSERT INTO user VALUES(null,$this->sex,$this->age,$this->sexor,$this->trusted,$this->q_order);";
		// var_dump($q);
		$this->stmt = $this->conn->query($q);
		$this->conn->exec(' IF `_rollback` THEN ROLLBACK; END IF;');
        $_SESSION['uid'] = $this->conn->lastInsertId();
	 
		return true;
 
	}
	public function showError()
	{
		echo "<pre>";
        print_r($this->stmt->errorInfo());
		echo "</pre>";
	}

	// we don't need email verification anymore
	
}
