<?php
    include_once(__DIR__ . "/../classes/User.php");

    if (!empty($_POST)) {

        $userId = $_POST['user_id'];
        $followerId = $_POST['follower_id'];

        // check if exists
        $followersRowId = Db::getFollowerRowId($userId, $followerId);


        if ($followersRowId > 0){
            $response = [
                'status' => 'present',
            ];
        }
        else {
            $response = [
                'status' => 'absent',
            ];
        }


    };

    header('Content-Type: application/json');
    echo json_encode($response);

