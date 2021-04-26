<?php

    include_once(__DIR__ . "/autoload.php");
    
    $user = new User();

    if (!empty($_POST)) {
        $user->setEmail($_POST['email']);
        $user->setUsername($_POST['username']);
        $user->setPassword($_POST['password']);
        $user->setFirstname($_POST['firstname']);
        $user->setLastname($_POST['lastname']);
        $user->setDateOfBirth($_POST['date_of_birth']);
        
        session_start();
        $_SESSION['legato-user'] = $user;
        //$_SESSION['email'] = $user->getEmail();
        
        $result = $user->register($user);
    }

    $emailError = $user->getEmailError();
    $passwordError = $user->getPasswordError();


?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php include_once(__DIR__ . "/inc/links.inc.php") ?>

    <title>Legato - Register</title>
</head>
<body id="r-body">
    <main id="r-main">
        <form method="POST" id="r-register" enctype="multipart/form-data">
            <select class="form-control form-control-sm" name="language" id="s-language">
                <option value="English (United States)" name="1">English (United States)</option>
                <option value="Dutch (Belgium)" name="2">Dutch (Belgium)</option>
            </select>
            <div class="form-item">
                <a href="#"><img id="logo" src="images/logo-02.svg" alt="Legato logo"></a>
            </div>
            <div class="form-group">
                <!--<label style="visiffbility: hidden;" for="exampleInputEmail1">Email address</label>-->
                <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="email">
            </div>
            <?php if (isset($emailError)): ?>
                <div class="error alert alert-danger" role="alert">
                    <?php echo $emailError; ?>
                </div>
            <?php endif; ?>
            <div class="form-group">
                <!--<label style="visibility: hidden;" for="exampleInputEmail1">Email address</label>-->
                <input type="text" class="form-control" name="firstname" aria-describedby="emailHelp" placeholder="firstname">
            </div>
            <div class="form-group">
                <!--<label style="visibility: hidden;" for="exampleInputEmail1">Email address</label>-->
                <input type="text" class="form-control" name="lastname" aria-describedby="emailHelp" placeholder="lastname">
            </div>
            <div class="form-group">
                <!--<label style="visibility: hidden;" for="exampleInputEmail1">Email address</label>-->
                <input type="date" class="form-control" name="date_of_birth" aria-describedby="emailHelp" placeholder="Date of birth">
            </div>
            <?php if (isset($ageError)): ?>
                <div class="error alert alert-danger" role="alert">
                    <?php echo $ageError; ?>
                </div>
            <?php endif; ?>
            <div class="form-group">
                <!--<label style="visibility: hidden;" for="exampleInputEmail1">Email address</label>-->
                <input type="text" class="form-control" name="username" aria-describedby="emailHelp" placeholder="username">
            </div>
            <div class="form-group">
                <!--<label style="visibility: hidden;" for="exampleInputPassword1">Password</label>-->
                <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="password">
            </div>
            <?php if (isset($passwordError)): ?>
                <div class="error alert alert-danger" role="alert">
                    <?php echo $passwordError; ?>
                </div>
            <?php endif; ?>
            <button type="submit" class="btn btn-primary btn-sm btn-block">Submit</button>
        </form>
    </main>
    <?php  include_once(__DIR__ . "/inc/footer.inc.php") ?>
</body>