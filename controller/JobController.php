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
        case 'search':
            if (isset($data['keyword'])) {
                search($data['keyword']);
            }
            break;
        case 'getJob':
            if (isset($data['jobId'])) {
                getJob($data['jobId']);
            }
            break;
    }
}

function getJob(int $jobId)
{
    $table = "jobs";
    $condition = "job_id = '$jobId'";

    $db = new Database();
    $job = $db->fetch($table, $condition);

    echo json_encode($job);
}

function search(string $keyword)
{
    $table = "jobs";
    $condition = "job_title LIKE '%" . $keyword . "%'";

    $db = new Database();
    $relatedJobs = $db->fetch($table, $condition);
    echo json_encode($relatedJobs);
}

function applyFilters(array $filters)
{
    $table = "jobs";
    $condition = "";

    if (isset($filters['categoryFilter']) && $filters['categoryFilter'] != '' && $filters['categoryFilter'] != "All") {
        $categoryFilter = $filters['categoryFilter'];
        $condition = $condition . "job_category = '$categoryFilter'";
    }

    if (isset($filters['typeFilter']) && $filters['typeFilter'] != '' && $filters['typeFilter'] != "All") {
        $jobTypeFilter = $filters['typeFilter'];
        if ($condition != "") {
            $condition = $condition . "AND job_type = '$jobTypeFilter'";
        } else {
            $condition = $condition . "job_type = '$jobTypeFilter'";
        }
    }

    if (isset($filters['salaryTypeFilter']) && $filters['salaryTypeFilter'] != '' && $filters['salaryTypeFilter'] != "All") {
        $salaryTypeFilter = $filters['salaryTypeFilter'];
        if ($condition != "") {
            $condition = $condition . "AND salary_type = '$salaryTypeFilter'";
        } else {
            $condition = "salary_type = '$salaryTypeFilter'";
        }
    }

    $db = new Database();
    $filteredProducts = $db->fetch($table, $condition);
    echo json_encode($filteredProducts);
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
