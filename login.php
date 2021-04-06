<?php
    var_dump(§_POST);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Login</title>
</head>
<body>
    <main>
        <div class="mb-3">
            <form action="login.php" action="" method="post">
                <a class="a-logo" href="#"><img id="logo" src="images/logo-02.svg" alt="logo-legato"></a>
                <input type="text" class="f-text" placeholder="email" name="email">
                <input type="text" class="f-text" placeholder="password" name="password">
                <input type="submit" name="btn-signin" id="btn-signin" class="f-m-btn" value="Sign In">
            </form>
        </div>
    </main>
    <?php include_once(__DIR__."/inc/footer.inc.php") ?>
</body>
</html>