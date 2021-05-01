<?php
    require_once("autoload.php");
    session_start();

    $key = $_GET['v'];
    //var_dump($key);

    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <link href="/css/index.css" rel="stylesheet">
    <title><?php echo $key; ?></title>
</head>
<body>
    <?php //include_once("inc/nav.inc.php"); ?>
    <div class="container">
  <div class="row">

  <?php include 'loadSpecificPosts.php';?>

  </div>
</div>


<script type="text/javascript">
    let pagePostCount = '<?php echo $currentPagePostCount; ?>';
    let postsPerPage = '<?php echo $postsPerPage; ?>';
    let postPlacedSuccess = '<?php echo $postPlacedSuccess?>';
</script>


<div class="load-btn">
    <button id="btn-load-more" type="button" class="btn btn-info">Load more...</button>
</div>

<?php include_once("inc/footer.inc.php");?>
<script type="text/javascript">
    var userId = '<?php echo $userId; ?>';
</script>
<script src="/js/index.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
</body>
</html>