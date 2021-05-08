<?php

    include_once(__DIR__ . "/autoload.php");

    session_start();

    $sessionUser = $_SESSION['legato-user'];
    $userEmail = $sessionUser->getEmail();
    $userProfile = Profile::loadMyProfile($userEmail);
    // var_dump("this- " . $userProfile["email"]);

    $user = new User();

    if (!empty($_POST)) {
        $user->setNewFirstname($_POST['newFirstname']);
        $user->setNewLastname($_POST['newLastname']);
        $user->setNewEmail($_POST['newEmail']);
        $user->setNewPassword($_POST['newPassword']);
        $user->setNewUsername($_POST['newUsername']);
        $user->setNewDateOfBirth($_POST['newDateOfBirth']);
        $user->setNewBio($_POST['newBio']);

        $result = $user->updateProfile();
    }


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
                      <h4><?php echo ($userProfile["firstname"] . " " . $userProfile["lastname"]); ?></h4>
                      <p class="text-secondary mb-1">Title -> job</p>
                      <p class="text-muted font-size-sm">Where do I live?</p>
                      <button type="button" id="btn-private" class="btn btn-primary">Set private</button>
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
                      <?php echo ($userProfile["firstname"] . " " . $userProfile["lastname"]); ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?php echo $userProfile["email"]; ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Password</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    ********
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Date of birth</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?php echo $userProfile["date_of_birth"]; ?>
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
                <div class="col-md-2">
                    <!--<input id="editProfile" type="submit" class="btn btn-primary" name="btnAddMore" value="Edit Profile"/>-->
                    <a href="#" id="editProfile" class="btn btn-primary" name="btnAddMore" value="Edit Profile">Edit Profile</a>
                </div>
              </div>
            </div>
    </div>
</div>


<!-- edit profile -->

<div id="editFormProfile" class="container">
    <div class="row gutters">
        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
            <div class="card h-100">
                <div class="card-body">
                    <div class="account-settings">
                        <div class="user-profile">
                            <div class="user-avatar">
                                <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Maxwell Admin">
                                <input id="btn-change-photo" class="btn btn-primary" type="file" name="file"/>
                            </div>
                            <h5 class="user-name">Yuki Hayashi</h5>
                            <h6 class="user-email">yuki@Maxwell.com</h6>
                        </div>
                        <div class="about">
                            <h5>About</h5>
                            <p>I'm Yuki. Full Stack Designer I enjoy creating user-centric, delightful and human experiences.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form class="card h-100" method="post">
        <div id="editProfile"class="card-body">
            <div class="row gutters" id="rowProfile">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <h6 class="mb-2 text-primary">Personal Details</h6>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="firstName">First name</label>
                        <input name="newFirstname" type="text" class="form-control" id="firstName" placeholder="Enter first name">
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="lastName">Last name</label>
                        <input name="newLastname" type="text" class="form-control" id="lastName" placeholder="Enter last name">
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="eMail"><?php ?></label>
                        <input name="newEmail" type="email" class="form-control" id="eMail" placeholder="Enter email">
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input name="newPassword" type="password" class="form-control" id="password" placeholder="Enter your new password">
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input name="newUsername" type="text" class="form-control" id="username" placeholder="Enter your new username">
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="dateOfBirth">Date of birth</label>
                        <input type="date" class="form-control" name="newDateOfBirth" aria-describedby="emailHelp" placeholder="Enter your date of birth">
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="password">Bio</label>
                        <input name="newBio" type="text" class="form-control" id="bio" placeholder="Enter bio">
                    </div>
                </div>
            </div>
            <div class="row gutter">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="text-right">
                        <a id="cancelProfile" name="cancel" class="btn btn-secondary" href="profile.php">Cancel</a>
                        <button id="updateProfile" type="submit" id="submit" name="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="row row-space-2">
    <div class="col-md-6 m-b-2">
        <div class="p-10 bg-black">
          <div class="media media-xs overflow-visible">
              <a class="media-left" href="#">
                <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="image_friend" class="media-object img-circle">
              </a>
              <div class="media-body valign-middle">
                <b class="text-inverse">James Pittman</b>
              </div>
              <div class="btn-group" role="group" aria-label="Basic outlined example">
                <button type="button" class="btn btn-outline-success">Accept</button>
                <button type="button" class="btn btn-outline-warning">Decline</button>
              </div>
              <!-- <div class="media-body valign-middle text-right overflow-visible">
                <button id="accept" type="submit" name="submit" class="btn btn-primary">Accept</button>
                <button id="decline" type="submit" name="submit" class="btn btn-danger">Decline</button>
              </div> -->
          </div>
        </div>
    </div>
</div>
<?php include_once("inc/footer.inc.php");?>

<script type="text/javascript">
    var userId = <?php echo Db::getUserByEmail($userEmail)->getId(); ?>
</script>
<script src="/js/profile.js"></script>

</body>
</html>