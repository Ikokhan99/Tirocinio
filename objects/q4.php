<?php

//TODO:test, update una volta avuta la struttura finale del questionario

include_once "./config/Foes.php";

class Q4 extends Q
{
    // costruttore
    public function __construct($db,$user_id)
    {
        $this->control_questions=array(3);
        $this->conn = $db;
        $this->questions = array(3,3,3,3,3, 3,3,3,3,3); //3 is the default value, the questionnaire has 10 items
        $this->user_id = $user_id;
    }

    function create()
    {

        // var_dump($this);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $q = "INSERT INTO Q1 VALUES($this->control_questions[0],
                      $this->questions[0],
                      $this->questions[1],
                      $this->questions[2],
                      $this->questions[3],
                      $this->questions[4],
                      $this->questions[5],
                      $this->questions[6],
                      $this->questions[7],
                      $this->questions[8],
                      $this->questions[9],
                      $this->q_order,
                      $this->user_id";

        // var_dump($q);
        $stmt = $this->conn->prepare($q);

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
