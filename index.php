<?php
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
//$permissions = ['email', 'user_likes','publish_actions']; // optional
    $permissions = ['publish_actions','publish_pages','manage_pages']; // optional
    $loginUrl = $helper->getLoginUrl('http://localhost/cons_selfie_f/login-callback.php', $permissions);
    header("location: $loginUrl");

//echo '<a href="' . $loginUrl . '">Collegati con Facebook</a>';