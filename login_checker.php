<?php

if(isset($require_login) && $require_login==true)
{
    if(!$_SESSION['logged_in'])
    {
        header("Location: {$home_url}login&register.php?action=please_login");
    }

}
// se si entra nella pagina di login già loggati ridireziona a index.php
else if(isset($page_title) && ($page_title=="login&register"))
{
    header("Location: {$home_url}index.php");
}
