<?php
include_once "./config/Foes.php";
include_once "Q.php";

class q5 extends Q
{

/*'physical coordination',
'health',
'weight',
'strength',
'sex appeal',
'physical attractiveness'
'energy level',
'sculpted muscles',
'physical fitness',
'measurements',*/

    public function __construct($db,$user_id)
    {
        $this->conn = $db;
        $this->questions = array(1,2,3,4,5,6,7,8,9,10); //the questionnaire has 10 items
        $this->user_id = $user_id;
    }

    public function create(): bool
    {

        // var_dump($this);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $q = "INSERT INTO Q5 VALUES(
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

        // var_dump($q);


        if($stmt->execute())
        {
            return true;
        }

        $this->showError($stmt);
        return false;

    }
}