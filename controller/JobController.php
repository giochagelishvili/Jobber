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
        case 'getJobCategories':
            getJobCategories();
            break;
        case 'getAllJobs':
            getAllJobs();
            break;
        case 'applyFilters':
            if (isset($data['formData'])) {
                applyFilters($data['formData']);
            }
            break;
    }
}

function applyFilters(array $filters)
{
    $categoryFilter = '';
    $jobTypeFilter = '';
    $salaryTypeFilter = '';

    if (isset($filters['categoryFilter']) && $filters['categoryFilter'] != '') {
        $categoryFilter = $filters['categoryFilter'];
    }

    if (isset($filters['typeFilter']) && $filters['typeFilter'] != '') {
        $jobTypeFilter = $filters['typeFilter'];
    }

    if (isset($filters['salaryTypeFilter']) && $filters['salaryTypeFilter'] != '') {
        $salaryTypeFilter = $filters['salaryTypeFilter'];
    }

    echo $categoryFilter;
    echo $jobTypeFilter;
    echo $salaryTypeFilter;
}

function getAllJobs()
{
    $db = new Database();
    $jobs = $db->fetch("jobs");
    echo json_encode($jobs);
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

    $jobTitle = $formData['jobTitle'];
    $jobLocation = $formData['jobLocation'];
    $jobType = $formData['jobType'];
    $jobCategory = $formData['jobCategory'];
    $jobDescription = $formData['jobDescription'];
    $jobRequirements = $formData['jobRequirements'];
    $salaryType = $formData['salaryType'];
    $salaryAmount = $formData['salaryAmount'];


    $validator = new Validator(
        $jobTitle,
        $jobLocation,
        $jobType,
        $jobCategory,
        $jobDescription,
        $jobRequirements,
        $salaryType,
        $salaryAmount,
    );

    $validation = $validator->validateForm();

    if ($validation !== true) {
        echo json_encode($validation);
        exit();
    }

    $db = new Database();
    $table = "jobs(job_title, job_location, job_type, job_category, job_description, job_requirements, salary_type, salary_amount)";
    $values = [
        $jobTitle,
        $jobLocation,
        $jobType,
        $jobCategory,
        $jobDescription,
        $jobRequirements,
        $salaryType,
        $salaryAmount,
    ];
    $db->insert($table, $values);
}

function getJobCategories()
{
    $db = new Database();
    $jobCategories = $db->fetch('job_categories');
    echo json_encode($jobCategories);
}

// Decodes received data
function decodeData()
{
    $postData = file_get_contents('php://input');
    return json_decode($postData, true);
}
