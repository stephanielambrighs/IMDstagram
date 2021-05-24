<?php

include_once(__DIR__ . "/../classes/Db.php");

if(!empty($_POST)){
    $userId = $_POST['userId'];
    $user = new User();
    $user->setId($userId);

    // get old status and switch around
    $currentPrivacyStatus = $user->getUserPrivacyStatus();

    // update db value
    $response = [
        'status' => htmlspecialchars($currentPrivacyStatus)
    ];

    header('Content-Type: application/json');
    echo json_encode($response);
}
