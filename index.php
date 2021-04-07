<?php
    session_start();
    if(isset($_SESSION["username"])){
        echo "Welcome ".$_SESSION["username"];
    }else{
        header("Location: login.php");
    }


?><!DOCTYPE html>
<!-- LEGATO INDEX (FEED) -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Legato</title>
</head>
<body>
    <a href="logout.php">Log out?</a>
</body>
</html>