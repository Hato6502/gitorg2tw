<?php
    require '/var/gitorg2tw/config.php';
    require "twitteroauth/autoload.php";
    use Abraham\TwitterOAuth\TwitterOAuth;

    $header = getallheaders();
    $json = file_get_contents("php://input");
    $hmac = hash_hmac('sha1', $json, GITHUB_WEBHOOK_SECRET);
    if (isset($header['X-Hub-Signature']) && $header['X-Hub-Signature']==='sha1='.$hmac) {
        $payload = json_decode($json, true);
        $twitterText = '';
        $twitterText .= $payload['repository']['full_name'].'リポジトリ '.preg_replace('/^refs\/heads\//', '', $payload['ref'])."ブランチを更新しました。\n\n";
        foreach ($payload['commits'] as $commit) {
            $twitterText .= $commit['message']."\n";
        }
        $twitterText .= "\n".$payload['compare'];

        $twitter = new TwitterOAuth(TWITTER_CONSUMER_KEY, TWITTER_CONSUMER_SECRET, TWITTER_ACCESS_TOKEN, TWITTER_ACCESS_TOKEN_SECRET);
        $response = $twitter->post('statuses/update', ['status' => $twitterText]);
        if ($twitter->getLastHttpCode() != 200) {
            throw new Exception(print_r($response, true));
        }
    }
?>
