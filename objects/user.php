<?php
// 'user' object
include_once "./config/Foes.php";
include_once "Interfaces.php";
//include_once "./config/pbkdf2.php";
class User implements Interfaces
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

	function create($id=null): bool
    {
		$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		if($id==null)
        {
            // echo ("id is null");
            $temp_id = generateRandomID(25);
            if(debug)
            {
                var_dump($temp_id);
            }
            $_SESSION['user-id'] = $temp_id;
            $q = "INSERT INTO user VALUES(\"$temp_id\",$this->sex,$this->age,$this->sexor,default);";
            // var_dump($q);
            $this->stmt = $this->conn->query($q);
            //$this->conn->exec(' IF `_rollback` THEN ROLLBACK; END IF;');
            //$_SESSION['uid'] = $this->conn->lastInsertId();
            //we are going to use the prolific id
        } else{
           // echo ("id is not null");
            $q = "UPDATE user SET id= '$id',sex= $this->sex,age= $this->age,sexor= $this->sexor where id='".$_SESSION['user-id']."';";
            // var_dump($q);
            $this->stmt = $this->conn->query($q);
            $_SESSION['user-id'] = $id;
            //$this->conn->exec(' IF `_rollback` THEN ROLLBACK; END IF;');
            //$_SESSION['uid'] = $this->conn->lastInsertId();
            //we are going to use the prolific id
        }
		if($this->stmt)
		    return true;
		else
        {
            $this->showError($this->stmt);
            return false;
        }


 
	}
	public function showError($stmt)
	{
		echo "<pre>";
        print_r($stmt->errorInfo());
        die();
		echo "</pre>";
	}

	// we don't need email verification anymore
	
}
