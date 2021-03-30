<?php
// 'user' object
include_once "./config/Foes.php";
include_once "Interfaces.php";

class User /*implements Interfaces*/
{
 
    // database connection and table name
    public PDO $conn;
 
    // object properties
    public int $id;
    public int $sex; //bit in mysql, biological sex
    public int $sexid; //sexual identity (gender)
	public int $sexor; //sexual orientation
	public int $age;

    //constructor
    public function __construct($db)
	{
        $this->conn = $db;
        $this->sex = 0;
        $this->sexor=0;
        $this->age = 18;
        $this->sexid = 0;
    }

	public function create($id): bool
    {
		$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		if(is_null($id))
        {
            if(debug) {
                echo("id is null");
            }
            $temp_id = generateRandomID(25);
            if(debug)
            {
                var_dump($temp_id);
            }
            $_SESSION['user-id'] = $temp_id;
            $q = "INSERT INTO user VALUES(\"$temp_id\",$this->sex,$this->sexid,$this->age,$this->sexor,default,default);";
            // var_dump($q);
            $stmt = $this->conn->query($q);
            //$this->conn->exec(' IF `_rollback` THEN ROLLBACK; END IF;');
            //$_SESSION['uid'] = $this->conn->lastInsertId();
            //we are going to use the prolific id
        } else{
		    //echo ("id is not null");
		    if(isset($_SESSION['user-id'])) {
                $q = "UPDATE user SET sexid= $this->sex,age= $this->age,sexor= $this->sexor where id='" . $_SESSION['user-id'] . "';";
            }
		    else{
                $_SESSION['user-id'] = $id;
                $q = "INSERT INTO user VALUES('$id',$this->sex,$this->sexid,$this->age,$this->sexor,default,default);";
            }
            // var_dump($q);
            try {
                $stmt = $this->conn->query($q);
            } catch (PDOException $e){
                print_r("This USER has already done the experiment" );
                die;
            }



            //$this->conn->exec(' IF `_rollback` THEN ROLLBACK; END IF;');
            //$_SESSION['uid'] = $this->conn->lastInsertId();
            //we are going to use the prolific id
        }
		if($stmt) {
            return true;
        }

        print_r("This ID has already done the experiment" );
        die();


    }
	public function showError($stmt): void
    {
		echo "<pre>";
            print_r("This ID has already done the experiment" );
        echo "</pre>";
        die();

	}

	// we don't need email verification anymore
	
}
