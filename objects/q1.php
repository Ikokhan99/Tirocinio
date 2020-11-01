<?php
include_once "./config/InputCheckFoo.php";

//TODO:test

class Q1
{

    public $conn;

    // object properties
    public int $id;
    public int $playtime;
    public string $game1;
    public string $game2;
    public int $sexism1;  // Should be between 1 and 5
    public int $sexism2;
    public int $completed;
    public int $user_id;

    public function __construct($db,$user_id)
    {
        $this->conn = $db;
        $this->user_id = $user_id;
        $this->playtime = 0;
        $this->game1="";
        $this->game2 = "";
        $this->sexism1 = 0;
        $this->sexism2=0;
        $this->completed=0;
    }

    function update($flag_create=true)
    {

        // var_dump($this);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if($flag_create)
        {
            $q = "INSERT INTO Q1 VALUES(:playtime,:game1,:game2,:sexism1,:sexism2,:completed,:userID);";
        }
        else{
            $q = "UPDATE Q1 SET playtime=:playtime,game1=:game1,game2=:game2,sexism1=:sexism1,completed=:completed WHERE user_id = :userID";
        }

        $stmt = $this->conn->prepare($q);

        $stmt->bindParam(':playtime', $this->playtime);
        $stmt->bindParam(':game1', $this->game1);
        $stmt->bindParam(':game2', $this->game2);
        $stmt->bindParam(':sexism1', $this->sexism1);
        $stmt->bindParam(':sexism2', $this->sexism2);
        $stmt->bindParam(':completed', $this->completed);
        $stmt->bindParam(':userID', $this->user_id);

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

    public function showError($stmt)
    {
        echo "<pre>";
        print_r($stmt->errorInfo());
        echo "</pre>";
    }

}