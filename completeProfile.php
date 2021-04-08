<?php

    include_once(__DIR__ . "/autoload.php");
    

    $user = new User();

    $list = array(
        "Pop",
        "Rock",
        "Metal",
        "Hardstyle",
        "Hardcore",
        "Drum and bass",
        "Orchestra",
        "Raggae",
        "Shuffle",
        "Dance"
    );

    session_start();
    if (isset($_SESSION['email'])) {
        echo $_SESSION['email'];
        
    } else {
        exit;
    }

    if (!empty($_POST)) {
        //$user->setAvatar($_POST['email']);
        $user->setBio($_POST['bio']);
        $user->setGenre($_POST['genre1']);
    
        $_SESSION['email'] = $user->getEmail();
        
        $user->completeProfile();
    }

    //function loadGenres() {
        /*include_once(__DIR__ . "/classes/Db.php");

        $conn = Db::getConnection();
        $statement = $conn->prepare("select name from genres");
        $items = $statement->execute();
        var_dump($statement);*/
    //}
    





?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <?php include_once(__DIR__ . "/inc/links.inc.php") ?>

    <title>Complete Profile</title>
</head>
<body id="r-body">
    <main id="r-main">
        <form method="POST" action="" id="r-register" enctype="multipart/form-data">
            <div class="form-item">
                <a href="#"><img id="logo" src="images/logo-02.svg" alt="Legato logo"></a>
            </div>
            <?php if (isset($avatarError)): ?>
                <div class="error alert alert-danger" role="alert">
                    <?php echo $avatarError; ?>
                </div>
            <?php endif; ?>
            <div class="form-group">
                <h3>Complete Profile</h3>
                <h5>Would you like to add some additional information to your profile?</h5>
            </div>
            <div class="text-center">
                <img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" id="avatar" class="avatar img-circle img-thumbnail" alt="avatar">
                <h5>Upload a different photo...</h5>
                <input type="file" name="fileToUpload" id="fileToUpload" class="text-center center-block file-upload">
            </div><hr>
            <div class="form-group">
                <!--<label style="visibility: hidden;" for="exampleInputPassword1">Password</label>-->
                <textarea name="bio" class="form-control" id="bio" placeholder="Biography" cols="30" rows="4"></textarea>
            </div>
            <p id="frm-p">What genres are you into?</p>




            <div class="form-group" id="genres">
                <!-- LOOP OVER GENRES -->
                <select name="genre1" id="genre">
                    <?php include_once(__DIR__ . "/classes/Db.php");
                        $allGenres = Db::getAllGenres();
                        var_dump($allGenres);
                        for($i = 0; $i < count($allGenres); $i++): ?>
                        <?php var_dump($allGenres[$i]); ?>
                        <option value="<?php echo $allGenres[$i] ?>" name="<?php echo $allGenres[$i] ?>"><?php $allGenres[$i]->name ?></option> <!-- AUTOFILL PHP -->
                    <?php endfor; ?>
                </select>
                
                <select name="genre2" id="genre">
                    <?php foreach ($list as $key => $l): ?>
                        <option value="<?php echo $l ?>" name="<?php echo $l ?>"><?php echo $l ?></option> <!-- AUTOFILL PHP -->
                    <?php endforeach; ?>
                </select>

                <select name="genre3" id="genre">
                    <?php foreach ($list as $key => $l): ?>
                        <option value="<?php echo $l ?>" name="<?php echo $l ?>"><?php echo $l ?></option> <!-- AUTOFILL PHP -->
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <a href="index.php" class="col-4 btn btn-outline-secondary btn-sm">Skip</a>
                <button type="submit" class="col-4 btn btn-primary btn-sm">Submit</button>
            </div>
        </form>
    </main>

    <script src="js/main.js"></script>
</body>
</html>