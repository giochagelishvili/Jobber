<?php

require_once('Headers.php');
// require_once('Includes.php');

$data;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = decodeData();
}

// Decodes received data
function decodeData()
{
    $postData = file_get_contents('php://input');
    return json_decode($postData, true);
}
