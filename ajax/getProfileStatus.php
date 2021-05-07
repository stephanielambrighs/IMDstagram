<?php

include_once(__DIR__ . "/../classes/Db.php");

if(!empty($_POST)){
    $userId = $_POST['userId'];

    // get old status and switch around
    $currentPrivacyStatus = Db::getUserPrivacyStatus($userId);

    // update db value
    $response = [
        'status' => htmlspecialchars($currentPrivacyStatus)
    ];

    header('Content-Type: application/json');
    echo json_encode($response);
}
