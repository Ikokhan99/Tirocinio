<?php

//TODO:test, update una volta avuta la struttura finale del questionario

include_once "./config/InputCheckFoo.php";

class Q3
{
    // database connection and table name
    public $conn;

    // object properties
    public int $user_id;
    public $questions; //3 is the default value, the questionnaire has 10 items
    public int $completed;


    // costruttore
    public function __construct($db,$user_id)
    {
        $this->conn = $db;
        $this->questions = array(3,3,3,3,3, 3,3,3,3,3); //3 is the default value, the questionnaire has 22 items
        $this->completed = 0;
        $this->user_id = $user_id;
    }

    function create($create_flag=true)
    {

        // var_dump($this);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if($create_flag)
        {
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
        }
        else{
            $q = "UPDATE Q2 SET QUESTION1 = $this->questions[0],
                            QUESTION2 = $this->questions[1],
                            QUESTION3 = $this->questions[2],
                            QUESTION4 = $this->questions[3],
                            QUESTION5 = $this->questions[4],
                            QUESTION6 = $this->questions[5],
                            QUESTION7 = $this->questions[6],
                            QUESTION8 = $this->questions[7],
                            QUESTION9 = $this->questions[8],
                            QUESTION10 = $this->questions[9],
                            QUESTION11 = $this->questions[10],
                            completed = $this->completed,
                            user_id=:uid";
        }

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

    function get($id)
    {
        $query = "SELECT * FROM Q2 WHERE user_id = ?";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
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
