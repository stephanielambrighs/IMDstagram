<?php
    require_once("autoload.php");
    session_start();

    $key = $_GET['v'];
    //var_dump($key);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $key; ?></title>
</head>
<body>
    <h1><?php echo $key; ?></h1>
</body>
</html>