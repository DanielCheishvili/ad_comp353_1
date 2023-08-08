<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Table</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<!-- <?php
    include('../config.php');

    function isEndDateNull($studentID, $conn) {
        $checkEndDateQuery = "SELECT endSchoolDate FROM Student WHERE studentID = '$studentID'";
        $checkEndDateResult = mysqli_query($conn, $checkEndDateQuery);

        if ($checkEndDateResult && mysqli_num_rows($checkEndDateResult) > 0) {
            $row = mysqli_fetch_assoc($checkEndDateResult);
            $endSchoolDate = $row['endSchoolDate'];
            return $endSchoolDate === null;
        }

        return false;
    }

    if (isset($_GET['studentID']) && $_GET['action'] == 'register') {
        $studentID = $_GET['studentID'];
        if (isEndDateNull($studentID, $conn)) {
            echo '<div class="container mt-5">';
            echo '<h2>Error</h2>';
            echo '<p>The student cannot be registered as their end date is null.</p>';
            echo '</div>';
            mysqli_close($conn);
            exit;
        } else {
            // Continue to the registration page
            header("Location: ../RegisterStudent.php?studentID=$studentID&action=register");
            exit;
        }
    }
    

    ?> -->
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
        <h2 class="text-center">Student Table</h2>
        <p class="text-center">Table displaying all the records of the Student table.</p>
        <?php
        include('../config.php');
        
        $sql = "SELECT Student.studentID,firstName,lastName,startSchoolDate,endSchoolDate,educationalFacilityID, Facility.facilityName  
        FROM Student
        JOIN Person ON Student.medicareCard = Person.medicareCard
        JOIN EducationalFacility ON Student.educationalFacilityId = EducationalFacility.educationFacilityID
        JOIN Facility ON EducationalFacility.facilityID = Facility.facilityID";
        $result = mysqli_query($conn, $sql);
        
        if (mysqli_num_rows($result) > 0) {
            echo '<div class="d-flex justify-content-center">';
            echo '<table class="table table-bordered">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>Student ID</th>';
            echo '<th>First Name</th>';
            echo '<th>Last Name</th>';
            echo '<th>Start School Date</th>';
            echo '<th>End School Date</th>';
            echo '<th>Institution</th>';
            echo '<th>School ID</th>';
            echo '<th>Action</th>';
            echo '<th>Registration</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
        
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . $row['studentID'] . '</td>';
                echo '<td>' . $row['firstName'] . '</td>';
                echo '<td>' . $row['lastName'] . '</td>';
                echo '<td>' . $row['startSchoolDate'] . '</td>';
                echo '<td>' . $row['endSchoolDate'] . '</td>';
                echo '<td>' . $row['facilityName'] . '</td>';
                echo '<td>' . $row['educationalFacilityID'] . '</td>';
                echo '<td>';
                echo "<button class=\"btn btn-danger\" onclick=\"deleteStudent('" . $row['studentID'] . "')\">Delete</button>";
                echo "<button class=\"btn btn-warning\" onclick=\"editStudent('" . $row['studentID'] . "')\">Edit</button>";
                echo '</td>';
                echo '<td>';
                echo "<button class=\"btn btn-primary\" onclick=\"registerStudent('" . $row['studentID'] . "')\">Register</button>";
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
            window.location.href = "../CreateForum/StudentForm.php?action=create";
        }
        function deleteStudent(studentID) {
            if (confirm("Are you sure you want to delete this student?")) {
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == XMLHttpRequest.DONE ) {
                        if(xhr.status == 200)
                        {
                            alert("Student deleted successfully");
                            window.location.reload();
                        }
                        else
                        {
                            alert("Error deleting student");
                        }
                        
                    }
                };
                xhr.open("GET", "../CreateForum/StudentForm.php?studentID=" + studentID + "&action=delete", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.send("studentID=" + studentID);

            }
        }
        function editStudent(studentID) {
            window.location.href = "../CreateForum/StudentForm.php?studentID=" + studentID + "&action=edit";
        }
        function registerStudent(studentID) {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState == XMLHttpRequest.DONE ) {
                    if(xhr.status == 200)
                    {
                        if (xhr.responseText.trim() === "can_register") {
                            window.location.href = "../RegisterStudent.php?studentID=" + studentID + "&action=register";
                        } else if (xhr.responseText.trim() === "cannot_register") {
                            alert("The student cannot be registered because they are still attending a school. Please set the end date to register student.");
                        } else {
                            alert("Error checking registration eligibility");
                        }
                    }
                    else
                    {
                        alert("Error checking registration eligibility");
                    }

                }
            };
            xhr.open("GET", "../CheckRegistration.php?studentID=" + studentID + "&action=check_register", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.send("studentID=" + studentID);
        }
    </script>
       
    </div>

</body>
</html>
