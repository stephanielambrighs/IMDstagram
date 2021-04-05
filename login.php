<?php
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/bootstrap.css">
    <title>Login</title>
</head>
<body>
    <main>
        <form action="f-login" action="" method="">
            <a class="a-logo" href="#"><img id="logo" src="images/logo-02.svg" alt="logo-legato"></a>
            <input type="text" class="f-text" placeholder="email" name="email">
            <input type="text" class="f-text" placeholder="password" name="password">
            <input type="submit" name="btn-signin" id="btn-signin" class="f-m-btn" value="Sign In">
        </form>
    </main>
    <?php include_once(__DIR__."/inc/footer.inc.php") ?>
</body>
</html>