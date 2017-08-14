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
   // $fb->setExtendedAccessToken();
    $accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}

if (!isset($accessToken)) {
    if ($helper->getError()) {
        header('HTTP/1.0 401 Unauthorized');
        echo "Error: " . $helper->getError() . "\n";
        echo "Error Code: " . $helper->getErrorCode() . "\n";
        echo "Error Reason: " . $helper->getErrorReason() . "\n";
        echo "Error Description: " . $helper->getErrorDescription() . "\n";
    } else {
        header('HTTP/1.0 400 Bad Request');
        echo 'Bad request';
    }
    exit;
}
$oAuth2Client = $fb->getOAuth2Client();
if (! $accessToken->isLongLived()) {
    // Exchanges a short-lived access token for a long-lived one
    try {
        $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
        // Logged in!
        //$_SESSION['facebook_access_token3'] = (string) $accessToken;
        $filePath = 'photo/access_token.txt';
        $file = fopen($filePath, 'w');
        fwrite($file, (string) $accessToken);
        fclose($file);
        header("location: http://localhost:50000");
        // Now you can redirect to another page and use the
        // access token from $_SESSION['facebook_access_token']
    } catch (Facebook\Exceptions\FacebookSDKException $e) {
        echo "<p>Error getting long-lived access token: " . $e->getMessage() . "</p>\n\n";
        exit;
    }

    echo '<h3>Long-lived</h3>';
    var_dump($accessToken->getValue());
}