<?php

require_once("../config/db.php");

function addStudent($name, $department, $email, $cgpa)
{
    global $conn;

    $sql = "INSERT INTO students(name, department, email, cgpa)
            VALUES('$name','$department','$email','$cgpa')";

    return mysqli_query($conn, $sql);
}

function getStudents()
{
    global $conn;

    $sql = "SELECT * FROM students";

    return mysqli_query($conn, $sql);
}

function deleteStudent($id)
{
    global $conn;

    $sql = "DELETE FROM students WHERE id=$id";

    return mysqli_query($conn, $sql);
}

function getStudentById($id)
{
    global $conn;

    $sql = "SELECT * FROM students WHERE id=$id";

    $result = mysqli_query($conn, $sql);

    return mysqli_fetch_assoc($result);
}

function updateStudent($id, $name, $department, $email, $cgpa)
{
    global $conn;

    $sql = "UPDATE students
            SET name='$name',
                department='$department',
                email='$email',
                cgpa='$cgpa'
            WHERE id=$id";

    return mysqli_query($conn, $sql);
}

?>