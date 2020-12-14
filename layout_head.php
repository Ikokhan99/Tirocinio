<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- set the page title-->
    <title><?php echo isset($page_title) ? strip_tags($page_title) : "Unitn Experiment"; ?></title>

    <!-- Include ext. libs -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>


    <!-- user custom CSS -->
  <link href="<?php echo home_url . "style.css" ?>" rel="stylesheet" />
    <?php

    //TODO

    if(user_error){
        echo "<script>
                    if (String(window.performance.getEntriesByType(\"navigation\")[0].type) === \"back_forward\" || String(window.performance.getEntriesByType(\"navigation\")[0].type) === \"reload\") {
                        location.replace('user_error.php');
                    }
              </script>";
        }
    include_once 'config/database.php';
    if(isset($page_title)&& ($page_title!="Experiment" || $page_title!="Survey")){
        $database = new Database();
        $db = $database->getConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    ?>
</head>

<body>
