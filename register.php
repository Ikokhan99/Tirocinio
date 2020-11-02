<?php

include_once "config/core.php";
$page_title = "Register";
include_once "login_checker.php";
include_once 'config/database.php';
include_once 'objects/user.php';
include_once "layout_head.php";
include_once "config/InputCheckFoo.php";

if($_POST)
{
 
  
    $database = new Database();
    $db = $database->getConnection();
 
    $user = new User($db);

    $user->mail=$_POST['Register_email'];

//TODO: controlli------------------------------------------------------------------------------
    if($user->emailExists())
	{
        echo "<div class='alert alert-danger'>";
            echo "This email is already registered with another account. Please, retry with another email or <a href='{$home_url}login'>login.</a>";
        echo "</div>";
    }
    else
	{
		$user->password=$_POST['Register_password'];
		$user->sex = $_POST['Register_sex'];
		$user->age = $_POST['Register_age'];
		$user->experiment = 0;
		$user->sexor = $_POST['Register_sexor'];
		//$user->access_level='user';
		//$user->status=0;
		// access code for email verification
		//$access_code=$utils->getToken();
		//$user->access_code=$access_code;
		// create the user
		if($user->create())
		{
			
			/*
			// send confimation email
			$send_to_email=$_POST['Register_email'];
			$body="Hi {$send_to_email}.<br /><br />";
			$body.="Please click the following link to verify your email and login: {$home_url}verify/?access_code={$access_code}";
			$subject="Verification Email";
		 
			if($utils->sendEmailViaPhpMail($send_to_email, $subject, $body)){
				echo "<div class='alert alert-success'>
					Verification link was sent to your email. Click that link to login.
				</div>";
			}
			else{
				echo "<div class='alert alert-danger'>
					User was created but unable to send verification email. Please contact admin.
				</div>";
			}
				*/
			// empty posted values
			$_POST=array();
			echo "<script> location.replace(\"login&register.php?action=success\"); </script>";
 
		}
		else
		{
			echo "<div class='alert alert-danger' role='alert'>Unable to register. Please try again.</div>";
		}
    }
}

