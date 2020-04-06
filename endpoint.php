<?php

if(!empty($_POST['comment'])) {
    $message = $_POST['comment'];
    $_SESSION['messages'][] = $message;


    $response = [
        'status' => 'saved'
    ];
    print json_encode($response);
}
