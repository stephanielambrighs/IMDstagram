<?php
    include_once(__DIR__ . "/../classes/User.php");

    if (!empty($_POST)) {

        $userId = $_POST['user_id'];
        $followerId = $_POST['follower_id'];

        // check if exists
        $followersRowId = Db::getFollowerRowId($userId, $followerId);

        // delete row
        $deleteSuccess = Db::deleteFollowersRow($followersRowId, 1);
        // var_dump($acceptSuccess);
        if ($deleteSuccess) {
            $response = [
                'status' => 'Success',
                'message' => 'Unfollow success'
            ];
        }
        else {
            $response = [
                'status' => 'Failed',
                'message' => 'Unfollow failed'
            ];
        }

    };

    header('Content-Type: application/json');
    echo json_encode($response);

