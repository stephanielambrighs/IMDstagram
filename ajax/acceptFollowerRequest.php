<?php

include_once(__DIR__ . "/../classes/Db.php");

if(!empty($_POST)){
    $userId = $_POST['userId'];
    $followerId = $_POST['followerId'];

    // get follower row id
    $followersRowId = Db::getFollowerRowId($userId, $followerId);
    // var_dump($followersRowId);

    // set row to accepted
    $acceptSuccess = Db::setFollowerAccept($followersRowId, 1);
    // var_dump($acceptSuccess);
    if ($acceptSuccess) {
        $response = [
            'status' => 'success',
            'messsage' => 'Successfully accepted follower request'
        ];
    }
    else {
        $response = [
            'status' => 'failed',
            'messsage' => 'Failed to accept follower request'
        ];
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}
