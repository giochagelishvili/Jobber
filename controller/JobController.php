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

// Selects single job from the database according to given job ID
// Returns results to 'JobView' component
function getJob(int $jobId)
{
    $table = "jobs";
    $condition = "job_id = '$jobId'";

    $db = new Database();
    $job = $db->fetch($table, $condition);

    echo json_encode($job);
}

// Selects jobs from the database if 'job_title' includes passed $keyword
// Returns result(s) to 'ExploreMain' component 
function search(string $keyword)
{
    $table = "jobs";
    $condition = "job_title LIKE '%" . $keyword . "%'";

    $db = new Database();
    $relatedJobs = $db->fetch($table, $condition);
    echo json_encode($relatedJobs);
}

// Selects jobs from the database according to passed filters (e.g. category (IT, Healthcare etc.))
// Returns result(s) to 'ExploreMain' component
function applyFilters(array $filters)
{
    $table = "jobs";
    $condition = "";

    // Check if job category filter is set
    if (isset($filters['categoryFilter']) && $filters['categoryFilter'] != '' && $filters['categoryFilter'] != "All") {
        $categoryFilter = $filters['categoryFilter'];

        // Add condition (e.g. "job_category = 'Healthcare'")
        $condition = $condition . "job_category = '$categoryFilter'";
    }

    // Check if job type filter is set
    if (isset($filters['typeFilter']) && $filters['typeFilter'] != '' && $filters['typeFilter'] != "All") {
        $jobTypeFilter = $filters['typeFilter'];

        // If there already is condition
        if ($condition != "") {
            // Add condition (e.g. "job_type = 'Full-Time'")
            $condition = $condition . "AND job_type = '$jobTypeFilter'";
        } else {
            // If there is no condition yet
            $condition = $condition . "job_type = '$jobTypeFilter'";
        }
    }

    // Check if salary type filter is set
    if (isset($filters['salaryTypeFilter']) && $filters['salaryTypeFilter'] != '' && $filters['salaryTypeFilter'] != "All") {
        $salaryTypeFilter = $filters['salaryTypeFilter'];

        // Check for any existing conditions
        if ($condition != "") {
            $condition = $condition . "AND salary_type = '$salaryTypeFilter'";
        } else {
            // Add condition (e.g. "salary_type = 'Hourly'")
            $condition = "salary_type = '$salaryTypeFilter'";
        }
    }

    // Create new database and fetch results according to filters
    $db = new Database();
    $filteredProducts = $db->fetch($table, $condition);

    // Return results to 'ExploreMain' component
    echo json_encode($filteredProducts);
}

// Selects everything from "jobs" table and returns result to 'ExploreMain' component
function getAllJobs()
{
    $db = new Database();
    $jobs = $db->fetch("jobs");
    echo json_encode($jobs);
}

// Accepts and validates form data
// Returns $errors array to 'UploadMain' component in case of invalid data
// Else inserts new job to the database
function uploadJob(array $formData)
{
    // Initialize errors array
    $errors = [];

    // Check if every field is set / filled
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
        // Return errors and exit the code if any field is left blank
        array_push($errors, "Please fill out every field.");
        echo json_encode($errors);
        exit();
    }

    // Form data
    $jobTitle = $formData['jobTitle'];
    $jobLocation = $formData['jobLocation'];
    $jobType = $formData['jobType'];
    $jobCategory = $formData['jobCategory'];
    $jobDescription = $formData['jobDescription'];
    $jobRequirements = $formData['jobRequirements'];
    $salaryType = $formData['salaryType'];
    $salaryAmount = $formData['salaryAmount'];

    // Create new validator object and validate form data
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

    // $validation returns errors array in case of invalid data
    // Return errors and exit the program
    if ($validation !== true) {
        echo json_encode($validation);
        exit();
    }

    // Create new database object and insert new job to "jobs" table
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

// Selects everything from "job_categories" table and returns results to 'UploadMain' component
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
