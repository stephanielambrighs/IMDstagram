<?php
    require_once("autoload.php");

    $users = User::search($_POST['search']);
    $posts = Post::search($_POST['search']);

?>
<!DOCTYPE html>
<!-- LEGATO INDEX (FEED) -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link href="./css/style.css" rel="stylesheet">
    <title>Legato</title>
</head>
<body>
<?php include_once("inc/nav.inc.php"); ?>
<main>
    <h2 class="h2">Results</h2>
    <div class="searchResult">
        <h3>Users</h3>
        <?php foreach($users[0] as $key => $username): ?>
            <p><?php echo "{$username[0]}\n"; ?></p>
        <?php endforeach; ?>
    </div>
    <div class="searchResult">
        <h3>Posts</h3>
        <?php foreach($posts[0] as $key => $post): ?>
            <p><?php echo "{$post[0]}\n"; ?></p>
            <div class="col-9">
                <!-- <img src="https://images.pexels.com/photos/908602/pexels-photo-908602.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260" alt="user_image"> -->
                <img src="' . $post_user_file_path . '" alt="user_image">
                <h2>' .$user->getUsername() . '</h2>
                <p>' . $post->getUploadedTimeAgo() .'</p>
            </div>

            <div class="feed">
                <div class="col-4">
                <img src="' . $post->getFile_path() . '" alt="feed">
                </div>
                <div class="col-6">
                    <h3><?php echo "{$post[0]}\n"; ?></h3>
                    <h4>Name genre</h4>
                    <p>description</p>
                </div>
            </div>

            <div class="col-3">
                <button type="button" class="btn btn-info"><img src="/images/like_image.png" alt="Likes">300 Likes</button>
                <button type="button" class="btn btn-info"><img src="/images/comment_image.png" alt="Comment">5 comments</button>
                <button type="button" class="btn btn-info"><img src="/images/share_image.png" alt="Shares">15 shares</button>
            </div>
        <?php endforeach; ?>
    </div>
</main>

<?php include_once("inc/footer.inc.php");?>
<script src="/js/index.js"></script>
</body>
</html>