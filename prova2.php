<?php
require __DIR__.'/vendor/autoload.php';
$fb = new Facebook\Facebook([
    'app_id' => '1555174697849814',
    'app_secret' => 'df6dabb17ee347f840910def6f49e11f',
    'default_graph_version' => 'v2.9',
]);
$response=$fb->get('359734667794410?fields=access_token','EAAWGbFNt09YBAAtBXKaZBEAIVFwxR0dZABajOIcgyZB4qj9Qiz8zXoh32RDr5ZBZCCIxZChlJzGic2ITktTyU4zPjh1kVDI0KClifml5JK2EhOAEg0LUFhAJbbCH8QyjscEyFe9suoydP7T1I93Glus1SPqKyZC02wZD');
print_r($response->getGraphNode());