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
    <!-- CSS only -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- user custom CSS -->
  <link href="<?php echo home_url . "style.css" ?>" rel="stylesheet" />

    <script>
        screen.orientation.lock('landscape')
    </script>


    <?php

    //TODO
    if(debug){
        echo "<p>DEBUG:";
        var_dump($_SESSION['visited_pages']);
        echo"</p>";
    }

    if(user_error){
        if($_SESSION['visited_pages']['error']) {
            echo "<script>
                    location.replace('user_error.php');
              </script>";
        }
        /** @var string $page_index, defined in previous part of the page */
        if(isset($page_index) && $_SESSION['visited_pages'][$page_index]) {
            echo "<script>
                    location.replace('user_error.php');
              </script>";
        }
        echo "<script>
                    if (String(window.performance.getEntriesByType(\"navigation\")[0].type) === \"back_forward\" || String(window.performance.getEntriesByType(\"navigation\")[0].type) === \"reload\") {
                        location.replace('user_error.php');
                    }
              </script>";
        }
    include_once 'config/database.php';
    if(isset($page_title)&& ($page_title!="Experiment" || $page_title!="Survey" || $page_title != "Start")){
        $database = new Database();
        $db = $database->getConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    ?>
</head>

<body>
