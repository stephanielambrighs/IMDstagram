<?php

require_once("autoload.php");
session_start();

if(isset($_SESSION["legato-user"])){


    // get email from session user
    $user = $_SESSION['legato-user'];
    $userEmail = $user->getEmail();
    $userId =  DB::getUserByEmail($userEmail)->getId();


    // if a post is done, add it to the db
    if(!empty($_POST['title'])
    && !empty($_POST['description'])
    && !empty($_POST['genre_id'])
    && !empty($_FILES['file'])){
        try{
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


<div class="container">
  <div class="row">

  <?php include 'loadPosts.php';?>

  </div>
</div>


<script type="text/javascript">
    let pagePostCount = '<?php echo $currentPagePostCount; ?>';
    let postsPerPage = '<?php echo $postsPerPage; ?>';
</script>


<div class="load-btn">
    <button id="btn-load-more" type="button" class="btn btn-info">Load more...</button>
</div>

<?php include_once("inc/footer.inc.php");?>
<script type="text/javascript">
    var userId = '<?php echo $userId; ?>';
</script>
<script src="/js/index.js"></script>
<script scr="/js/comment.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

</body>
</html>