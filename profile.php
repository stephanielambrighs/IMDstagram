<!DOCTYPE html>
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
                      <h4>John Doe</h4>
                      <p class="text-secondary mb-1">Title -> job</p>
                      <p class="text-muted font-size-sm">Where i life?</p>
                      <button class="btn btn-primary">Follow</button>
                      
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
                      Kenneth Valdez
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      fip@jukmuh.al
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Password</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      *********
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Date of birth</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      12/04/1980
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Bio</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      About myself
                    </div>
                  </div>
                </div>
                <div class="col-md-2">
                    <input id="editProfile" type="submit" class="btn btn-primary" name="btnAddMore" value="Edit Profile"/>
                </div>
              </div>
            </div>
    </div>
</div>

<!-- feed -->



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
    <form class="card h-100">
        <div id="editProfile"class="card-body">
            <div class="row gutters" id="rowProfile">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <h6 class="mb-2 text-primary">Personal Details</h6>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="firstName">First name</label>
                        <input type="text" class="form-control" id="firstName" placeholder="Enter first name">
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="lastName">Last name</label>
                        <input type="text" class="form-control" id="lastName" placeholder="Enter last name">
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="eMail">Email</label>
                        <input type="email" class="form-control" id="eMail" placeholder="Enter email">
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="text" class="form-control" id="password" placeholder="Enter your new password">
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="dateOfBirth">Date of birth</label>
                        <input type="text" class="form-control" id="birth" placeholder="Enter date of birth">
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="password">Bio</label>
                        <input type="text" class="form-control" id="bio" placeholder="Enter bio">
                    </div>
                </div>
            </div>
            <div class="row gutter">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="text-right">
                        <button id="cancelProfile" type="button" id="submit" name="submit" class="btn btn-secondary">Cancel</button>
                        <button id="updateProfile" type="button" id="submit" name="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="container2">
  <div class="row row-cols-4">
    <div class="col"><a href="https://placeholder.com"><img class="feed-img" src="https://via.placeholder.com/150"></a></div>
    <div class="col"><a href="https://placeholder.com"><img class="feed-img" src="https://via.placeholder.com/150"></a></div>
    <div class="col"><a href="https://placeholder.com"><img class="feed-img" src="https://via.placeholder.com/150"></a></div>
    <div class="col"><a href="https://placeholder.com"><img class="feed-img" src="https://via.placeholder.com/150"></a></div>

    <div class="col"><a href="https://placeholder.com"><img class="feed-img" src="https://via.placeholder.com/150"></a></div>
    <div class="col"><a href="https://placeholder.com"><img class="feed-img" src="https://via.placeholder.com/150"></a></div>
    <div class="col"><a href="https://placeholder.com"><img class="feed-img" src="https://via.placeholder.com/150"></a></div>
    <div class="col"><a href="https://placeholder.com"><img class="feed-img" src="https://via.placeholder.com/150"></a></div>

    <div class="col"><a href="https://placeholder.com"><img class="feed-img" src="https://via.placeholder.com/150"></a></div>
    <div class="col"><a href="https://placeholder.com"><img class="feed-img" src="https://via.placeholder.com/150"></a></div>
    <div class="col"><a href="https://placeholder.com"><img class="feed-img" src="https://via.placeholder.com/150"></a></div>
    <div class="col"><a href="https://placeholder.com"><img class="feed-img" src="https://via.placeholder.com/150"></a></div>

    <button type="button" id="btnAddPosts" class="btn btn-primary">Load more...</button>

  </div>
</div>



<?php include_once("inc/footer.inc.php");?>
<script src="/js/profile.js"></script>
<script src="/js/post.js"></script>
</body>
</html>