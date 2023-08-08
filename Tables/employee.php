<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Table</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">My Website</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="person.php">Person</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="employee.php">Employees</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="student.php">Students</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="facility.php">Facilities</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="vaccination.php">Vaccinations</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="infection.php">Infections</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <button class="btn btn-primary" onclick="insertRow()">Insert Row</button>

    <div class="container mt-5">
        <h2 class="text-center">Employee Table</h2>
        <p class="text-center">Table displaying all the records of the Employee table.</p>
        <?php
        include('../config.php');
        
        $sql = "SELECT employeeID,firstName,lastName,startWorkDate,endWorkDate,employeeRole 
        FROM Employee
        JOIN Person ON Employee.medicareCard = Person.medicareCard";
        $result = mysqli_query($conn, $sql);
        
        if (mysqli_num_rows($result) > 0) {
            echo '<div class="d-flex justify-content-center">';
            echo '<table class="table table-bordered">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>Employee ID</th>';
            echo '<th>First Name</th>';
            echo '<th>Last Name</th>';
            echo '<th>Start Work Date</th>';
            echo '<th>End Work Date</th>';
            echo '<th>Role</th>';
            echo '<th>Action</th>';
            echo '<th>Schedule</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
        
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . $row['employeeID'] . '</td>';
                echo '<td>' . $row['firstName'] . '</td>';
                echo '<td>' . $row['lastName'] . '</td>';
                echo '<td>' . $row['startWorkDate'] . '</td>';
                echo '<td>' . $row['endWorkDate'] . '</td>';
                echo '<td>' . $row['employeeRole'] . '</td>';
                echo '<td>';
                echo "<button class=\"btn btn-danger\" onclick=\"deleteEmployee('" . $row['employeeID'] . "')\">Delete</button>";
                echo "<button class=\"btn btn-warning\" onclick=\"editEmployee('" . $row['employeeID'] . "')\">Edit</button>";
                echo '</td>';
                echo '<td> <button class="btn btn-primary" onclick="assignSchedule(' . $row['employeeID'] . ')">Assign Schedule</button> </td>';
                echo '</tr>';
            }
        
            echo '</tbody>';
            echo '</table>';
            echo '</div>';
        } else {
            echo 'No records found.';
        }
        
        mysqli_close($conn);
        ?>
        
        <script>
        function insertRow()
        {
            window.location.href = "../CreateForum/EmployeeForm.php?action=create";
        }
        function deleteEmployee(employeeID) {
            if (confirm("Are you sure you want to delete this employee?")) {
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == XMLHttpRequest.DONE ) {
                        if(xhr.status == 200)
                        {
                            alert("Employee deleted successfully");
                            window.location.reload();
                        }
                        else
                        {
                            alert("Error deleting employee");
                        }
                        
                    }
                };
                xhr.open("GET", "../CreateForum/EmployeeForm.php?employeeID=" + employeeID + "&action=delete", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.send("employeeID=" + employeeID);

            }
        }
        function editEmployee(employeeID) {
            window.location.href = "../CreateForum/EmployeeForm.php?employeeID=" + employeeID + "&action=edit";
        }
        function assignSchedule(employeeID) {
            window.location.href = "../AssignSchedule.php?employeeID=" + employeeID;
        }
    </script>
    </div>

</body>
</html>
