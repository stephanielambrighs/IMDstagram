<?php

    include_once(__DIR__ . "/autoload.php");

    $user = new User();

    if (!empty($_POST)) {
        var_dump($_POST);

        $user->setEmail($_POST['email']);
        $user->setUsername($_POST['username']);
        $user->setPassword($_POST['password']);
        $user->setAvatar("DUMMY");
        $user->setFirstname($_POST['firstname']);
        $user->setLastname($_POST['lastname']);
        $user->setBio("DUMMY");
        $user->setDateOfBirth($_POST['date_of_birth']);
        $user->register();
    }

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php include_once(__DIR__ . "/inc/links.inc.php") ?>

    <title>Welcome - Register</title>
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
            <div class="alert alert-danger" role="alert">
                This is a danger alert—check it out!
            </div>
            <div class="form-group">
                <!--<label style="visiffbility: hidden;" for="exampleInputEmail1">Email address</label>-->
                <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="email">
            </div>
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
            <div class="form-group">
                <!--<label style="visibility: hidden;" for="exampleInputEmail1">Email address</label>-->
                <input type="text" class="form-control" name="username" aria-describedby="emailHelp" placeholder="username">
            </div>
            <div class="form-group">
                <!--<label style="visibility: hidden;" for="exampleInputPassword1">Password</label>-->
                <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="password">
            </div>
            
            <button type="submit" class="btn btn-primary btn-sm btn-block">Submit</button>
        </form>
    </main>
    <?php  include_once(__DIR__ . "/inc/footer.inc.php") ?>
</body>