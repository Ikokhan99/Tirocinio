<?php

include_once "config/core.php";
include_once "layout_head.php";
echo "<table class='center'><tr><td>
        <table class='table80'>
        <tr><td>";
echo "
<h3 style='align-content: center'>You reached the end of the experiment, thanks for your participation!<br> You will be redirected to Prolific after <span id=\"countdown\">5</span> seconds</h3>
</td></tr></table></td></tr></table>";


include_once 'config/Database.php';
$database = new Database();
$db = $database->getConnection();
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$time = time() - $_SESSION['time'];
$q = "UPDATE user SET time = ".$time." where id= \"".$_SESSION['user-id']."\"; ";
$stmt = $db->prepare($q);
if(debug){
    var_dump($stmt);
    var_dump($_SESSION);
}
$stmt->execute();
?>

<!-- JavaScript part -->
<script type="text/javascript">
    // Total seconds to wait
    let seconds = 5;

    function countdown() {
        seconds = seconds - 1;
        if (seconds < 0) {
                window.location = "truelast.php";
        } else {
            // Update remaining seconds
            document.getElementById("countdown").innerHTML = seconds.toString();
            // Count down using javascript
            window.setTimeout("countdown()", 1000);
        }
    }

    // Run countdown function
    countdown();
    $(document).off("keydown", disableF5);
</script>
<?php
include_once "layout_foot.php";
