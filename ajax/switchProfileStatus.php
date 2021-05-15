<?php

include_once(__DIR__ . "/../classes/Db.php");

if(!empty($_POST)){
    $userId = $_POST['userId'];
    $user = new User();
    $user->setId($userId);

    // get old status and switch around
    $currentPrivacyStatus = $user->getUserPrivacyStatus();
    $newPrivacyStatus = !$currentPrivacyStatus;

    // update db value
    $updateSuccess = $user->setUserPrivacyStatus($newPrivacyStatus);
    if ($updateSuccess) {
        $response = [
            'status' => 'success',
            'messsage' => 'Successfully updated profile_private',
            'profile_private' => htmlspecialchars($newPrivacyStatus)
        ];
    }
    else {
        $response = [
            'status' => 'failed',
            'messsage' => 'Failed to update profile_private',
            'profile_private' => htmlspecialchars($newPrivacyStatus)
        ];
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}
