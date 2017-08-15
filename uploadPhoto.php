<?php
$invia=false;
$invia=true;
header('Access-Control-Allow-Origin: *');
$img=$_POST["image"];
$token_accesso=$_POST["token_accesso"];
$id_pagina=$_POST["id_pagina"];
$id_album=$_POST["id_album"];
$token_pagina=$_POST["token_pagina"];
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
$filePath2 = 'photo/log_f.txt';


if($invia) {

    $fb = new Facebook\Facebook([
        'app_id' => '1555174697849814',
        'app_secret' => 'df6dabb17ee347f840910def6f49e11f',
        'default_graph_version' => 'v2.9',
    ]);

    $data = [
        'message' => 'Selfie Machine',
        'source' => $fb->fileToUpload("$filePath")
    ];

    try {
        // Returns a `Facebook\FacebookResponse` object
        //$response = $fb->post('/359734667794410/photos', $data,  'EAAWGbFNt09YBAJmGd0s2Lj0WabZCxgpXpuqiYz4rvqCxAE71IfODwvjQpB0SAvX1aj9MEJFHQIdtUQZAWnhUzT5ovwZCBlW6O2QmmZBBR8VXod7GtxNaNJmi2LE9gdhUd7H0ZAdDXtfMzL3D2N7YBUOZA3eK9GpapIgkFxpXeHaQZDZD');
        if (isset($id_album)) {
            $response = $fb->post("/$id_album/photos", $data, $token_pagina);
        }else if(isset($id_pagina)){
            $response = $fb->post("/$id_pagina/photos", $data,  $token_pagina);
        }else if(isset($token_accesso)){
            $response = $fb->post('/me/photos', $data,  $token_accesso);
        }
    } catch(Facebook\Exceptions\FacebookResponseException $e) {
        $file = fopen($filePath2, 'w');
        fwrite($file, $e->getMessage());
        fclose($file);
        echo 'Graph returned an error: ' . $e->getMessage();
        exit;
    } catch(Facebook\Exceptions\FacebookSDKException $e) {
        $file = fopen($filePath2, 'w');
        fwrite($file, $e->getMessage());
        fclose($file);
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
    }
    echo "ok";
}
else{
    echo $filePath;
}


