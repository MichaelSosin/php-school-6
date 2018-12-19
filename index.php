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
        echo 'Status: ' . $this->_status . ', Grade Point Average: ' . round($this->_gpa, 2) . PHP_EOL;
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

$students = array(
    new Student('Mike', 'Barnes', 'male', 'freshman', 4),
    new Student('Jim', 'Nickerson', 'male', 'sophomore', 3),
    new Student('Jack', 'Indabox', 'male', 'junior', 2.5),
    new Student('Jane', 'Miller', 'female', 'senior', 3.6),
    new Student('Mary', 'Scott', 'female', 'senior', 2.7)
);

foreach($students as $student) {
    $student->introduce();
}

$studentsStudyTime = array(60, 100, 40, 30, 1000);

foreach($students as $index => $student) {
    $student->setStudyTime($studentsStudyTime[$index] / 60);
}

foreach($students as $student) {
    $student->introduce();
}