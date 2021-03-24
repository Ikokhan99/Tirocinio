<?php
include_once "Interfaces.php";

abstract class Q implements Interfaces
{
    // database connection and table name
    public $conn;

    // object properties
    public string $user_id;
    public array $questions;
    public string $table_name;
    public array $control_questions;
    //public int $q_order; //bool

    public function get()
    {
        $query = "SELECT * FROM".$this->table_name."WHERE user_id = ?";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->user_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt;
    }
    public function showError($stmt):void
    {
        echo "<pre>";
        print_r($stmt->errorInfo());
        echo "</pre>";
    }
    abstract public function create();
}