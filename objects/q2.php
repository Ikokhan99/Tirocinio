<?php
include_once "./config/Foes.php";

//TODO:test

class Q2 extends Q
{

    // object properties
    public int $playtime;
    public string $game1;
    public string $game2;
    public int $sexism1;  // Should be between 1 and 5
    public int $sexism2;

    public function __construct($db,$user_id)
    {
        $this->conn = $db;
        $this->user_id = $user_id;
        $this->playtime = 0;
        $this->game1="";
        $this->game2 = "";
        $this->sexism1 = 0;
        $this->sexism2=0;
    }

    function create()
    {

        // var_dump($this);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


        $q = "INSERT INTO Q1 VALUES(:playtime,:game1,:game2,:sexism1,:sexism2,:completed,:userID);";



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

}