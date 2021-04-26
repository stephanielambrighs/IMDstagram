<?php

    include_once(__DIR__ . "/autoload.php");

    session_start();
    // var_dump($_SESSION['legato-user']);
    $someonesMail = $_GET["email"];
    // var_dump($someonesMail);

    $someonesProfile = Profile::loadProfile($someonesMail);

    $user = new User();


?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link href="/css/profile.css" rel="stylesheet">
    <title>profile</title>
</head>
<body>
<?php include_once("inc/nav.inc.php"); ?>

<div id="showProfile" class="row gutters-sm">
    <div class="main-body">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle" width="150">
                    <div class="mt-3">
                      <h4><?php echo ($someonesProfile["firstname"] . " " . $someonesProfile["lastname"]); ?></h4>
                      <p class="text-secondary mb-1">Title -> job</p>
                      <p class="text-muted font-size-sm">Where i life?</p>
                      <button data-followerid="<?php echo $someonesMail ?>" data-userid="<?php echo $_SESSION['legato-user']->getEmail() ?>" id="btn-follow" class="btn btn-primary">Follow</button>

                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-8">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Full Name</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php echo ($someonesProfile["firstname"] . " " . $someonesProfile["lastname"]); ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?php echo $someonesProfile["email"]; ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Date of birth</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?php echo $someonesProfile["date_of_birth"]; ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Bio</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?php echo $user->getBio(); ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
    </div>
</div>
<?php include_once("inc/footer.inc.php");?>
<script src="/js/someonesProfile.js"></script>
</body>
</html>