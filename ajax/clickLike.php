<?php

include_once(__DIR__ . "/../classes/Db.php");
include_once(__DIR__ . "/../classes/User.php");
include_once(__DIR__ . "/../classes/Post.php");
include_once(__DIR__ . "/../classes/Like.php");

if(!empty($_POST)){
    $postId = $_POST['postId'];

    $response = [
        'status' => 'success',
        'messsage' => 'Ik ben tot clickLike gekomen'
    ];

    var_dump($postId);

    //$saveLike = Like::clickLike();
    //if($saveLike){
    //    $response = [
    //        'status' => 'success',
    //        'messsage' => 'Added like to likes table'
    //    ];
    //}
    //else {
    //    $response = [
    //        'status' => 'failed',
    //        'messsage' => 'Failed to add like to likes table'
    //    ];
    //}

    header('Content-Type: application/json');
    echo json_encode($response);
}