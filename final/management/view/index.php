<!DOCTYPE html>
<html>
<head>

    <title>Student Management System</title>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

</head>

<body>

<h2>Student Management System</h2>

<input type="hidden" id="student_id">

<input type="text" id="name" placeholder="Student Name">

<input type="text" id="department" placeholder="Department">

<input type="email" id="email" placeholder="Email">

<input type="text" id="cgpa" placeholder="CGPA">

<button id="addBtn">Add Student</button>

<button id="updateBtn" style="display:none;">
    Update Student
</button>

<hr>

<table border="1" cellpadding="10">

    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Department</th>
            <th>Email</th>
            <th>CGPA</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody id="studentData">

    </tbody>

</table>

<script src="script.js"></script>

</body>
</html>