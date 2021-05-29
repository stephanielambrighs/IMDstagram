<?php
    include_once(__DIR__ . "/../classes/User.php");

    if (!empty($_POST)) {

        $user = new User();
        $user->setId($_POST['user_id']);
        $user->setFollowerId($_POST['follower_id']);


        // check if exists
        $followersRowId = Db::getFollowerRowId($user->getId(), $user->getFollowerId());

        // if id > 0 then there already is a row in db
        if ($followersRowId > 0) {
            $response = [
                'status' => 'Failed',
                'message' => 'Follower row already exists'
            ];
        }
        else {
            // try to insert
            $followSuccess = $user->follow();
            if ($followSuccess) {
                $response = [
                    'status' => 'Success',
                    'message' => 'Follow succes'
                ];
            }
            else {
                $response = [
                    'status' => 'Failed',
                    'message' => 'Follow failed'
                ];
            }
        }



    };

    header('Content-Type: application/json');
    echo json_encode($response);

