<?php

    include_once(__DIR__ . "/../classes/Db.php");

    // amount of posts per page
    $postsPerPage = 20;

    // get amount of posts to load (default = $postsPerPage)
    if (isset($_POST['pagePostCount'])){
        $currentPagePostCount = $_POST['pagePostCount'];
    }else{
        $currentPagePostCount = $postsPerPage;
    }

    // get posts from db
    if ($isAdminPage){
        $allPosts = Db::getAllReportedPosts();
    }else{
        $allPosts = Db::getAllPosts($currentPagePostCount, $userId);
    }

    $htmlOutput = '';
    $htmlPostOutput = '';

    // add success/error message block
    if($isAdminPage){
        $htmlOutput .= '
        <div class="alert alert-success" role="alert"></div>
        <div class="alert alert-danger" role="alert"></div>
        ';
    }
    // loop over posts to generate html
    foreach($allPosts as $post){

        // get user file path for profile picture
        $post_user_file_path = Db::getProfileImgPath($post->getUser_id());

        // set default if none found
        if (!$post_user_file_path) {
            $post_user_file_path = FileManager::getLocation()."/default.png";
        }

        // get some data from the db
        $genre = Db::getGenreById($post->getGenre_id());
        $user = Db::getUserById($post->getUser_id());
        $like = Like::getNumberLike($post->getId());
        $userLike = Like::getLikeStatusUser($post->getId(), $userId);
        $comments = Comment::getAllComments($post->getId());
        $postUniqueName = "post-" . $post->getId();
        $countLikes = $like[0];




        // Get tags out of description
        $description = $post->getDescription();
        $descriptions;
        $tags = [];
        $numberOfTags = 0;
        $counter = 0; //Is pointer binnenin de description
        //$tags[0] = "";
        $tagLength = 0;

        // Kijken of er een # in de description zit => Neem het deel voor de #
        if(strpos($description, "#") > 0){
            $descriptions = strstr($description, "#", true);
        }else{
            $descriptions = $description;
        }

        $counter = strpos($description, "#", $counter);
        while($counter > 0){
            //var_dump("Er zit een # in".$post->getId());
            if(strpos(substr($description, $counter), " ") == 0){
                $tagLength = strlen(substr($description, $counter));
            }else{
                $tagLength = strpos(substr($description, $counter), " ");
            }
            $tags[$numberOfTags] = substr($description, $counter, $tagLength);
            $numberOfTags++;
            $counter = strpos($description, "#", $counter+1);
        }

        //var_dump($tags);
        //var_dump('Number of tags: '.$numberOfTags);

        //Foreach loop voor de tags
        $tagLinks = "";
        foreach($tags as $tag){
            $urlTag = substr($tag, 1);
            $tagLinks .= ' <a href="feed.php?tag='.$urlTag.'">'.$tag.'</a>';

        }

        foreach($comments as $comment){
            $htmlPostOutput .= '
            <h3>' . $comment->getText() . '</h3>
            <p>' . $comment->getUploadedTimeAgo() . '</p>
            ';
        }



        // generate html output
        $htmlOutput .= '
            <div class="col-9 ' . $postUniqueName .'">
                <!-- <img src="https://images.pexels.com/photos/908602/pexels-photo-908602.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260" alt="user_image"> -->
                <img src="' . $post_user_file_path . '" alt="user_image">
                <a href="someonesProfile.php?id='.$user->getId() . ' "><h2>' .$user->getUsername() . '</h2></a>
                <div class="btn-group" role="group">
                <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                        <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                    </svg>
                </button>
        ';

        if ($isAdminPage){
            $htmlOutput .= '
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                <button class="dropdown-item btn-remove-strikes" id="btn-remove-strikes-' . $postUniqueName .'" >Remove strikes</button>
                <button class="dropdown-item btn-delete-post" id="btn-delete-post-' . $postUniqueName .'" >Delete post</button>
                </div>
            ';
        }else{
            $htmlOutput .= '
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                <button class="dropdown-item btn-report" id="btn-report-' . $postUniqueName .'" >Report</button>
                </div>
            ';
        }

        $htmlOutput .= '
            </div>
                <p>' . $post->getUploadedTimeAgo() .'</p>
            </div>

            <div class="feed ' . $postUniqueName .'">
                <div class="col-4">
                <img src="' . $post->getFile_path() . '" alt="feed">
                </div>
                <div class="col-6">
                    <h3>' . $post->getTitle() .'</h3>
                    <h4>' . $genre->getName() . '</h4>
                    <p>' . $descriptions . $tagLinks . '</p>
                </div>
            </div>';

            // if ($like[0] == 1){
            //     $htmlOutput .= '
            //     <div class="col-3">
            //         <p id="'.$post->getId().'">' . $like[0] . ' like</p>
            //     </div>
            //     ';
            // }else{
            //     $htmlOutput .= '
            //     <div class="col-3">
            //         <p id="'.$post->getId().'">' . $like[0] . ' likes</p>
            //     </div>
            //     ';
            // }

            $htmlOutput .='
            <div class="col-3 ' . $postUniqueName .'"> ';
            if ($like[0] == 1){
                $htmlOutput .= '
                    <p class="like-count" id="'.$post->getId().'">' . $like[0] . ' like</p>
                ';
            }else{
                $htmlOutput .= '
                    <p class="like-count" id="'.$post->getId().'">' . $like[0] . ' likes</p>
                ';
            }
            $htmlOutput .=
                '<button type="button" class="btn btn-info-like" data-postid="'.$post->getId().'">'.$userLike.'</button>
                <button type="button" class="btn btn-info"><img class="comment-image" src="/images/comments_image.png" alt="Comment"> comments</button>
            </div>

            <div class="post__comments">
                <div class="post__comments__form">
                    <input type="text" name="comment-input" id="comment-text" placeholder="Whats on your mind">
                    <a href="" class="btn btn-comment" id="btn-comment" data-postid="'.$post->getId().'">Add comment</a>
                </div>
                <ul id="comment_' . $post->getId() .' class="post__comments__list"'. $htmlPostOutput .'
                </ul>
            </div>
        ';
    }

    // return the generated html
    echo $htmlOutput;

    // . $htmlPostOutput . '

    // <div id="comment_' . $post->getId() . '">
//     <ul class="post__comments__list">
//     <li>This is a first comment</li>
// </ul>


// $htmlPostOutput .= '
// <div id="comment_' . $post->getId() . '">