<?php
include_once "./config/Foes.php";
include_once "Q.php";
//TODO:test


class Q2 extends Q
{


    // object properties
    public int $playtime;
    public ?GAME $game1;
    public ?GAME $game2;
    public array $gens;

    public function __construct($db,$user_id)
    {
        $this->conn = $db;
        $this->user_id = $user_id;
        $this->playtime = 0;
        $this->game1 = new GAME($this->conn);
        $this->game2 = new GAME($this->conn);
        $this->gens = [];

    }

    public function create(): bool
    {

        // var_dump($this);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $this->game1->create();
        if(!is_null($this->game2)) {
            $this->game2->create();
        }

        $gens = "";
        foreach ($this->gens as $key => $gen)
        {
            if($key !== 0) {
                $gens .= ",";
            }
            $gens.=$gen;
        }

        $q = "INSERT INTO Q2 VALUES(
                        :playtime,
                      '$gens',
                      ".$this->game1->id.",
                      ".(!is_null($this->game2) ? $this->game2->id:-1).",
                      '$this->user_id');";

        $stmt = $this->conn->prepare($q);

        $stmt->bindParam(':playtime', $this->playtime);

        if(debug){
            var_dump($stmt);
        }

        if($stmt->execute())
        {
            return true;
        }

        $this->showError($stmt);
        return false;
    }
}

class GAME implements Interfaces {
    public PDO $conn;

    public int $id;
    public string $title;
    public int $sexism;  // Should be between 0 and 5
    public int $violence;  // Should be between 0 and 5
    public int $realism1;  // Should be between 0 and 5
    public int $realism2;

    public function __construct($db)
    {
        $this->conn = $db;
        $this->title = "";
        $this->sexism = 0;
        $this->violence = 0;
        $this->realism1 = 0;
        $this->realism2 = 0;
    }

    public function create(): bool
    {

        // var_dump($this);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $q = "INSERT INTO GAME VALUES(
                      NULL,
                      :title,
                      :sexism,
                      :violence,
                      :realism1,
                      :realism2);";

        $stmt = $this->conn->prepare($q);

        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':sexism', $this->sexism);
        $stmt->bindParam(':violence', $this->violence);
        $stmt->bindParam(':realism1', $this->realism1);
        $stmt->bindParam(':realism2', $this->realism2);

        if(debug){
            var_dump($stmt);
        }

        if($stmt->execute())
        {
            $this->id=$this->conn->lastInsertId();
            return true;
        }

        $this->showError($stmt);
        return false;
    }



    public function showError($stmt) :void
    {
        echo "<pre>";
        print_r($stmt->errorInfo());
        echo "</pre>";
    }

}