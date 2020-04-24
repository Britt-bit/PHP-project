<?php
    include_once '../classes/Request.php';
    include_once '../classes/Db.php';
    $id = $_POST['id'];
    $uid = $_POST['uid'];
    $email = $_POST['email'];
    $person = $_POST['person'];
    $header = 'From: Buddy <buddy@hotmail.com> \r\n';
    $response = [];
    mail('vanhuynegem.n@hotmail.com', 'Buddy Request', $person + 'wants to be your buddy.', $header);
    if (Request::sendRequest($id, $uid)) {
        $response['status'] = 'success';
    } else {
        $response['status'] = 'something went wrong.';
    }
    header('Content-Type: application/json');
    echo json_encode($response);