<?php
    require_once("autoload.php");

    $searchInput = new User();
    $searchInput->setUsername($_POST["search"]);
    $searchInput->searchUser($searchInput);

?>
<!DOCTYPE html>
<!-- LEGATO INDEX (FEED) -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link href="/css/style.css" rel="stylesheet">
    <title>Legato</title>
</head>
<body>
<?php include_once("inc/nav.inc.php"); ?>

<h2>Results (X aantal)</h2>

<div>
    
</div>

<?php include_once("inc/footer.inc.php");?>
<script src="/js/index.js"></script>
</body>
</html>