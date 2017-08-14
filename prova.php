<?php
require __DIR__.'/vendor/autoload.php';

$myfile = fopen("photo/access_token.txt", "r") or die("Unable to open file!");
$a_token = fread($myfile,filesize("photo/access_token.txt"));
fclose($myfile);

echo $a_token;


$fb = new Facebook\Facebook([
    'app_id' => '1555174697849814',
    'app_secret' => 'df6dabb17ee347f840910def6f49e11f',
    'default_graph_version' => 'v2.9',
]);

//$fb->get('359734667794410?fields=access_token',$a_token);
$requestUserName = $fb->request('GET', '/me/accounts', [],$a_token);
echo print_r($requestUserName);