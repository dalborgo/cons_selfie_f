<?php
# login-callback.php
require_once __DIR__ . '/vendor/autoload.php';
//require_once __DIR__ . '/vendor/facebook/graph-sdk/src/Facebook/autoload.php';
if(!session_id()) {
    session_start();
}
$fb = new Facebook\Facebook([
    'app_id' => '1555174697849814',
    'app_secret' => 'df6dabb17ee347f840910def6f49e11f',
    'default_graph_version' => 'v2.9',
]);

$helper = $fb->getRedirectLoginHelper();
try {
    $accessToken = $helper->getAccessToken();
    $mio=$fb->get('359734667794410?fields=access_token',$accessToken);
    print_r($mio);
} catch(Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}

if (isset($accessToken)) {
    // Logged in!
    //$_SESSION['facebook_access_token'] = (string) $accessToken;
    $filePath = 'photo/access_token.txt';
    $file = fopen($filePath, 'w');
    fwrite($file, (string) $mio);
    fclose($file);
    //header("location: http://localhost:50000/");
    // Now you can redirect to another page and use the
    // access token from $_SESSION['facebook_access_token']
}