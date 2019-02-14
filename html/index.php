<?php
    require '/var/gitorg2tw/config.php';

    $header = getallheaders();
    $hmac = hash_hmac('sha1', file_get_contents("php://input"), SECRET);
    if (isset($header['X-Hub-Signature']) && $header['X-Hub-Signature']==='sha1='.$hmac) {
        error_log('OK');
    }else{
        error_log('NG');
    }
    // error_log(print_r($_POST, true));
?>
