<?php

require_once("../controller/StudentController.php");

if(isset($_POST['action']))
{
    $action = $_POST['action'];

    // ADD
    if($action == "add")
    {
        insertStudentController($_POST);
    }

    // FETCH
    if($action == "fetch")
    {
        $students = showStudentsController();

        while($row = mysqli_fetch_assoc($students))
        {
            echo "
            <tr>
                <td>{$row['id']}</td>
                <td>{$row['name']}</td>
                <td>{$row['department']}</td>
                <td>{$row['email']}</td>
                <td>{$row['cgpa']}</td>

                <td>
                    <button onclick='editStudent({$row['id']})'>
                        Edit
                    </button>

                    <button onclick='deleteStudent({$row['id']})'>
                        Delete
                    </button>
                </td>
            </tr>
            ";
        }
    }

    // DELETE
    if($action == "delete")
    {
        removeStudentController($_POST['id']);
    }

    // GET SINGLE
    if($action == "get")
    {
        $student = editStudentController($_POST['id']);

        echo json_encode($student);
    }

    // UPDATE
    if($action == "update")
    {
        updateStudentController($_POST);
    }
}

?>