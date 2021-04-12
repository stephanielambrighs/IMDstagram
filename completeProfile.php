<?php

    include_once(__DIR__ . "/autoload.php");
    include_once(__DIR__ . "/classes/Db.php");
    

    $user = new User();

    session_start();
    if (isset($_SESSION['email'])) {
        //echo $_SESSION;
        //var_dump($_SESSION);
        
    } else {
        exit;
    }

    if(!empty($_POST['bio']) 
    && !empty($_FILES['file'])){
        try{
        
            $uploadResult = FileManager::uploadFile($_FILES['file']);
    
            if($uploadResult['success'] == true){
                $user->setBio($_POST['bio']);
                //$user->setAvatar($_POST['avatar']);
                $user->setFile_path($uploadResult['file_path']);
                $email = $_SESSION['email'];
                $result = Db::completeProfile($user);

                //$email = $_SESSION['email'];
                //$user->completeProfile($email);

            }
        }
        catch(Exception $e){
            $error = $e->getMessage();
            var_dump($error);
        }

        /*$user->setAvatar('dummy');
        $user->setBio($_POST['bio']);
        $user->setGenre($_POST['genre1']);

        $email = $_SESSION['email'];
        
        $user->completeProfile($email);*/
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
                <h3 class="r-h3">Complete Profile</h3>
                <h5>Would you like to add some additional information to your profile?</h5>
            </div>
            <div class="text-center">
                <img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" id="avatar" class="avatar img-circle img-thumbnail" alt="avatar">
                <h5>Upload a different photo...</h5>
                <input type="file" name="file" id="fileToUpload" class="text-center center-block file-upload">
            </div><hr>
            <div class="form-group">
                <!--<label style="visibility: hidden;" for="exampleInputPassword1">Password</label>-->
                <textarea name="bio" class="form-control" id="bio" placeholder="Biography" cols="30" rows="4"></textarea>
            </div>
            <p id="frm-p">What genres are you into?</p>




            <div class="form-group" id="genres">
                <!-- LOOP OVER GENRES -->
                <select name="genre1" id="genre">
                    <option selected>-</option>
                    <?php $allGenres = Db::getAllGenres();
                        for($i = 0; $i < count($allGenres); $i++):?>
                        <option value="<?php echo ($i + 1)?>"><?php echo $allGenres[$i]->name; ?></option>
                    <?php endfor; ?>
                </select>
                
                <select name="genre2" id="genre">
                <option selected>-</option>
                    <?php $allGenres = Db::getAllGenres();
                        for($i = 0; $i < count($allGenres); $i++):?>
                        <option value="<?php echo ($i + 1)?>"><?php echo $allGenres[$i]->name; ?></option>
                    <?php endfor; ?>
                </select>

                <select name="genre3" id="genre">
                <option selected>-</option>
                    <?php $allGenres = Db::getAllGenres();
                        for($i = 0; $i < count($allGenres); $i++):?>
                        <option value="<?php echo ($i + 1)?>"><?php echo $allGenres[$i]->name; ?></option>
                    <?php endfor; ?>
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