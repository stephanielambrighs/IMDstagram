<?php

include_once(__DIR__ . "/../classes/Db.php");

if(!empty($_POST)){
    $userId = $_POST['userId'];

    // get old status and switch around
    $currentPrivacyStatus = Db::getUserPrivacyStatus($userId);
    $newPrivacyStatus = !$currentPrivacyStatus;

    // update db value
    $updateSuccess = Db::setUserPrivacyStatus($userId, $newPrivacyStatus);
    if ($updateSuccess) {
        $response = [
            'status' => 'success',
            'messsage' => 'Successfully updated profile_private',
            'profile_private' => $newPrivacyStatus
        ];
    }
    else {
        $response = [
            'status' => 'failed',
            'messsage' => 'Failed to update profile_private',
            'profile_private' => $newPrivacyStatus
        ];
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}
