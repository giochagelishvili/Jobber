<?php

require_once('Headers.php');
require_once('Includes.php');

$data;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = decodeData();
}

if (isset($data['action'])) {
    $action = $data['action'];

    switch ($action) {
        case 'uploadJob':
            if (isset($data['formData'])) {
                uploadJob($data['formData']);
            }
            break;
    }
}

function uploadJob(array $formData)
{
    $errors = [];

    if (
        !isset($formData['jobTitle']) || $formData['jobTitle'] == '' ||
        !isset($formData['jobLocation']) || $formData['jobLocation'] == '' ||
        !isset($formData['jobType']) || $formData['jobType'] == '' ||
        !isset($formData['jobCategory']) || $formData['jobCategory'] == '' ||
        !isset($formData['jobDescription']) || $formData['jobDescription'] == '' ||
        !isset($formData['jobRequirements']) || $formData['jobRequirements'] == '' ||
        !isset($formData['salaryType']) || $formData['salaryType'] == '' ||
        !isset($formData['salaryAmount']) || $formData['salaryAmount'] == ''
    ) {
        array_push($errors, "Please fill out every field.");
        echo json_encode($errors);
        exit();
    }

    $validator = new Validator();
}

// Decodes received data
function decodeData()
{
    $postData = file_get_contents('php://input');
    return json_decode($postData, true);
}
