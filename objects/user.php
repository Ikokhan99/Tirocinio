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

    private $stmt;

	//constructor
    public function __construct($db)
	{
        $this->conn = $db;
        $this->sex = 0;
        $this->sexor=0;
        $this->age = 18;
    }

	function create(): bool
    {
		$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$temp_id = generateRandomID(25);
		$_SESSION['user-id'] = $temp_id;


		$q = "INSERT INTO user VALUES(\"$temp_id\",$this->sex,$this->age,$this->sexor);";
		// var_dump($q);
		$this->stmt = $this->conn->query($q);
		//$this->conn->exec(' IF `_rollback` THEN ROLLBACK; END IF;');
        //$_SESSION['uid'] = $this->conn->lastInsertId();
	    //we are going to use the prolific id
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
