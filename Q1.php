<?php
// core configuration
include_once "config/core.php";
//include_once 'config/database.php';
include_once 'objects/user.php';

if(isset($_GET['action']) && $_GET['action'] === 'goto')
{
    $_SESSION['at'] += 1;
    switch ($_SESSION['Q'][$_SESSION['at']]){
        case 2: default:{
            header("Location: ".home_url."Q2.php");
            break;
        }
        case 3:{
            header("Location: ".home_url."Q3.php");
            break;
        }
        case 4:{
            header("Location: ".home_url."Q4.php");
            break;
        }
        case 5:{
            header("Location: ".home_url."Q5.php");
            break;
        }
    }
}

$_SESSION['at'] = 0;
//insert data

if (isset($_POST)) {
    $_SESSION['at'] += 1;
    if(!fast_debug) {
        $user = new User($_SESSION['db']);
        $user->trusted = 1;
        $user->sexor = $_POST['user-sexor'];
        $user->sex = $_POST['user-sex'];
        $user->age = $_POST['user-age'];
        if ($_SESSION['Q_ORDERED'])
            $user->q_order = 0;
        else
            $user->q_order = 1;
        if (!$user->create()) {
            $user->showError();
            die();
        }
    }
}



//TODO:redirect a questionari

// page title
$page_title = "User General info";
include_once "layout_head.php";

?>
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-12">
                            <a href="#" class="active" id="user-info">TODO: decidere cosa scrivere qui</a>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form name="user-form" method="post" action="Q1.php" id="user-form" role="form" style="display: block;">
                                <!-- TODO: range di età o età in numero?
                                <div class="form-group">
                                    <input type="number" id="age" size="6" name="Register_age" min="6" max="99" value="21" required="required" tabindex="3" class="form-control">
                                </div>-->
                                <div class="form-group">
                                <table>
                                    <thead>
                                    <tr>
                                        <th>
                                            <label for="user-age" class="required"><span class="label-text">Age:</span>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                            <input type="radio" required="required" name="user-age" value="0" id = "no" tabindex="1">
                                            <label for="no">
                                                I don't want to specify my age
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="radio" required="required" name="user-age" value="1" id = "less14" tabindex="2">
                                            <label for="less14">
                                                Less than 14
                                            </label>
                                        </td>
                                    </tr><tr>
                                        <td>
                                            <input type="radio" required="required" name="user-age" value="2" id = "1419" tabindex="3">
                                            <label for="1419">
                                                Between 14 and 19
                                            </label>
                                        </td>
                                    </tr><tr>
                                        <td>
                                            <input type="radio" required="required" name="user-age" value="3" id = "2029" tabindex="4">
                                            <label for="2029">
                                                Between 20 and 29
                                            </label>
                                        </td>
                                    </tr><tr>
                                        <td>
                                            <input type="radio" required="required" name="user-age" value="4" id = "3039" tabindex="5">
                                            <label for="3039">
                                                Between 30 and 39
                                            </label>
                                        </td>
                                    </tr><tr>
                                        <td>
                                            <input type="radio" required="required" name="user-age" value="5" id = "4049" tabindex="6">
                                            <label for="4049">
                                                Between 40 and 49
                                            </label>
                                        </td>
                                    </tr><tr>
                                        <td>
                                            <input type="radio" required="required" name="user-age" value="6" id = "5059" tabindex="7">
                                            <label for="5059">
                                                Between 50 and 59
                                            </label>
                                        </td>
                                    </tr><tr>
                                        <td>
                                            <input type="radio" required="required" name="user-age" value="7" id = "6069" tabindex="8">
                                            <label for="6069">
                                                Between 60 and 69
                                            </label>
                                        </td>
                                    </tr><tr>
                                        <td>
                                            <input type="radio" required="required" name="user-age" value="8" id = "7079" tabindex="9">
                                            <label for="7079">
                                                Between 70 and 79
                                            </label>
                                        </td>
                                    </tr><tr>
                                        <td>
                                            <input type="radio" required="required" name="user-age" value="9" id = "plus79" tabindex="10">
                                            <label for="plus79">
                                                More than 79
                                            </label>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
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
                                                        <input type="radio"  required="required"  name="user-sex" value="0" id = "female" tabindex="4">
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
                                            <input type="submit" name="action" id="toQ" tabindex="6" class="form-control btn btn-send" value="toQ">
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
