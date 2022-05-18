<?php
    session_start();
    unset($_SESSION["Name"]);
    unset($_SESSION["Password"]);
    header("Location:login.php");
?>