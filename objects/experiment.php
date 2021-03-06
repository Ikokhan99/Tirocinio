<?php

include_once "Interfaces.php";
class Experiment implements Interfaces
{
    // database connection and table name
    public $conn;
    //object properties
    public int $entry;
    public int $type; //0 = male, 1= female, 3=mix
    public float $time; //rt
    public int $chosen; //id of chosen avatar
    public string $uid; //user id
    public int $other; //other avatar id
    public int $key;

    public function __construct($db,$user_id)
    {
        $this->conn = $db;
        $this->entry = 0;
        $this->type = 1;
        $this->uid = $user_id;
        $this->time=0;
        $this->chosen = 0;
        $this->other = 0;
        $this->key = 0;
    }

    function create(): bool
    {

        // var_dump($this);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $q = "INSERT INTO choice VALUES(null,:entry,:type,:time,:chosen,".$this->key.",:uid,:a1);";


        // var_dump($q);
        $stmt = $this->conn->prepare($q);

        $stmt->bindParam(':entry', $this->entry);
        $stmt->bindParam(':type', $this->type);
        $stmt->bindParam(':time', $this->time);
        $stmt->bindParam(':chosen', $this->chosen);
        //$stmt->bindParam(':key', $this->key);
        $stmt->bindParam(':uid', $this->uid);
        $stmt->bindParam(':a1', $this->other);


        if($stmt->execute())
        {
            return true;
        }
        else
        {
            $this->showError($stmt);
            return false;
        }

    }

    function get($id,$entry)
    {
        $query = "SELECT * FROM choice WHERE user_id = ? AND entry = ?";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->bindParam(2, $entry, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt;
    }

    public function showError($stmt)
    {
        echo "<pre>";
        print_r($stmt->errorInfo());
        echo "</pre>";
    }

}