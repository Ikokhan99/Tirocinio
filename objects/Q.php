<?php


abstract class Q
{
    // database connection and table name
    public $conn;

    // object properties
    public string $user_id;
    public array $questions;
    public string $table_name;
    public array $control_questions;
    //public int $q_order; //bool

    function get()
    {
        $query = "SELECT * FROM".$this->table_name."WHERE user_id = ?";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->user_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt;
    }
    public function showError($stmt)
    {
        echo "<pre>";
        print_r($stmt->errorInfo());
        echo "</pre>";
    }
    public abstract function create();
}