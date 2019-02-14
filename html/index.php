<?php
    require '/var/gitorg2tw/config.php';

    $header = getallheaders();
    $hmac = hash_hmac('sha1', file_get_contents("php://input"), SECRET);
    if (isset($header['X-Hub-Signature']) && $header['X-Hub-Signature']==='sha1='.$hmac) {
        $twitterText = '';
        $twitterText .= $_POST['repository']['full_name'].'/'.$_POST['ref']."\n";
        foreach ($_POST['commits'] as $commit) {
            $twitterText .= $commit->message."\n";
        }
        $twitterText .= $_POST['compare'];
        error_log($twitterText);
    }
?>
