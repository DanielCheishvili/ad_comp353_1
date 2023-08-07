<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Person Table</title>
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
                        <a class="nav-link" href="/Tables/person.php">Person</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/Tables/employee.php">Employees</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/Tables/student.php">Students</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/Tables/facility.php">Facilities</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/Tables/vaccination.php">Vaccinations</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/Tables/infection.php">Infections</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h2>Employee Schedules</h2>
        <p>Table displaying all the records of the Employee Schedule table.</p>
        <?php
        include('config.php');
        $employeeID = isset($_GET['employeeID']) ? $_GET['employeeID'] : '';
        echo $employeeID;
        $sql = "SELECT scheduleID, Person.firstName, Person.LastName,Facility.facilityName,scheduleDate,scheduleStartTime,ScheduleEndTime
        FROM Schedule
        JOIN Employee ON Schedule.employeeID = Employee.employeeID
        JOIN Person ON Employee.medicareCard = Person.medicareCard
        JOIN Facility ON Schedule.facilityID = Facility.facilityID
        WHERE Schedule.employeeID = '$employeeID'";
        
        ;
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            echo '<div class="d-flex justify-content-center">';
            echo '<table class="table table-bordered">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>Schedule ID</th>';
            echo '<th>First Name</th>';
            echo '<th>Last Name</th>';
            echo '<th>Facility</th>';
            echo '<th>Date Created</th>';
            echo '<th>Start Time</th>';
            echo '<th>End Time</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
        
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . $row['scheduleID'] . '</td>';
                echo '<td>' . $row['firstName'] . '</td>';
                echo '<td>' . $row['lastName'] . '</td>';
                echo '<td>' . $row['facilityID'] . '</td>';
                echo '<td>' . $row['scheduleDate'] . '</td>';
                echo '<td>' . $row['scheduleStartTime'] . '</td>';
                echo '<td>' . $row['scheduleEndTime'] . '</td>';
                echo '</tr>';


                // echo '<td>';
                // echo "<button class=\"btn btn-danger\" onclick=\"deletePerson('" . $row['vaccinatedPerson'] . "')\">Delete</button>";
                // echo "<button class=\"btn btn-warning\" onclick=\"editPerson('" . $row['vaccinatedPerson'] . "')\">Edit</button>";
                // echo '</td>';
                // echo '</tr>';
            }
        
            echo '</tbody>';
            echo '</table>';
            echo '</div>';
        } else {
            echo 'No records found.';
        }
        
        mysqli_close($conn);
        ?>
       

        <h3>Add New Schedule</h3>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="form-group">
                <label for="startDateTime">Start Date and Time</label>
                <input type="datetime-local" name="startDateTime" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="endDateTime">End Date and Time</label>
                <input type="datetime-local" name="endDateTime" class="form-control" required>
            </div>
            <input type="submit" name="addSchedule" value="Add Schedule" class="btn btn-primary">
        </form>
    </div>
    
   
</body>
</html>
