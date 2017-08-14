<?php
require __DIR__.'/vendor/autoload.php';
if(!session_id()) {
    session_start();
}
use Facebook\FacebookRequest;

$fb = new Facebook\Facebook([
    'app_id' => '1555174697849814',
    'app_secret' => 'df6dabb17ee347f840910def6f49e11f',
    'default_graph_version' => 'v2.9',
]);
$fbApp = new Facebook\FacebookApp('1555174697849814', 'df6dabb17ee347f840910def6f49e11f');

$request = new FacebookRequest($fbApp, 'EAAWGbFNt09YBAEO8qKXqzLYGbUOUZBjVAT8N7h2yp29uXAroSzDrlTUlIVZBf3DvSm9jxowQTOxEd5lnwI7TreFO5BNdHWFUOa9jdWA55ieWKqpyaDYCyE6HKyeeRkrWNk9bG7OdYn6U87VkZCMsINIY7SmJpEZD', 'GET', '/me/accounts/');
//$request = $fb->request('GET', '/me/accounts');
//$fb->get('359734667794410?fields=access_token',$a_token);
try {
    $response = $fb->getClient()->sendRequest($request);
    echo 'miao';
} catch(Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}

$graphNode = $response->getGraphNode();