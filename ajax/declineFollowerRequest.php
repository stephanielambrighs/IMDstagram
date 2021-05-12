<?php

include_once(__DIR__ . "/../classes/Db.php");

if(!empty($_POST)){
    $userId = $_POST['userId'];
    $followerId = $_POST['followerId'];

    // get follower row id
    $followersRowId = Db::getFollowerRowId($userId, $followerId);

    // delete row
    $deleteSuccess = Db::deleteFollowersRow($followersRowId, 1);
    // var_dump($acceptSuccess);
    if ($deleteSuccess) {
        $response = [
            'status' => 'success',
            'messsage' => 'Successfully deleted follower request'
        ];
    }
    else {
        $response = [
            'status' => 'failed',
            'messsage' => 'Failed to delete follower request'
        ];
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}
