<?php
// 'user' object
include_once "./config/InputCheckFoo.php";
include_once "./config/pbkdf2.php";
class User
{
 
    // database connection and table name
    public $conn;
 
    // object properties
    public int $id;
    public int $sex; //bool
    public string $salt;
    public string $mail;
    public string $password;
	public int $verified; //bool
	public int $sexor;
	public string $token;
	public int $experiment;  //bool
	public int $age;
 
    // costruttore
    public function __construct($db)
	{
        $this->conn = $db;
        $this->sex = 0;
        $this->salt = "";
        $this->mail="";
        $this->password="";
        $this->verified=0;
        $this->sexor=0;
        $this->token="";
        $this->experiment=0;
        $this->age = 18;
    }
	
	// controlla se la mail esiste già
	function emailExists()
	{
 
		$query = "SELECT id, sex, salt, mail, password,verified,sexor,token,experiment,age
            FROM USER
            WHERE mail = ?
            LIMIT 0,1";
		$stmt = $this->conn->prepare( $query );
		$this->mail=test_input($this->mail);
		$stmt->bindParam(1, $this->mail);
		$stmt->execute();
 
		$num = $stmt->rowCount();
 
		// se esiste, assegna il valore alla property
		if($num>0)
		{
 
			
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
 
		
			$this->id = $row['id'];
			$this->sex = $row['sex'];
			$this->age = $row['age'];
            $this->sexor = $row['sexor'];
            $this->mail = $row['mail'];
            $this->verified = $row['verified'];
            $this->token = $row['token'];
            $this->experiment = $row['experiment'];
			$this->password = $row['password'];
			$this->salt = $row['salt'];
 
		
			return true;
		}
 
		
		return false;
	}

	function create()
	{

		//$salt = $this->salt;

        $this->salt = random_bytes(10);
        $this->salt = bin2hex($this->salt);
		$this->mail=test_input($this->mail);
		$this->password=test_input($this->password);

		$this->password = pbkdf2('sha3-512' , $this->password,$this->salt,1000,100);
		  
		// var_dump($this);
		$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		//considerando che non sarà una query ripetuta in successione per ottimizzare si hexa concatenando invece di usare il prepared statement
        //TODO: sta dando problemi per ora

		 
		//$mail= bin2hex($this->mail);
        //$token= bin2hex($this->token);
		 var_dump($this->salt);var_dump($this->password);var_dump($this->mail);
		 
		$q = "INSERT INTO user VALUES(null,'$this->mail',$this->sex,$this->age,$this->sexor,'$this->password','$this->salt',$this->verified,'$this->token',$this->experiment);";
		// var_dump($q);
		$this->conn->query($q);
	 
		return true;
 
	}
	public function showError($stmt)
	{
		echo "<pre>";
        print_r($stmt->errorInfo());
		echo "</pre>";
	}

	
	// used in email verification feature
	function updateStatusByAccessCode()
	{
	
		$query = "UPDATE " . $this->table_name . "
				SET status = :status
				WHERE access_code = :access_code";
		$stmt = $this->conn->prepare($query);
		$this->status=test_input($this->status);
		$this->access_code=test_input($this->access_code);
		$stmt->bindParam(':status', $this->status);
		$stmt->bindParam(':access_code', $this->access_code);
	 
		if($stmt->execute())
		{
			return true;
		}
	 
		return false;
	}


	function updateAccessCode()
	{
		$query = "UPDATE
					" . $this->table_name . "
				SET
					access_code = :access_code
				WHERE
					email = :email";
	 
		
		$stmt = $this->conn->prepare($query);
	 
	   
		$this->access_code=test_input($this->access_code);
		$this->mail=test_input($this->email);
	 
		$stmt->bindParam(':access_code', $this->access_code);
		$stmt->bindParam(':email', $this->email);
	 
		if($stmt->execute())
		{
			return true;
		}
	 
		return false;
	}


	
	function accessCodeExists()
	{
 

		$query = "SELECT id
				FROM " . $this->table_name . "
				WHERE access_code = ?
				LIMIT 0,1";
	 
		
		$stmt = $this->conn->prepare( $query );
		$this->access_code=test_input($this->access_code);
		$stmt->bindParam(1, $this->access_code);
		$stmt->execute();
		$num = $stmt->rowCount();

		if($num>0){
			return true;
		}

		return false;
 
	}
	
	function updatePassword()
	{
 

		$query = "UPDATE " . $this->table_name . "
				SET password = :password
				WHERE access_code = :access_code";
	 

		$stmt = $this->conn->prepare($query);
	 
		$this->password=test_input($this->password);
		$this->access_code=test_input($this->access_code);
	 

		$password_hash = pbkdf2('sha3-512' , $this->password,$this->salt,1000,100);
		$stmt->bindParam(':password', $password_hash);
		$stmt->bindParam(':access_code', $this->access_code);
	 
		// execute the query
		if($stmt->execute()){
			return true;
		}
	 
		return false;
	}
	
	
}
