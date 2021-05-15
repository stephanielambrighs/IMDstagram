<?php

    require_once("autoload.php");

    $allPosts = Db::getAllPostsWithTagSearch($_POST["search"]);
    
    $htmlOutput = '';

    // loop over posts to generate html
    foreach($allPosts as $post){

        // get user file path for profile picture
        //$post_user_file_path =  Db::getProfileImgPath($post->getUser_id());

        // set default if none found
        // if (!$post_user_file_path) {
        //     $post_user_file_path = "data/uploads/default.png";
        // }

        // get some data from the db
        $genre = Db::getGenreById($post->getGenre_id());
        $user = Db::getUserById($post->getUser_id());
        $postUniqueName = "post-" . $post->getId();

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
            $tagLinks .= ' <a href="feed.php?v='.$urlTag.'">'.$tag.'</a>';
            
        }
        



        // generate html output
        $htmlOutput .= '
            <div class="col-9 ' . $postUniqueName .'">
                <!-- <img src="https://images.pexels.com/photos/908602/pexels-photo-908602.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260" alt="user_image"> -->
                <img src="-->' . $post_user_file_path . '" alt="user_image">
                <h2>' .$user->getUsername() . '</h2>
                <div class="btn-group" role="group">
                <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                        <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                    </svg>
                </button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                <button class="dropdown-item btn-report" id="btn-report-' . $postUniqueName .'" >Report</button>
                </div>
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
            </div>
            <div class="col-3 ' . $postUniqueName .'">
                <button type="button" class="btn btn-info"><img src="/images/like_image.png" alt="Likes">300 Likes</button>
                <button type="button" class="btn btn-info"><img src="/images/comment_image.png" alt="Comment">5 comments</button>
                <button type="button" class="btn btn-info"><img src="/images/share_image.png" alt="Shares">15 shares</button>
            </div>
        ';
    }

    // return the generated htlm
    echo $htmlOutput;