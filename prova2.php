<?php
require __DIR__.'/vendor/autoload.php';
$requestUserName = $fb->request('GET', '/me?fields=id,name');