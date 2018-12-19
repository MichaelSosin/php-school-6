<?php

class Student {
    private static $_genderEnum = ['male', 'female']; 
    private static $_statusEnum = ['freshman', 'sophomore', 'junior', 'senior'];

    private $_firstName;
    private $_lastName;
    private $_gender;
    private $_status;
    private $_gpa;

    public function __construct($firstName, $lastName, $gender, $status, $gpa) {
        $this->_firstName = $firstName;
        $this->_lastName = $lastName;
        $this->_gpa = $gpa;

        if ($this->_validateGender($gender)) {
            $this->_gender = $gender;
        } else {
            throw new Exception('Invalid gender. Use on of: \'male\', \'female\'.');
        }

        if ($this->_validateStatus($status)) {
            $this->_status = $status;
        } else {
            throw new Exception('Invalid status. Use on of: \'freshman\', \'sophomore\', \'junior\', \'senior\'.');
        }
    }

    public function introduce() {
        echo 'Name: ' . $this->_firstName . ' ' . $this->_lastName . ', ' . $this->_gender . PHP_EOL;
        echo 'Status: ' . $this->_status . ', Grade Point Average: ' . $this->_gpa . PHP_EOL;
    }

    public function setStudyTime($studyTime) {
        $newGpa = $this->_gpa + log10($studyTime);
        if ($this->_validateGPA($newGpa)) {
            $this->_gpa = $newGpa;
        }
    }

    private function _validateGender($gender) {
        return in_array($gender, $this::$_genderEnum)
            ? TRUE
            : FALSE;
    }

    private function _validateStatus($gender) {
        return in_array($gender, $this::$_statusEnum)
            ? TRUE
            : FALSE;
    }

    private function _validateGPA($gpa) {
        return $gpa <= 4
            ? TRUE
            : FALSE;
    }
}

$student1 = new Student('vasya', 'pupkin', 'male', 'freshman', 3.5);

$student1->setStudyTime(3);

$student1->introduce();
