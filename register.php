<?php




?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php include_once(__DIR__ . "/inc/links.inc.php") ?>

    <title>Register</title>
</head>
<body>
    <main>
        <form id="f-register" action="" method="POST">
            <select name="language" id="s-language">
                <option value="English (United States)" name="1">English (United States)</option>
                <option value="Dutch (Belgium)" name="2">Dutch (Belgium)</option>
            </select>
            <a class="a-logo" href="#"><img id="logo" src="images/logo-02.svg" alt="logo-legato"></a>
            <input type="text" class="f-text" placeholder="email">
            <input type="text" class="f-text" placeholder="username">
            <input type="text" class="f-text" placeholder="password">
            <input type="text" class="f-text" placeholder="confirm password">
            <input type="submit" name="btn-signup" id="btn-signup" class="f-m-btn" value="Sign Up">
            <p class="p-msg">Having trouble creating an account? <span><a href="#">Get help.</a></span></p>
            <hr>
            <p class="p-msg">Copyright ©2021 - Legato</p>
        </form>
    </main>
    <?php  include_once(__DIR__ . "/inc/footer.inc.php") ?>
</body>
</html>