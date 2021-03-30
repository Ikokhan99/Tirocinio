<?php

include_once "./config/Foes.php";
include_once "Q.php";

class Q3 extends Q
{
    private const CONTROL_1_CORRECT = 5;
    private const CONTROL_2_CORRECT = 1;
 
    // constructor
    public function __construct($db,$user_id)
	{
	    $this->control_questions = array(3,3); //more than 10 items, so two control questions
        $this->conn = $db;
        $this->questions = array(3,3,3,3,3, 3,3,3,3,3, 3,3,3,3,3, 3,3,3,3,3, 3,3); //3 is the default value, the questionnaire has 22 items
        $this->user_id = $user_id;
    }
	
	public function create(): bool
    {

		// var_dump($this);
		$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $q = "INSERT INTO Q3 VALUES(
                      :controlA,
                      :controlB,
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
                      :Q11,
                      :Q12,
                      :Q13,
                      :Q14,
                      :Q15,
                      :Q16,
                      :Q17,
                      :Q18,
                      :Q19,
                      :Q20,
                      :Q21,
                      :Q22,
                      '$this->user_id');";

        // var_dump($q);
        $stmt = $this->conn->prepare($q);

        $stmt->bindParam(':controlA',$this->control_questions[0]);
        $stmt->bindParam(':controlB',$this->control_questions[1]);
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
        $stmt->bindParam(':Q11', $this->questions[10]);
        $stmt->bindParam(':Q12', $this->questions[11]);
        $stmt->bindParam(':Q13', $this->questions[12]);
        $stmt->bindParam(':Q14', $this->questions[13]);
        $stmt->bindParam(':Q15', $this->questions[14]);
        $stmt->bindParam(':Q16', $this->questions[15]);
        $stmt->bindParam(':Q17', $this->questions[16]);
        $stmt->bindParam(':Q18', $this->questions[17]);
        $stmt->bindParam(':Q19', $this->questions[18]);
        $stmt->bindParam(':Q20', $this->questions[19]);
        $stmt->bindParam(':Q21', $this->questions[20]);
        $stmt->bindParam(':Q22', $this->questions[21]);


		// var_dump($q);

        if(debug){
            var_dump($stmt);
        }
        if($stmt->execute())
        {
            if(($this->control_questions[0] !== self::CONTROL_1_CORRECT) || ($this->control_questions[1] !== self::CONTROL_2_CORRECT))
            {
                $q = "UPDATE user SET trusted = 1 where id='".$_SESSION['user-id']."';";
                $stmt = $this->conn->query($q);
            }
            return true;
        }

        $this->showError($stmt);
        return false;

    }
}
