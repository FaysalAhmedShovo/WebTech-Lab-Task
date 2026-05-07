$(document).ready(function(){

    loadStudents();

    // LOAD
    function loadStudents()
    {
        $.ajax({
            url: "../ajax/studentHandler.php",
            type: "POST",

            data: {
                action: "fetch"
            },

            success: function(data)
            {
                $("#studentData").html(data);
            }
        });
    }

    // ADD
    $("#addBtn").click(function(){

        $.ajax({
            url: "../ajax/studentHandler.php",
            type: "POST",

            data: {
                action: "add",
                name: $("#name").val(),
                department: $("#department").val(),
                email: $("#email").val(),
                cgpa: $("#cgpa").val()
            },

            success: function()
            {
                loadStudents();

                $("#name").val('');
                $("#department").val('');
                $("#email").val('');
                $("#cgpa").val('');
            }
        });
    });

    // DELETE
    window.deleteStudent = function(id)
    {
        $.ajax({
            url: "../ajax/studentHandler.php",
            type: "POST",

            data: {
                action: "delete",
                id: id
            },

            success: function()
            {
                loadStudents();
            }
        });
    }

    // EDIT
    window.editStudent = function(id)
    {
        $.ajax({
            url: "../ajax/studentHandler.php",
            type: "POST",

            data: {
                action: "get",
                id: id
            },

            success: function(data)
            {
                let student = JSON.parse(data);

                $("#student_id").val(student.id);
                $("#name").val(student.name);
                $("#department").val(student.department);
                $("#email").val(student.email);
                $("#cgpa").val(student.cgpa);

                $("#addBtn").hide();
                $("#updateBtn").show();
            }
        });
    }

    // UPDATE
    $("#updateBtn").click(function(){

        $.ajax({
            url: "../ajax/studentHandler.php",
            type: "POST",

            data: {
                action: "update",
                id: $("#student_id").val(),
                name: $("#name").val(),
                department: $("#department").val(),
                email: $("#email").val(),
                cgpa: $("#cgpa").val()
            },

            success: function()
            {
                loadStudents();

                $("#student_id").val('');
                $("#name").val('');
                $("#department").val('');
                $("#email").val('');
                $("#cgpa").val('');

                $("#addBtn").show();
                $("#updateBtn").hide();
            }
        });
    });

});