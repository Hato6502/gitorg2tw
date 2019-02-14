<?php
    require '/var/www/config.php';

    $header = getallheaders();
    $hmac = hash_hmac($HTTP_RAW_POST_DATA, SECRET);
    if (isset($header['X-Hub-Signature']) && $header['X-Hub-Signature']==='sha1='.$hmac) {
        error_log('OK');
    }
    // error_log(print_r($_POST, true));
?>
