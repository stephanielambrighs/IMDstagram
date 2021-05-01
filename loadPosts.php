<?php

    require_once("autoload.php");

    // amount of posts per page
    $postsPerPage = 20;

    // get amount of posts to load (default = $postsPerPage)
    if (isset($_POST['pagePostCount'])){
        $currentPagePostCount = $_POST['pagePostCount'];
    }else{
        $currentPagePostCount = $postsPerPage;
    }

    // get posts from db
    $allPosts = Db::getAllPosts($currentPagePostCount);

    // loop over posts to generate html
    $htmlOutput = '';
    foreach($allPosts as $post){

        // get user file path for profile picture
        $post_user_file_path =  Db::getProfileImgPath($post->getUser_id());

        // set default if none found
        if (!$post_user_file_path) {
            $post_user_file_path = "data/uploads/default.png";
        }

        // get some data from the db
        $genre = Db::getGenreById($post->getGenre_id());
        $user = Db::getUserById($post->getUser_id());

        // generate html output
        $htmlOutput .= '
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
                    <h3>' . $post->getTitle() .'</h3>
                    <h4>' . $genre->getName() . '</h4>
                    <p>' . $post->getDescription() . '</p>
                </div>
            </div>

            <div class="col-3">
                <button type="button" class="btn btn-info"><img src="/images/like_image.png" alt="Likes">300 Likes</button>
                <button type="button" class="btn btn-info"><img src="/images/comment_image.png" alt="Comment">5 comments</button>
                <button type="button" class="btn btn-info"><img src="/images/share_image.png" alt="Shares">15 shares</button>
            </div>
            
            <div class="post__comments">
                <div class="post__comments__form">
                    <input type="text" name="comment-input" id="comment-text" placeholder="Whats on your mind">
                    <a href="" class="btn btn-comment" id="btn-comment" data-postid="'.$post->getId().'">Add comment'.$post->getId().'</a>
                </div>

                <ul class="post__comments__list">
                    <li>This is a first comment</li>
                </ul>
            </div>
        ';

    }

    // return the generated htlm
    echo $htmlOutput;
