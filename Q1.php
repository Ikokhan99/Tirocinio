<?php
// core configuration
include_once "config/core.php";
include_once 'objects/user.php';
include_once 'config/Foes.php';


if (!empty($_POST)) {
    if(!fast_debug) {
        $_SESSION['token'] = $_SESSION['user-id'];
        include_once 'config/database.php';
        $database = new Database();
        $db = $database->getConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $user = new User($db);
        $user->sexor = check_int($_POST['user-sexor'],0,4);
        $user->sex = check_int($_POST['user-sex'],0,1);
        $user->age = check_int($_POST['user-age'],18,70);
        //todo:controlli
        $user->create($_POST['user-id']);

        if (!$user->create()) {
            $user->showError();
            die();
        }
    }
}

//TODO: redirect in ordine
if((isset($_POST['action']) && $_POST['action'] === 'Continue') || (!empty($_GET) && $_GET['action']=='goto'))
{

    switch ($_SESSION['Q'][$_SESSION['at']]){
        case 2:{
        $_SESSION['at'] += 1;
            header("Location: ".home_url."Q2.php");
            break;
        }
        case 3:{
            $_SESSION['at'] += 1;
            header("Location: ".home_url."Q3.php");
            break;
        }
        case 4:{
            $_SESSION['at'] += 1;
            header("Location: ".home_url."Q4.php");
            break;
        }
        case 5:{
            $_SESSION['at'] += 1;
            header("Location: ".home_url."Q5.php");
            break;
        }
        case 6:default:{
            $_SESSION['at'] += 1;
            header("Location: ".home_url."last.php");
            break;
        }
    }
}


if(debug)
{
    echo "<p> DEBUG: ";
    print_r($_SESSION['at']);
    echo "</p>";
    echo "<p> DEBUG: ";
    var_dump($_POST['action'] === 'Continue');
    echo "</p>";
    echo "<p> DEBUG: ";
    var_dump(isset($_POST['action'])  );
    echo "</p>";
    echo "<p> DEBUG: ";
    var_dump(isset($_POST['action']) && $_POST['action'] === 'Continue');
    echo "</p>";
    echo "<p> DEBUG: ";
    var_dump(!empty($_POST));
    echo "</p>";
    echo "<p> DEBUG: ";
    print_r($_POST['action']);
    echo "</p>";
}

//TODO:controlli input

// page title
$page_title = "Survey";
include_once "layout_head.php";

?>
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-12">
                            Thank you for completing this experiment, now we kindly ask you to conclude this experience by filling out our questionnaire
                        </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form name="user-form" method="post" action="Q1.php" id="user-form" role="form" style="display: block;">
                                <!-- TODO: Campione: età precisa, solo maggiorenni, solo etero, lasciare lo stesso le domande -->
                                <div class="form-group">
                                    <label for="prolific">Prolific Id</label><input id="prolific" size="25" name="user-id"  required="required" tabindex="1" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="age">Age</label><input type="number" id="age" size="6" name="user-age" min="6" max="99" value="21" required="required" tabindex="3" class="form-control">
                                </div>
                                <div class="form-group">
                                    <div style="overflow-x:auto; align-items: flex-start">
                                            <table>
                                                <thead>
                                                <tr>
                                                    <th>
                                                        <label for="user-sex" class="required"><span class="label-text">Biological sex:</span>
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>
                                                        <input type="radio" required="required" name="user-sex" value="0" id = "male" tabindex="4">
                                                        <label for="male">
                                                           Male
                                                        </label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <input type="radio"  required="required"  name="user-sex" value="1" id = "female" tabindex="4">
                                                        <label for="female">
                                                            Female
                                                        </label>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                </div>
                                <!-- TODO:fix css -->
                                <div class="form-group">
                                    <div style="overflow-x:auto; align-items: flex-start">
                                        <table>
                                            <thead>
                                            <tr>
                                                <th>
                                                    <label for="user-sexor" class="required"><span class="label-text">Sexual orientation:</span>
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <input type="radio" required="required" name="user-sexor" value="0" id = "no" tabindex="5">
                                                    <label for="no">
                                                        I don't want to specify my sexual orientation
                                                    </label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="radio"  required="required" name="user-sexor" value="1" id = "heterosexual" tabindex="5">
                                                    <label for="heterosexual">
                                                        Heterosexual
                                                    </label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="radio"  required="required" name="user-sexor" value="2" id = "homosexual" tabindex="5">
                                                    <label for="homosexual">
                                                        Homosexual
                                                    </label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="radio" required="required" name="user-sexor" value="3" id = "bisexual" tabindex="5">
                                                    <label for="bisexual">
                                                        Bisexual
                                                    </label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="radio" required="required" name="user-sexor" value="4" id = "other" tabindex="5">
                                                    <label for="other">
                                                        Other
                                                    </label>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <input type="submit" name="action" id="toQ" tabindex="6" class="form-control btn btn-send" value="Continue">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<style>
    /*TODO: fix*/
    body {
        padding-top: 90px;
    }
    .panel-login>.panel-heading a{
        text-decoration: none;
        color: #666;
        font-weight: bold;
        font-size: 15px;
        -webkit-transition: all 0.1s linear;
        -moz-transition: all 0.1s linear;
        transition: all 0.1s linear;
    }
    .panel-login>.panel-heading hr{
        margin-top: 10px;
        margin-bottom: 0;
        clear: both;
        border: 0;
        height: 1px;
        background-image: -webkit-linear-gradient(left,rgba(0, 0, 0, 0),rgba(0, 0, 0, 0.15),rgba(0, 0, 0, 0));
        background-image: -moz-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,0.15),rgba(0,0,0,0));
        background-image: -ms-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,0.15),rgba(0,0,0,0));
        background-image: -o-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,0.15),rgba(0,0,0,0));
    }
    .panel-login input[type="text"],.panel-login input[type="email"],.panel-login input[type="password"] {
        height: 45px;
        border: 1px solid #ddd;
        font-size: 16px;
        -webkit-transition: all 0.1s linear;
        -moz-transition: all 0.1s linear;
        transition: all 0.1s linear;
    }
    .panel-login input:hover,
    .panel-login input:focus {
        outline:none;
        -webkit-box-shadow: none;
        -moz-box-shadow: none;
        box-shadow: none;
        border-color: #ccc;
    }

    .btn-send {
        background-color: #1CB94E;
        outline: none;
        color: #fff;
        font-size: 14px;
        height: auto;
        font-weight: normal;
        padding: 14px 0;
        text-transform: uppercase;
        border-color: #1CB94A;
    }
    .btn-send:hover,
    .btn-send:focus {
        color: #fff;
        background-color: #1CA347;
        border-color: #1CA347;
    }
</style>

<?php
		
// footer HTML and JavaScript codes
include_once "layout_foot.php";
