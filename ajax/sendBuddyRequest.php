<?php
    include_once '../classes/Request.php';
    include_once '../classes/Db.php';
    $id = $_POST['id'];
    $uid = $_POST['uid'];
    $email = $_POST['email'];
    $person = $_POST['person'];
    $response = [];
    if (Request::sendRequest($id, $uid, $email, $person)) {
        $response['status'] = 'success';
    } else {
        $response['status'] = 'something went wrong.';
    }
    header('Content-Type: application/json');
    echo json_encode($response);