<?php

//TODO:test, update una volta avuta la struttura finale del questionario

include_once "./config/InputCheckFoo.php";

class Q4 extends Q
{
    // costruttore
    public function __construct($db,$user_id)
    {
        $this->conn = $db;
        $this->questions = array(3,3,3,3,3, 3,3,3,3,3); //3 is the default value, the questionnaire has 10 items
        $this->user_id = $user_id;
    }

    function create()
    {

        // var_dump($this);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $q = "INSERT INTO Q1 VALUES($this->questions[0],
                      $this->questions[1],
                      $this->questions[2],
                      $this->questions[3],
                      $this->questions[4],
                      $this->questions[5],
                      $this->questions[6],
                      $this->questions[7],
                      $this->questions[8],
                      $this->questions[9],
                      $this->questions[10],
                      $this->completed,:uid);";

        // var_dump($q);
        $stmt = $this->conn->prepare($q);

        $stmt->bindParam(':uid', $this->user_id);

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
