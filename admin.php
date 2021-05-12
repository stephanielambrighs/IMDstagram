<?php

require_once("autoload.php");
session_start();

// check if user is logged in AND is administrator
if(isset($_SESSION["legato-user"])){

    // get email from session user
    $sessionUser = $_SESSION['legato-user'];
    $userEmail = $sessionUser->getEmail();
    $user = DB::getUserByEmail($userEmail);
    $userId = $user->getId();

    if ($user->getAdmin()){
        // set admin bool for loadPosts.php
        $isAdminPage = true;
    }else{
        // if not admin redirect to index.php
        header("Location: index.php");
    }

}else{
    // if not logged in redirect to index.php
    header("Location: index.php");
}


?><!DOCTYPE html>
<!-- LEGATO INDEX (FEED) -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <link href="/css/index.css" rel="stylesheet">
    <title>Legato</title>
</head>
<body>
<?php include_once("inc/nav.inc.php"); ?>




<div class="container">
  <div class="row">

  <?php
    include 'loadPosts.php';
  ?>

  </div>
</div>



<?php include_once("inc/footer.inc.php");?>
<script src="/js/admin.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

</body>
</html>