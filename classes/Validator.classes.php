<?php

require_once("Database.classes.php");

class Validator
{
    private string $jobTitle;
    private string $jobLocation;
    private string $jobType;
    private string $jobCategory;
    private string $jobDescription;
    private string $jobRequirements;
    private string $salaryType;
    private string $salaryAmount;
    private array $errors = [];

    public function __construct(string $jobTitle, string $jobLocation, string $jobType, string $jobCategory, string $jobDescription, string $jobRequirements, string $salaryType, string $salaryAmount)
    {
        $this->jobTitle = $jobTitle;
        $this->jobLocation = $jobLocation;
        $this->jobType = $jobType;
        $this->jobCategory = $jobCategory;
        $this->jobDescription = $jobDescription;
        $this->jobRequirements = $jobRequirements;
        $this->salaryType = $salaryType;
        $this->salaryAmount = $salaryAmount;
    }

    public function validateForm()
    {
        if ($this->validateTitle() === false) {
            array_push($this->errors, "Title must be less than 256 characters.");
        }

        if ($this->validateLocation() === false) {
            array_push($this->errors, "Please provide location in the following format: 'Batumi, Adjara, Georgia'.");
        }

        if ($this->validateType() === false) {
            array_push($this->errors, "Invalid job type. Please select from the options.");
        }

        if ($this->validateCategory() === false) {
            array_push($this->errors, "Invalid job category. Please select from the options.");
        }

        if ($this->validateDescription() === false) {
            array_push($this->errors, "Description must be at least 100 and less than 2500 characters.");
        }

        if ($this->validateRequirements() === false) {
            array_push($this->errors, "Requirements must be at least 10 and less than 500 characters.");
        }

        if ($this->validateSalaryType() === false) {
            array_push($this->errors, "Invalid salary type. Please select from the options.");
        }

        if ($this->validateSalaryAmount() === false) {
            array_push($this->errors, "Salary amount must be numeric, greater than 0 value.");
        }

        return $this->errors;
    }

    private function validateSalaryAmount()
    {
        $amount = $this->salaryAmount;

        if (is_numeric($amount)) {
            if ($amount > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    private function validateSalaryType()
    {
        $type = $this->salaryType;
        $salaryTypes = ["Hourly", "Weekly", "Monthly"];

        foreach ($salaryTypes as $salaryType) {
            if (strcmp($type, $salaryType) === 0) {
                return true;
            }
        }

        return false;
    }

    private function validateRequirements()
    {
        $requirements = $this->jobRequirements;
        $length = strlen($requirements);

        if ($length < 10 || $length > 500) {
            return false;
        } else {
            return true;
        }
    }

    private function validateDescription()
    {
        $description = $this->jobDescription;
        $length = strlen($description);

        if ($length < 100 || $length > 2500) {
            return false;
        } else {
            return true;
        }
    }

    private function validateCategory()
    {
        $category = $this->jobCategory;

        $db = new Database();
        $table = "job_categories";
        $condition = "job_category = '$category'";
        $jobCategory = $db->fetch($table, $condition);

        if (count($jobCategory) > 0) {
            if (strcmp($category, $jobCategory[0]['job_category']) === 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    private function validateTitle()
    {
        $title = $this->jobTitle;

        if (strlen($title) > 255) {
            return false;
        } else {
            return true;
        }
    }

    private function validateLocation()
    {
        $location = $this->jobLocation;

        if (preg_match('/^[A-Za-z0-9,]+$/', $location)) {
            return true;
        } else {
            return false;
        }
    }

    private function validateType()
    {
        $type = $this->jobType;
        $jobTypes = ["fullTime", "partTime", "contract", "internship"];

        foreach ($jobTypes as $jobType) {
            if (strcasecmp($jobType, $type) === 0) {
                return true;
            }
        }
        return false;
    }
}
