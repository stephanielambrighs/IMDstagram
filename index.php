<?php


require_once("autoload.php");
session_start();

if(isset($_SESSION["legato-user"])){

    if(!empty($_POST['title'])
    && !empty($_POST['description'])
    && !empty($_POST['genre_id'])
    && !empty($_FILES['file'])){
        try{
            // get email from session user
            $user = $_SESSION['legato-user'];
            $userEmail = $user->getEmail();
            $userId =  DB::getUserByEmail($userEmail)->getId();

            // update file
            $uploadResult = FileManager::uploadFile($_FILES['file']);

            if($uploadResult['success'] == true){
                $post = new Post();
                $post->setTitle($_POST['title']);
                $post->setDescription($_POST['description']);
                $post->setGenre_id($_POST['genre_id']);
                $post->setFile_path($uploadResult['file_path']);

                //$post->setUser_id($userId);
                //$result = Db::insertPost($post);
            }
        }
        catch(Exception $e){
            $error = $e->getMessage();
            var_dump($error);
        }
    }else{
        $uploadTitle = false;
        $uploadGenre = false;
        $uploadFile = false;
        $uploadDescription = false;
    }

    //Code searchfield hieer
    if(isset($_POST["search"])){
        $searchQuery = $_POST["search"];
        $query = mysql_query("select * LIKE '%$searchQuery%'") or die("could not search");
        $count = mysql_num_rows($query);
        if($count == 0){
            $output = "There are no search results";
        }else{
            while($row = mysql_fetch_array($query)){
                $username = $row['username'];

                $output.="<div>".$username."".$post."</div>";
            }
        }
    }
}

?><!DOCTYPE html>
<!-- LEGATO INDEX (FEED) -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link href="/css/index.css" rel="stylesheet">
    <title>Legato</title>
</head>
<body>
<?php include_once("inc/nav.inc.php"); ?>

<div class="add-feed">
    <button id="btn-feed" type="button" class="btn btn-info"><img src="/images/plus_image.png" alt="add"></button>
</div>

<form class="form-feed" id="form" action="#" method="POST" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Title</label>
        <input type="text" name="title" class="form-control" id="title" placeholder="Title...">
        <?php if($uploadTitle == false && isset($uploadTitle)): ?>
            <div class="alert alert-danger"><?php echo "Sorry, this field cannot be empty."; ?></div>
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Genre</label>
        <select class="form-select" name="genre_id" id="inputGroupSelect04" aria-label="Example select with button addon">
            <option selected>-</option>
        <?php
        $allGenres = Db::getAllGenres();
        for($i = 0; $i < count($allGenres); $i++):?>
            <option value="<?php echo ($i + 1)?>"><?php echo $allGenres[$i]->name; ?></option>
        <?php endfor; ?>
        </select>
        <?php if(isset($uploadGenre)): ?>
            <div class="alert alert-danger"><?php echo "Sorry, this field cannot be empty."; ?></div>
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <label for="formFile" class="form-label">Upload file</label>
        <input class="form-control" name="file" type="file" id="file">
        <?php if(isset($uploadResult) && $uploadResult['success'] == false): ?>
            <div class="alert alert-danger"><?php echo $uploadResult['message']; ?></div>
        <?php endif;?>
        <?php if(isset($uploadFile)): ?>
            <div class="alert alert-danger"><?php echo "Sorry, this field cannot be empty."; ?></div>
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Description</label>
        <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3" type="text"></textarea>
        <?php if(isset($uploadDescription)): ?>
            <div class="alert alert-danger"><?php echo "Sorry, this field cannot be empty."; ?></div>
        <?php endif; ?>
    </div>
    <button id="submit" type="submit" value="Upload" class="btn btn-info">Submit</button>
</form>

<?php print("output"); ?>

<div class="container">
  <div class="row">
  <?php $allPosts = Db::getAllPosts();

    foreach($allPosts as $post):
    $post_user_file_path =  Db::getProfileImgPath($post->getUser_id());
    // $post_user_file_path =  $post->getFile_path();
    if (!$post_user_file_path) {
        $post_user_file_path = "data/uploads/default.png";
    }
    // var_dump($post_user_file_path);
    ?>
    <div class="col-9">
        <!-- <img src="https://images.pexels.com/photos/908602/pexels-photo-908602.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260" alt="user_image"> -->
        <img src="<?php echo $post_user_file_path; ?>" alt="user_image">
        <h2><?php echo Db::getUserById($post->getUser_id())->getUsername(); ?></h2>
        <p><?php echo $post->getUploadedTimeAgo(); ?></p>
    </div>
    <div class="feed">
        <div class="col-4">
        <img src="<?php echo $post->getFile_path(); ?>" alt="feed">
        </div>
        <div class="col-6">
            <h3><?php echo $post->getTitle(); ?></h3>
            <h4><?php $genre = Db::getGenreById($post->getGenre_id());
            echo $genre->getName(); ?></h4>
            <p><?php echo $post->getDescription(); ?></p>
        </div>
    </div>
    <div class="col-3">
        <button type="button" class="btn btn-info"><img src="/images/like_image.png" alt="Likes">300 Likes</button>
        <button type="button" class="btn btn-info"><img src="/images/comment_image.png" alt="Comment">5 comments</button>
        <button type="button" class="btn btn-info"><img src="/images/share_image.png" alt="Shares">15 shares</button>
    </div>
    <?php endforeach; ?>
  </div>
</div>

<?php include_once("inc/footer.inc.php");?>
<script src="/js/index.js"></script>
</body>
</html>