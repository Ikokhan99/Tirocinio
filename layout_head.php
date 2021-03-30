<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- set the page title-->
    <title><?php echo $page_title ?? "Unitn Experiment"; ?></title>

    <!-- Include ext. libs -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- CSS only -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- user custom CSS -->
  <link href="<?php echo home_url . "libs/CSS/style.css" ?>" rel="stylesheet" />

    <script>
        //screen.orientation.lock('landscape')
        function loadCSS(filename){

            let file = document.createElement("link");
            file.setAttribute("rel", "stylesheet");
            file.setAttribute("type", "text/css");
            file.setAttribute("href", filename);
            document.head.appendChild(file);

        }
        loadCSS("libs/CSS/style.css");

        //found on https://stackoverflow.com/questions/2482059/disable-f5-and-browser-refresh-using-javascript
        // slight update to account for browsers not supporting e.which
        function disableF5(e)
        {
            //82 for mac users
            if (((e.which ||e.key) === 116) || ((e.which || e.key) === 82))
            {
                e.preventDefault();
               //console.log(e)
            }

        }
        $(document).ready(function(){
            $(document).on("keydown", disableF5);
        });


        //prevent the user from going back
        //props to https://stackoverflow.com/a/12381873/11384956
        (function (global) {

            if(typeof (global) === "undefined") {
                throw new Error("window is undefined");
            }

            let _hash = "!";
            let noBackPlease = function () {
                global.location.href += "#";

                // Making sure we have the fruit available for juice (^__^)
                global.setTimeout(function () {
                    global.location.href += "!";
                }, 50);
            };
            global.onhashchange = function () {
                if (global.location.hash !== _hash) {
                    global.location.hash = _hash;
                }
            };
            global.onload = function () {
                noBackPlease();
            }
        })(window);


        /*jQuery >= 1.7 */
        //$(document).on("keydown", disableF5);


    </script>


    <?php

    //TODO
    if(debug){
        echo "<p>DEBUG:";
        var_dump($_SESSION['visited_pages']);
        echo"</p>";
    }

    if(user_error){
        if(isset($_SESSION['visited_pages']) && $_SESSION['visited_pages']['error']) {
            echo "<script>
                    location.replace('user_error.php?error=error');
              </script>";
        }
        /** @var string $page_index, defined in previous part of the page */
        if(isset($page_index) && $_SESSION['visited_pages'][$page_index]) {
            echo "<script>
                    location.replace('user_error.php?error=already_visited');
              </script>";
        }
        echo "<script>
                    if (String(window.performance.getEntriesByType(\"navigation\")[0].type) === \"back_forward\" || String(window.performance.getEntriesByType(\"navigation\")[0].type) === \"reload\") {
                        location.replace('user_error.php?error=navigation');
                    }
              </script>";
        }
    include_once 'config/Database.php';
    if(isset($page_title)&& ($page_title!=="Experiment" || $page_title!=="Survey" || $page_title !== "Start")){
        $database = new Database();
        $db = $database->getConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    ?>
</head>

<body>
