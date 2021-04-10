<?php
    include_once("./autoload.php");

    if(!empty($_POST)){
        $username = $_POST["username"];
        $password = password_hash($_POST["password"], PASSWORD_BCRYPT);

        if (login($username, $password)){
            session_start();
            $_SESSION["username"] = $username;
            header("Location: index.php");;
        }else{
            $error = true;
        }
    }
    
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <title>Login</title>
</head>
<body>
    <main>
        <div class="mb-3">
        <a href="logout.php">Log out?</a>
            <form class="form" action="login.php" method="post">
                <a class="a-logo" href="#"><img id="logo" src="images/logo-02.svg" alt="logo-legato"></a>
                <?php if(isset($error)): ?>
                <div class="error">The username or password is incorrect. Please try again.</div>
                <?php endif; ?>
                <input type="text" class="f-text" placeholder="username" name="username">
                <input type="text" class="f-text" placeholder="password" name="password">
                <input type="submit" name="btn-signin" id="btn-signin" class="f-m-btn" value="Sign In">
            </form>
        </div>
    </main>
    <?php include_once(__DIR__."/inc/footer.inc.php") ?>
</body>
</html>