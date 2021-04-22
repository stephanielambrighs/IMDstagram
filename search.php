<?php
    require_once("autoload.php");

    $searchUserInput = new User();
    $searchUserInput->setUsername($_POST["search"]);
    $searchUserOutput = $searchUserInput->searchUser();

    $searchPostInput = new Post();
    $searchPostInput->setTitle($_POST["search"]);
    $searchPostOutput = $searchPostInput->searchPost();

    $searchTagInput = new Tag();
    $searchTagInput->setTag($_POST["search"]);
    $searchTagOutput = $searchTagInput->searchTag();

    /*$emailTarget = 
    $userProfile = new Profile();
    $userProfile->loadProfile($emailTarget);*/

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
<main style="background-color: red;">
    <h2 class="h2">Results</h2>
    <div class="searchResult">
        <h3>Users</h3>
        <ul>
        <?php foreach($searchUserOutput[0] as $key => $username): ?>
            <li><a class="s-item" href="profile.php?email=<?php echo $key ?>"><?php echo "{$username[0]}\n"; ?></a></li>
        <?php endforeach; ?>
        </ul>
    </div>
    <div class="searchResult">
        <h3>Posts</h3>
        <ul>
        <?php foreach($searchPostOutput[0] as $key => $post): ?>
            <li><a class="s-item" href="#"><?php echo "{$post[0]}\n"; ?></a></li>
        <?php endforeach; ?>
        </ul>
    </div>
    <div class="searchResult">
        <h3>Tags</h3>
        <?php foreach($searchTagOutput[0] as $key => $tag): ?>
            <li><a class="s-item" href="#"><?php echo "{$tag[0]}\n"; ?></a></li>
        <?php endforeach; ?>
    </div>
</main>

<?php include_once("inc/footer.inc.php");?>
<script src="/js/index.js"></script>
</body>
</html>