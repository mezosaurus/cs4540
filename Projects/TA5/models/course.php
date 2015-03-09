<?php

/*
* Author: Ethan Hayes
* Date: 2015
* PHP class for a course
*/

class Course {

    private $courseId;
    private $courseNumber;
    private $name;
    private $blurb;

	public function __construct($data) {
        $this->courseId = $data['courseId'];
        $this->courseNumber = $data['courseNumber'];
        $this->name = $data['name'];
        $this->blurb = $data['blurb'];
    }

    /*
    * Autoload function to avoid errors
    */
    function __autoload($class_name) {
        include strtolower($class_name) . '.php';
    }

    /*
    * String representation of Course object
    */
    public function __toString() {
        return "
            <div class='course'>
                <h3>CS " . $this->courseNumber . " - " . $this->name . "</h3>
                <p>Description: " . $this->blurb . "</p>
            </div>
        ";
    }

    public function getCourseId() {
        return $this->courseId;
    }

    public function getCourseNumber() {
        return $this->courseNumber;
    }

    public function getName() {
        return $this->name;
    }

    public function getBlurb() {
        return $this->blurb;
    }
}

?>