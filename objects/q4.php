<?php

//TODO:test, update una volta avuta la struttura finale del questionario

include_once "./config/Foes.php";
include_once "Q.php";

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

    function create(): bool
    {

        // var_dump($this);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $q = "INSERT INTO Q4 VALUES(:control1,
                      :Q1,
                      :Q2,
                      :Q3,
                      :Q4,
                      :Q5,
                      :Q6,
                      :Q7,
                      :Q8,
                      :Q9,
                      :Q10,
                      '$this->user_id')";

        // var_dump($q);
        $stmt = $this->conn->prepare($q);

        $stmt->bindParam(':control1',$this->control_questions[0]);
        $stmt->bindParam(':Q1', $this->questions[0]);
        $stmt->bindParam(':Q2', $this->questions[1]);
        $stmt->bindParam(':Q3', $this->questions[2]);
        $stmt->bindParam(':Q4', $this->questions[3]);
        $stmt->bindParam(':Q5', $this->questions[4]);
        $stmt->bindParam(':Q6', $this->questions[5]);
        $stmt->bindParam(':Q7', $this->questions[6]);
        $stmt->bindParam(':Q8', $this->questions[7]);
        $stmt->bindParam(':Q9', $this->questions[8]);
        $stmt->bindParam(':Q10', $this->questions[9]);

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