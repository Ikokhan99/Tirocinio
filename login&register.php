<?php
// core configuration
include_once "config/core.php";
//include_once "login_checker.php";
include_once 'config/database.php';
include_once 'objects/user.php';

include_once "config/InputCheckFoo.php";

// page title
$page_title = "Login or Register";
include_once "layout_head.php";
// include il login checker
$require_login=false;
include_once "login_checker.php";
 
// default: false
$access_denied=false;

//messaggi vari
$action = isset($_GET['action']) ? $_GET['action'] : "";
if ($action == 'not_yet_logged_in') {
    echo "<div class='alert alert-danger margin-top-40' role='alert'>Please login.</div>";
} else if ($action == 'please_login') {
    echo "<div class='alert alert-info'>
        <strong>Please login to access that page.</strong>
    </div>";
} else if ($action == 'email_verified') {
    echo "<div class='alert alert-success'>
        <strong>Your email address have been validated.</strong>
    </div>";
} else if ($action == 'success') {
    echo "<div class='alert alert-success'>
        <strong>Your account has been created! Please log in</strong>
    </div>";
}
if (isset($_POST['action']) && $_POST['action'] == 'login') {
    include_once "login.php";
} else if (isset($_POST['action']) && $_POST['action'] == 'register') {
    include_once "register.php";
}


if ($access_denied) {
    echo "<div class='alert alert-danger margin-top-40' role='alert'>
        Access Denied.<br /><br />
        Your username or password may be incorrect
    </div>";
}


?>
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-login">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-6">
                            <a href="#" class="active" id="login-form-link">Login</a>
                        </div>
                        <div class="col-xs-6">
                            <a href="#" id="register-form-link">Register</a>
                        </div>
                    </div>
                    <hr>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">

                            <form name="login-form" method="post" action="login&register.php" id="login-form" role="form" style="display: block;">
                                <div class="form-group">
                                    <input type="text" id="login_form_name" name="Login_name" required="required" tabindex="1" pattern="([a-zA-Z0-9\-_]{3,29})|(.+@.+\..+)" data-pattern-mismatch-message="Please input a valid email address" class="validated-input form-control" placeholder="Email" value="">
                                </div>
                                <div class="form-group">
                                    <input type="password" id="login_form_password" name="Login_password" required="required" tabindex="2" class="validated-input form-control">
                                </div>
                                <!--
                                <div class="form-group">
                                    <input type="password" id="login_form_password" name="Login_password" required="required" tabindex="2" class="validated-input form-control">
                                </div> -->
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <input type="submit" name="action" id="action-l" tabindex="3" class="form-control btn btn-login" value="login">
                                        </div>
                                    </div>
                                </div>

                                <!--
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="text-center">
                                                <a href="" tabindex="5" class="forgot-password">Forgot Password?</a>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                            </form>
                            <form name="register-form" method="post" action="login&register.php" role="form" style="display: none;" id="register-form">
                                <div class="form-group">
                                    <input type="email" id="signup_with_profile_email" name="Register_email" required="required" tabindex="1" pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{1,}$" data-pattern-mismatch-message="Please use a valid email address." class="form-control" placeholder="Email" value="">
                                </div>
                                <div class="form-group">
                                    <input type="password" id="signup_with_profile_password" name="Register_password" required="required" tabindex="2" minlength=\"6\"  class="form-control" placeholder="Password" value="">
                                </div>
                                <!-- TODO: rage di età al posto di età in numero?-->
                                <div class="form-group">
                                    <input type="number" id="age" size="6" name="Register_age" min="6" max="99" value="21" required="required" tabindex="3" class="form-control">
                                </div>
                                <div class="form-group">
                                    <div class="form-group">
                                        <div style="overflow-x:auto; align-items: flex-start">
                                            <table>
                                                <thead>
                                                <tr>
                                                    <th>
                                                        <label for="Register_sex" class="required"><span class="label-text">Biological sex:</span>
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>
                                                        <input type="radio" required="required" name="Register_sex" value="0" id = "male" tabindex="4">
                                                        <label for="male">
                                                           Male
                                                        </label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <input type="radio"  required="required"  name="Register_sex" value="0" id = "female" tabindex="4">
                                                        <label for="female">
                                                            Female
                                                        </label>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- TODO:fix css -->
                                <div class="form-group">
                                    <div style="overflow-x:auto; align-items: flex-start">
                                        <table>
                                            <thead>
                                            <tr>
                                                <th>
                                                    <label for="Register_sexor" class="required"><span class="label-text">Sexual orientation:</span>
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <input type="radio" required="required" name="Register_sexor" value="0" id = "no" tabindex="5">
                                                    <label for="no">
                                                        I don't want to specify my sexual orientation
                                                    </label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="radio"  required="required" name="Register_sexor" value="1" id = "heterosexual" tabindex="5">
                                                    <label for="heterosexual">
                                                        Heterosexual
                                                    </label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="radio"  required="required" name="Register_sexor" value="2" id = "homosexual" tabindex="5">
                                                    <label for="homosexual">
                                                        Homosexual
                                                    </label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="radio" required="required" name="Register_sexor" value="3" id = "bisexual" tabindex="5">
                                                    <label for="bisexual">
                                                        Bisexual
                                                    </label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="radio" required="required" name="Register_sexor" value="4" id = "other" tabindex="5">
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
                                            <input type="submit" name="action" id="action-r" tabindex="6" class="form-control btn btn-register" value="register">
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


<script>
    $(function() {

        $('#login-form-link').click(function(e) {
            $("#login-form").delay(100).fadeIn(100);
            $("#register-form").fadeOut(100);
            $('#register-form-link').removeClass('active');
            $(this).addClass('active');
            e.preventDefault();
        });
        $('#register-form-link').click(function(e) {
            $("#register-form").delay(100).fadeIn(100);
            $("#login-form").fadeOut(100);
            $('#login-form-link').removeClass('active');
            $(this).addClass('active');
            e.preventDefault();
        });

    });
</script>

<style>
    body {
        padding-top: 90px;
    }
    .panel-login {
        border-color: #ccc;
        -webkit-box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.2);
        -moz-box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.2);
        box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.2);
    }
    .panel-login>.panel-heading {
        color: #00415d;
        background-color: #fff;
        border-color: #fff;
        text-align:center;
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
    .panel-login>.panel-heading a.active{
        color: #029f5b;
        font-size: 18px;
    }
    .panel-login>.panel-heading hr{
        margin-top: 10px;
        margin-bottom: 0px;
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
    .btn-login {
        background-color: #59B2E0;
        outline: none;
        color: #fff;
        font-size: 14px;
        height: auto;
        font-weight: normal;
        padding: 14px 0;
        text-transform: uppercase;
        border-color: #59B2E6;
    }
    .btn-login:hover,
    .btn-login:focus {
        color: #fff;
        background-color: #53A3CD;
        border-color: #53A3CD;
    }
    .forgot-password {
        text-decoration: underline;
        color: #888;
    }
    .forgot-password:hover,
    .forgot-password:focus {
        text-decoration: underline;
        color: #666;
    }

    .btn-register {
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
    .btn-register:hover,
    .btn-register:focus {
        color: #fff;
        background-color: #1CA347;
        border-color: #1CA347;
    }
</style>

<?php
		
// footer HTML and JavaScript codes
include_once "layout_foot.php";
