<?php
    require_once("autoload.php");
      
    if(!empty($_POST['email']) && !empty($_POST['password'])){
        try {
          $user = new User();
          $user->setEmail($_POST['email']);     
          $user->setPassword($_POST['password']);
  
          if($user->login()){
            session_start();
            
            $dbUser = Db::getUserByEmail($_POST['email']);
            $_SESSION["legato-user"] = $dbUser;
            header("Location: index.php");
          }
          else{
            $error = true;
          }
        }
        catch(Exception $e){
          $error = $e->getMessage(); 
          $error = '<p>Incorrect username or password</p>';
        }
      
    }
    


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link href="/css/style.css" rel="stylesheet">
    <title>Login</title>
</head>
<body>
<form class="form-feed form-box" id="form" action="login.php" method="post">
    <img src="./images/logo-02.svg" alt="Legato" class="logo">
    <?php if (isset($error)): ?>
        <div class="alert alert-danger" role="alert">Incorrect username or password</div>
    <?php endif; ?>
    <div class="mb-3">
        <label for="exampleInputUsername1" class="form-label">Email</label>
        <input type="text" class="form-control" id="exampleInputUsername1" aria-describedby="usernameHelp" name="email">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" name="password">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
</body>
</html>