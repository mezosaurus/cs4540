<?php

/*
* Author: Ethan Hayes
* Date: 2015
* PHP class for a user
*/

class User {
	private $userId;
    private $role;
	private $email;
	private $password;
	private $firstName;
	private $lastName;
	private $address;
	private $city;
	private $state;
	private $zip;
	private $phone;

	public function __construct($role, $userId, $email, $password, $firstName, $lastName, $address, $city, $state, $zip, $phone) {
        $this->role = $role;
        $this->userId = $userId;
        $this->email = $email;
        $this->password = $password;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->address = $address;
        $this->city = $city;
        $this->state = $state;
        $this->zip = $zip;
        $this->phone = $phone;
    }

    /*
    * String representation of User object
    */
    public function __toString() {
        return "

        ";
    }

    /*
    * Getters and setters for class variables
    */
    public function getRole() {
        return $this->role;
    }

    public function setRole($val) {
        $this->role = $val;
    }

    public function getUserId() {
    	return $this->userId;
    }

    public function setUserId($val) {
    	$this->userId = $val;
    }

    public function getEmail() {
    	return $this->email;
    }

    public function setEmail($val) {
    	$this->email = $val;
    }

    public function getName() {
    	return $this->firstName . ' ' . $this->lastName;
    }

    public function setName($val1, $val2) {
    	$this->firstName = $val1;
    	$this->lastName = $val2;
    }

    public function getAddress() {
    	return $this->address;
    }

    public function setAddress($val) {
    	$this->address = $val;
    }

    public function getCity() {
    	return $this->city;
    }

    public function setCity($val) {
    	$this->city = $val;
    }

    public function getState() {
    	return $this->state;
    }

    public function setState($val) {
    	$this->state = $val;
    }

    public function getZip() {
    	return $this->zip;
    }

    public function setZip($val) {
    	$this->zip = $val;
    }

    public function getPhone() {
    	return $this->phone;
    }

    public function setPhone($val) {
    	$this->phone = $val;
    }

}

?>