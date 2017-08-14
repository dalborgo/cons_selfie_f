<?php
$invia=false;
$invia=true;
header('Access-Control-Allow-Origin: *');
$img=$_POST["image"];
$imgData = str_replace('data:image/jpeg;base64,', '', $img);
$imgData = str_replace(' ','+',$imgData );
$imgData = base64_decode($imgData);
// Path where the image is going to be saved
$ora=date('Y-m-d-H-i-s');
$ora2=date('d/m/Y H:i');
$filePath = 'photo/Asten '.$ora.'.jpg';
// Write $imgData into the image file
$file = fopen($filePath, 'w');
fwrite($file, $imgData);
fclose($file);

set_time_limit(0);
date_default_timezone_set('UTC');

require __DIR__.'/vendor/autoload.php';

$myfile = fopen("photo/access_token.txt", "r") or die("Unable to open file!");
$a_token = fread($myfile,filesize("photo/access_token.txt"));
fclose($myfile);

if($invia) {

    $fb = new Facebook\Facebook([
        'app_id' => '1555174697849814',
        'app_secret' => 'df6dabb17ee347f840910def6f49e11f',
        'default_graph_version' => 'v2.9',
    ]);

    $data = [
        'message' => 'Selfie Machine',
        'source' => $fb->fileToUpload("$filePath"),
    ];

    try {
        // Returns a `Facebook\FacebookResponse` object
        //$response = $fb->post('/me/photos', $data,  $a_token);
        /*$response = $fb->get('/me/accounts', 'EAAWGbFNt09YBADo2YO6IZCpkTVEqUCTnXYawiOZCkoUI2n6aQDY44bcpvUEAmvIpCKDZAv5nac5NyNT02VLOVk1MLg2aVdK9gnAz1tKVFHgWGMTCSCzq9hiFYhf2XXzKsf2FtGZBGUbde4MV1iXZALXph9rLWD8gZD');
        $filePath = 'photo/pages_token.txt';
        $file = fopen($filePath, 'w');
        fwrite($file, json_encode($response));
        fclose($file);*/
    } catch(Facebook\Exceptions\FacebookResponseException $e) {
        echo 'Graph returned an error: ' . $e->getMessage();
        exit;
    } catch(Facebook\Exceptions\FacebookSDKException $e) {
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
    }
    echo "ok";
}
else{
    echo $filePath;
}


