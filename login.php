<?php
    require_once("autoload.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Login</title>
</head>
<body>
<img src="./images/logo-02.svg" alt="Legato" class="logo">
<form class="form-feed" action="login.php" method="post">
    <div class="mb-3">
        <label for="exampleInputUsername1" class="form-label">Username</label>
        <input type="text" class="form-control" id="exampleInputUsername1" aria-describedby="usernameHelp" name="username">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
</body>
</html>