<?php

include_once "config/database.php";

$database = new Database();
$db = $database->getConnection();

//TODO:controlli

echo "
<div class='container'>
    <div class='row'>
        <div class=\"jumbotron\">
            <h1 class=\"display-4\">Experiment</h1>
            <p class=\"lead\">You haven't taken the experiment yet!</p>
            <hr class=\"my-4\">
            <p>Once taken, the questionnaires will be available</p>
            <p class=\"lead\">
                <a class=\"btn btn-primary btn-lg\" href=\"#\" role=\"button\">Let's go!</a>
            </p>
        </div>
    </div>";

echo "<div class='row'>";



 echo "<div class='col col-lg-4'>
            <div class=\"card\" style=\"width: 18rem;\">
                <img class=\"card-img-top\" src=\"$home_url\\img\\Q1.png\" height='180' width='286' alt=\"Card image cap\">
                <div class=\"card-body\">
                    <h5 class=\"card-title\">Questionnaire 1</h5>
                    <p class=\"card-text\">About games and their sexism</p>
                    <a href=\"#\" class=\"btn btn-primary\">Go somewhere</a>
                </div>
            </div>
       </div>";
echo "<div class='col col-lg-4'>
            <div class=\"card\" style=\"width: 18rem;\">
                <img class=\"card-img-top\" src=\"$home_url\\img\\Q2.png\" height='180' width='286' alt=\"Card image cap\">
                <div class=\"card-body\">
                    <h5 class=\"card-title\">Questionnaire 2</h5>
                    <p class=\"card-text\">Men, women and their relationships in contemporary society.</p>
                    <a href=\"#\" class=\"btn btn-primary\">Go somewhere</a>
                </div>
            </div>
      </div>";
echo "<div class='col col-lg-4'>
            <div class=\"card\" style=\"width: 18rem;\">
                <img class=\"card-img-top\" src=\"$home_url\\img\\Q3.png\" height='180' width='286' alt=\"Card image cap\">
                <div class=\"card-body\">
                    <h5 class=\"card-title\">Questionnaire 3</h5>
                    <p class=\"card-text\">About the relationship between men and women in society</p>
                    <a href=\"#\" class=\"btn btn-primary\">Go somewhere</a>
                </div>
            </div>
       </div>";

echo "</div>  <!-- row-->
</div><!-- container fluid-->";



/*
while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
	{
		$i++;
		//var_dump($stmt);
		//var_dump($row);
		extract($row);

		echo "<div class='col-md-$div'>";

			echo "<div class=\"container-flow-display\">";
				echo "<div class=\"container-flow-display-first-line\">";
				//echo "<a href='{$home_url}index.php?action=refresh&flow=$id'>Azienda $1</a>";
				echo /* "<div>" <button onclick=\"window.location.href='{$home_url}index.php?flow={$id}&action=refresh1'\">Azienda $i</button>";
				echo "<button onclick=\"window.location.href='{$home_url}index.php?flow={$id}&action=delete'\"> <i class='fas fa-trash-alt'></i></button></div>";
			//	echo "</div>";
				echo "<div class=\"container-flow-display-details\">";
				echo "<p>$nome</p>";
				echo "<p>$fondazione</p>";
			//	echo "<p></p>";
				echo "</div>";

			echo "</div>";
		echo "</div>";
		//echo "<a href='{$home_url}flow.php?flow={$id}&action=refresh' >{$nome} </a>";
		//var_dump($_SESSION['username']);

	}



echo "</div>";


echo "<div class=\"container-new-flow\">";
echo "<button onclick=\"window.location.href='{$home_url}index.php?action=create_flow'\">Crea azienda </button>";
echo "</div>";
echo "</div>";
//var_dump($_SESSION);
*/
?>
<style>
    .jumbotron {
        background-image: url(./img/exp.png);
        background-size: cover;
        height: 100%;}
</style>
