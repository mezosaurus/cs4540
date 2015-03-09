<?php

/*
* Author: Ethan Hayes
* Date: 2015
* PHP class for an applicant
*/

class Applicant {
	private $userId;
    private $appId;
	private $firstName;
	private $lastName;

	public function __construct($userId, $appId, $firstName, $lastName) {
        $this->userId = $userId;
        $this->appId = $appId;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }

    /*
    * Autoload function to avoid errors
    */
    function __autoload($class_name) {
        include strtolower($class_name) . '.php';
    }

    /*
    * String representation of User object
    */
    public function __toString() {
        return "
            <li>
            <div class='applicant'>
                " . $this->$firstName . " - <a href='#'>Application</a>
            </div>
            </li>
        ";
    }

    /*
    * Getters
    */
    public function getAppId() {
        return $this->appId;
    }

    public function getUserId() {
    	return $this->userId;
    }

    public function getName() {
    	return $this->firstName . ' ' . $this->lastName;
    }
}

?>