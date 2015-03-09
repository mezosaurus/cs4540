<?php

/*
* Author: Ethan Hayes
* Date: 2015
* PHP class for an application
*/

class Application {
 
    private $appId;
    private $userId;
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

	public function __construct($data) {
        $this->appId = $data['appId'];
        $this->userId = $data['userId'];
        $this->submitDate = $data['submitDate'];
        $this->unid = $data['unid'];
        $this->semester = $data['semester'];
        $this->year = $data['year'];
        $this->major = $data['major'];
        $this->gpa = $data['gpa'];
        $this->educationLevel = $data['educationLevel'];
        $this->available = $data['available'];
        $this->availableHours = $data['availableHours'];
        $this->transcriptPermission = $data['transcriptPermission'];
        $this->additionalInfo = $data['additionalInfo'];
        $this->graduateFinancialAid = $data['graduateFinancialAid'];
    }

    /*
    * Function to represent Application object as a string
    */
    public function __toString() {
        return " 
            <div class='application'>
                <p>Submitted on: " . $this->submitDate . " </p>
            </div>
        ";
    }

    /*
    * Getters and setters
    */
    public function getAppId() {
        return $this->appId;
    }

    public function setAppId($val) {
        $this->appId = $val;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function setUserId($val) {
        $this->userId = $val;
    }

    public function getSubmitDate() {
        return $this->submitDate;
    }

    public function setSubmitDate($val) {
        $this->submitDate = $val;
    }

    public function getUnid() {
        return $this->unid;
    }

    public function setUnid($val) {
        $this->unid = $val;
    }

    public function getSemester() {
        return $this->semester;
    }

    public function setSemester($val) {
        $this->appId = $val;
    }

    public function getYear() {
        return $this->year;
    }

    public function setYear($val) {
        $this->year = $val;
    }

    public function getMajor() {
        return $this->major;
    }

    public function setMajor($val) {
        $this->major = $val;
    }

    public function getGpa() {
        return $this->gpa;
    }

    public function setGpa($val) {
        $this->gpa = $val;
    }

    public function getEducationLevel() {
        return $this->educationLevel;
    }

    public function setEducationLevel($val) {
        $this->educationLevel = $val;
    }

    public function getAvailable() {
        return $this->available;
    }

    public function setAvailable($val) {
        $this->available = $val;
    }

    public function getAvailableHours() {
        return $this->availableHours;
    }

    public function setAvailableHours($val) {
        $this->availableHours = $val;
    }

    public function getTranscriptPermission() {
        return $this->transcriptPermission;
    }

    public function setTranscriptPermission($val) {
        $this->transcriptPermission = $val;
    }

    public function getAdditionalInfo() {
        return $this->additionalInfo;
    }

    public function setAdditionalInfo($val) {
        $this->additionalInfo = $val;
    }

    public function getGraduateFinancialAid() {
        return $this->graduateFinancialAid;
    }

    public function setGraduateFinancialAid($val) {
        $this->graduateFinancialAid = $val;
    }
}

?>