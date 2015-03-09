<?php

/*
* Author: Ethan Hayes
* Date: 2015
* PHP class for an application
*/

class Application {
 
    private $appId;
    private $submitDate;
    private $unid;
    private $semester;
    private $year;
    private $major;
    private $gpa;
    private $educationLevel;
    private $available;
    private $availableHours;
    private $transcriptPermission;
    private $additionalInfo;
    private $graduateFinancialAid;
    private $employerName;
    private $employmentHours;
    private $employMentDescription;

	public function __construct($appId, $submitDate, $unid, $semester, $year, $major, $gpa,
                        $educationLevel, $available, $availableHours, $transcriptPermission, $additionalInfo,
                        $graduateFinancialAid, $employerName, $employmentHours, $employmentDescription) {
        $this->appId = $appId;
        $this->submitDate = $submitDate;
        $this->unid = $unid;
        $this->semester = $semester;
        $this->year = $year;
        $this->major = $major;
        $this->gpa = $gpa;
        $this->educationLevel = $educationLevel;
        $this->available = $available;
        $this->availableHours = $avaiilableHours;
        $this->transcriptPermission = $transcriptPermission;
        $this->additionalInfo = $additionalInfo;
        $this->graduateFinancialAid = $graduateFinancialAid;
        $this->employerName = $employerName;
        $this->employmentHours = $employmentHours;
        $this->employmentDescription =  $employmentDescription;
    }

    /*
    * Autoload function to avoid errors
    */
    function __autoload($class_name) {
        include strtolower($class_name) . '.php';
    }

    /*
    * Function to represent Application object as a string
    */
    public function __toString() {
        $output .= "<h3>Application submitted for: " . $this->semester . $this->year . "</h3><br/><br/>"
                . "<div class='section'>"
                . "<div class='header'>Personal Information</div>"
                . "<p>University ID: " . $this->unid . "</p>"
                . "</div>"
                . "<div class='section'>"
                . "<div class='header'>School Information</div>"
                . "<p>Major: " . $this->major . "</p>"
                . "<p>Education Level: " . $this->educationLevel . "</p>"
                . "<p>GPA: " . $this->gpa . "</p>"
                . "</div>";
                if ($this->employerName != '') {
                    $output .= "<div class='section'>"
                    . "<div class='header'>Employment Information</div>"
                    . "<p>Employer name: " . $this->employerName . "</p>"
                    . "<p>Hours at other employment: " . $this->employmentHours . "</p>"
                    . "<p>Description of other employment: " . $this->employmentDescription . "</p>"
                    . "</div>";
                }
                $output .= "<div class='section'>"
                . "<div class='header'>Availability</div>";
                if ($this->available == '0') {
                    $output .= "<p>Available the week before school starts: No</p>";
                }
                else {
                    $output .= "<p>Available the week before school starts: Yes</p>";
                }
                $output .= "<p>Hours available to work weekly: " . $this->availableHours . "</p>"
                . "</div>"
                . "<div class='section'>"
                . "<div class='header'>Additional Information</div>";
                if ($this->transcriptPermission== '0') {
                    $output .= "<p>Permission denied for School of Computing to review grades and transcript.</p>";
                }
                else {
                    $output .= "<p>Permission granted for School of Computing to review grades and transcript.</p>";
                }
                if ($this->graduateFinancialAid == '0') {
                    $output .= "<p>Graduate financial aid promised as part of acceptance: No</p>";
                }
                else {
                    $output .= "<p>Graduate financial aid promised as part of acceptance: Yes</p>";
                }
                $output .= "<p>Additional application information:" . $this->additionalInfo . "</p>"
                . "</div>";
        return $output;
    }

    /*
    * Getters
    */
    public function getAppId() {
        return $this->appId;
    }

    public function getSubmitDate() {
        return $this->submitDate;
    }

    public function getUnid() {
        return $this->unid;
    }

    public function getSemester() {
        return $this->semester;
    }

    public function getYear() {
        return $this->year;
    }

    public function getMajor() {
        return $this->major;
    }

    public function getGpa() {
        return $this->gpa;
    }

    public function getEducationLevel() {
        return $this->educationLevel;
    }

    public function getAvailable() {
        return $this->available;
    }

    public function getAvailableHours() {
        return $this->availableHours;
    }

    public function getTranscriptPermission() {
        return $this->transcriptPermission;
    }

    public function getAdditionalInfo() {
        return $this->additionalInfo;
    }

    public function getGraduateFinancialAid() {
        return $this->graduateFinancialAid;
    }
}

?>