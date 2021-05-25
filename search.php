<?php
    require_once("autoload.php");

    session_start();


if(isset($_SESSION["legato-user"])){

    // get email from session user
    $sessionUser = $_SESSION['legato-user'];
    $userEmail = $sessionUser->getEmail();
    $user = DB::getUserByEmail($userEmail);

    // create search objects
    $searchUserOutput = User::searchUser($_GET["search"]);
    $searchPostOutput = Post::searchPost($_GET["search"]);
    $searchLocationOutput = Post::searchLocation($_GET['search']);
}else{
    header("Location: login.php");
}

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
<main style="background-color: #5E1161;">
    <h2 class="h2">Results</h2>
    <div class="searchResult">
        <h3>Users</h3>
        <ul>
        <?php foreach($searchUserOutput[0] as $key => $username): ?>
            <li><a class="s-item" href="someonesProfile.php?email=<?php echo $username[0] ?>"><?php echo htmlspecialchars("{$username[0]}\n"); ?></a></li>
        <?php endforeach; ?>
        </ul>
    </div>
    <div class="searchResult">
        <h3>Posts</h3>
        <?php include 'loadPostsTitle.php'; ?>
    </div>

    <div class="searchResult">
        <h3>Tags</h3>
        <?php include 'loadPostsTag.php'; ?>
    </div>

    <div class="searchResult">
        <h3>Location</h3>
        <?php include 'loadPostsLocation.php'; ?>
    </div>
</main>

<?php include_once("inc/footer.inc.php");?>
<script src="/js/index.js"></script>
</body>
</html>