<?php
include_once "./config/Foes.php";
include_once "Q.php";
//TODO:test

class Q2 extends Q
{

    // object properties
    public int $playtime;
    public string $game1;
    public string $game2;
    public int $sexism1;  // Should be between 0 and 5
    public int $sexism2;
    public int $violence1;  // Should be between 0 and 5
    public int $violence2;
    public int $realism11;  // Should be between 0 and 5
    public int $realism12;
    public int $realism21;  // Should be between 0 and 5
    public int $realism22;
    public array $gens;

    public function __construct($db,$user_id)
    {
        $this->conn = $db;
        $this->user_id = $user_id;
        $this->playtime = 0;
        $this->game1 = "";
        $this->game2 = "";
        $this->sexism1 = 0;
        $this->sexism2 = 0;
        $this->violence1 = 0;
        $this->violence2 = 0;
        $this->realism11 = 0;
        $this->realism12 = 0;
        $this-> realism21 = 0;
        $this->realism22 = 0;
        $this->gens = [];

    }

    function create(): bool
    {

        // var_dump($this);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $gens = $this->gens[0].$this->gens[1].$this->gens[2];

        $q = "INSERT INTO Q2 VALUES(:playtime,
                      '$gens',
                      '$this->game1',
                      '$this->game2',
                      :sexism1,
                      :sexism2,
                      :violence1,
                      :violence2,
                      :realism11,
                      :realism12,
                      :realism21,
                      :realism22,
                      '$this->user_id');";

//I can't get where it's wrong

        $stmt = $this->conn->prepare($q);

        $stmt->bindParam(':playtime', $this->playtime);
        $stmt->bindParam(':sexism1', $this->sexism1);
        $stmt->bindParam(':sexism2', $this->sexism2);
        $stmt->bindParam(':violence1', $this->violence1);
        $stmt->bindParam(':violence2', $this->violence2);
        $stmt->bindParam(':realism11', $this->realism11);
        $stmt->bindParam(':realism12', $this->realism12);
        $stmt->bindParam(':realism21', $this->realism21);
        $stmt->bindParam(':realism22', $this->realism22);

        if(debug){
            var_dump($stmt);
        }

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