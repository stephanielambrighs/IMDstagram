<?php



?><!DOCTYPE html>
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

<div class="add-feed">
    <button id="btn-feed" type="button" class="btn btn-info"><img src="/images/plus_image.png" alt="add"></button>
</div>

<!-- <div class="form-feed">
    <div class="mb-3">
        <label for="formFile" class="form-label">Default file input example</label>
        <input class="form-control" type="file" id="formFile">
    </div>
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Email address</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Title">
    </div>
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Email address</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Gerne">
    </div>
    <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Example textarea</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
    </div>
</div> -->

<div class="container">
  <div class="row">
    <div class="col-9">
        <img src="https://images.pexels.com/photos/908602/pexels-photo-908602.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260" alt="user_image">
        <h2>user_name released new Track</h2>
        <p>data</p>
    </div>
    <div class="feed">
        <div class="col-4">
            <img src="https://images.pexels.com/photos/1190298/pexels-photo-1190298.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260" alt="feed"> 
        </div>
        <div class="col-6">
            <h3>Title</h3>
            <h4>artist_name</h4>
            <p>Discription</p>
        </div>
    </div>
    <div class="col-3">
        <button type="button" class="btn btn-info"><img src="/images/like_image.png" alt="Likes">300 Likes</button>
        <button type="button" class="btn btn-info"><img src="/images/comment_image.png" alt="Comment">5 comment</button>
        <button type="button" class="btn btn-info"><img src="/images/share_image.png" alt="Shares">15 shares</button>
    </div>
  </div>
</div>

<?php include_once("inc/footer.inc.php");?>
</body>
</html>