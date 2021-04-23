<?php
    require_once("autoload.php");

    $users = User::search($_POST['search']);
    $post = Post::search($_POST['search']);

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
        <?php foreach($searchUserOutput[0] as $key => $username): ?>
            <p><?php echo "{$username[0]}\n"; ?></p>
        <?php endforeach; ?>
    </div>
    <div class="searchResult">
        <h3>Posts</h3>
        <?php foreach($searchPostOutput[0] as $key => $post): ?>
            <p><?php echo "{$post[0]}\n"; ?></p>
        <?php endforeach; ?>
    </div>
    <div class="searchResult">
        <h3>Tags</h3>
        <?php foreach($searchTagOutput[0] as $key => $tag): ?>
            <p><?php echo "{$tag[0]}\n"; ?></p>
        <?php endforeach; ?>
    </div>
</main>

<?php include_once("inc/footer.inc.php");?>
<script src="/js/index.js"></script>
</body>
</html>