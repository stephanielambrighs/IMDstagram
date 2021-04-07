<?php

    include_once(__DIR__ . "/autoload.php");

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

    $target_dir = "images/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
    }

    // Check if file already exists
    if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) { // 62KB
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
    }





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
            <div class="alert alert-danger" role="alert">
                This is a danger alert—check it out!
            </div>
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
                    <?php foreach ($list as $key => $l): ?>
                        <option value="<?php echo $l ?>" name="<?php echo $l ?>"><?php echo $l ?></option> <!-- AUTOFILL PHP -->
                    <?php endforeach; ?>
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