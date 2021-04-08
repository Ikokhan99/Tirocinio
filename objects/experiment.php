<?php


class Experiment
{
    // database connection and table name
    public $conn;
    //object properties
    public $entry;
    public $type; //0 = male, 1= female, 3=mix
    public $time; //rt
    public $chosen; //id of chosen avatar
    public $uid; //user id
    public $other; //other avatar id
    public $key;

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

    public function create(): bool
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

        $this->showError($stmt);
        return false;

    }

    public function showError($stmt):void
    {
        echo "<pre>";
        print_r($stmt->errorInfo());
        echo "</pre>";
    }

}