<?php

require_once("../model/StudentModel.php");

function insertStudentController($data)
{
    return addStudent(
        $data['name'],
        $data['department'],
        $data['email'],
        $data['cgpa']
    );
}

function showStudentsController()
{
    return getStudents();
}

function removeStudentController($id)
{
    return deleteStudent($id);
}

function editStudentController($id)
{
    return getStudentById($id);
}

function updateStudentController($data)
{
    return updateStudent(
        $data['id'],
        $data['name'],
        $data['department'],
        $data['email'],
        $data['cgpa']
    );
}

?>