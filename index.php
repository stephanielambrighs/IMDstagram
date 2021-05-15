<?php

require_once("autoload.php");
session_start();

if(isset($_SESSION["legato-user"])){



    // get email from session user
    $sessionUser = $_SESSION['legato-user'];
    $userEmail = $sessionUser->getEmail();
    $user = DB::getUserByEmail($userEmail);
    $userId = $user->getId();

    // if a post is done, add it to the db
    if(!empty($_POST['title'])
    && !empty($_POST['description'])
    && !empty($_POST['genre_id'])
    && !empty($_FILES['file'])){
        try{
            // update file
            $uploadResult = FileManager::uploadFile($_FILES['file'], $userId);


            if($uploadResult['success'] == true){
                $post = new Post();
                $post->setTitle($_POST['title']);
                $post->setDescription($_POST['description']);
                $post->setGenre_id(intval($_POST['genre_id']));
                $post->setFile_path($uploadResult['file_path']);
                $post->setUser_id(intval($userId));
                $post->setLatitude($_POST['latitude']);
                $post->setLongitude($_POST['longitude']);
                $result = $post->insert();

                $postPlacedSuccess = true;
            }else{
                $postPlacedFailed = true;
            }
        }
        catch(Exception $e){
            $error = $e->getMessage();
            var_dump($error);
        }
    }

//     if(isset($_POST["search"])){
//         $searchQuery = $_POST["search"];
//         $query = mysql_query("select * LIKE '%$searchQuery%'") or die("could not search");
//         $count = mysql_num_rows($query);
//         if($count == 0){
//             $output = "There are no search results";
//         }else{
//             while($row = mysql_fetch_array($query)){
//                 $username = $row['username'];

//                 $output.="<div>".$username."".$post."</div>";
//             }
//         }
//     }


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

<div class="add-feed">
    <button id="btn-feed" type="button" class="btn btn-info">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
        </svg>
    Add feed</button>
</div>

<form class="form-feed" id="form" action="index.php" method="POST" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Title</label>
        <input type="text" name="title" class="form-control" id="title" placeholder="Title...">
        <div id="msg-title" class="alert alert-danger form"></div>
    </div>
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Genre</label>
        <select id="dropdown-genres" class="form-select" name="genre_id" aria-label="Example select with button addon">
            <option  selected>-</option>
        <?php
        $allGenres = Db::getAllGenres();
        for($i = 0; $i < count($allGenres); $i++):?>
            <option value="<?php echo ($i + 1)?>"><?php echo $allGenres[$i]->name; ?></option>
        <?php endfor; ?>
        </select>
            <div id="msg-genres" class="alert alert-danger form"></div>
    </div>
    <div class="mb-3">
        <label for="formFile" class="form-label">Upload file</label>
        <input class="form-control" name="file" type="file" id="file">
        <?php if($uploadResult['success'] == false): ?>
            <div class="alert alert-danger form"><?php echo $uploadResult['message']; ?></div>
        <?php endif;?>
            <div id="msg-uploadfile" class="alert alert-danger form"></div>
    </div>
    <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Description</label>
        <textarea class="form-control" name="description" id="description" rows="3" type="text"></textarea>
        <div id="msg-description"  class="alert alert-danger form"><?php echo "Sorry, this field cannot be empty."; ?></div>
        <input type="text" name="latitude" style="visibility: hidden;" id="location-latitude">
        <input type="text" name="longitude" style="visibility: hidden; display: block;" id="location-longitude">
    </div>
    <button id="submit" type="submit" value="Upload" class="btn btn-info">Submit</button>
</form>



<?php if(isset($postPlacedSuccess) == true): ?>
    <div class="alert alert-success feed" role="alert">
        <?php echo "Successfully placed post"?>
    </div>
<?php endif;?>

<?php if(isset($postPlacedFailed) == true): ?>
    <div class="alert alert-danger feed" role="alert">
        <?php echo "Failed to place post"?>
    </div>
<?php endif;?>

<div class="container">
  <div class="row">

  <?php include 'ajax/loadPosts.php';?>

  </div>
</div>


<script type="text/javascript">
    let pagePostCount = '<?php echo $currentPagePostCount; ?>';
    let postsPerPage = '<?php echo $postsPerPage; ?>';
    let postPlacedSuccess = '<?php echo $postPlacedSuccess?>';
    let postPlacedFailed = '<?php echo $postPlacedFailed?>';
</script>


<div class="load-btn">
    <button id="btn-load-more" type="button" class="btn btn-info">Load more...</button>
</div>

<?php include_once("inc/footer.inc.php");?>
<script type="text/javascript">
    var userId = '<?php echo $userId; ?>';
    let countLikes = '<?php echo $countLikes; ?>';
</script>
<script scr="/js/comment.js"></script>
<script src="/js/index.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

</body>
</html>