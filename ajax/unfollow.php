<?php
    include_once(__DIR__ . "/../classes/User.php");

    if (!empty($_POST)) {
        echo "😇";

        $unfollow = new User();
        $unfollow->setId($_POST['user_id']);
        $unfollow->setFollowerId($_POST['follower_id']);

        $res = $unfollow->unfollow();

        // $response = [
        //     'status' => 'success',
        //     'body' => htmlspecialchars($follow->get),
        //     'message' => 'Follow succes'
        // ]
    }

    header('Content-Type: application/json');
    echo json_encode($response);
?>