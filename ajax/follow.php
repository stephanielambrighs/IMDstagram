<?php
    include_once(__DIR__ . "/../classes/User.php");

    if (!empty($_POST)) {
        echo "😇";

        $follow = new User();
        $follow->setId($_POST['user_id']);
        $follow->setFollowerId($_POST['follower_id']);

        $res = $follow->follow();

        /*$response = [
            'status' => 'succes',
            'body' => htmlspecialchars($follow->get)
            'message' => 'Follow succes'
        ]*/
    }

?>