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
        $sql = "SELECT scheduleID, Person.firstName, Person.LastName,Facility.facilityName,scheduleDate,scheduleStartTime,scheduleEndTime
        FROM Schedule
        JOIN Employee ON Schedule.employeeID = Employee.employeeID
        JOIN Person ON Employee.medicareCard = Person.medicareCard
        JOIN Facility ON Schedule.facilityID = Facility.facilityID
        WHERE Schedule.employeeID = '$employeeID'";
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
                echo '<td>' . $row['LastName'] . '</td>';
                echo '<td>' . $row['facilityName'] . '</td>';
                echo '<td>' . $row['scheduleDate'] . '</td>';
                echo '<td>' . $row['scheduleStartTime'] . '</td>';
                echo '<td>' . $row['scheduleEndTime'] . '</td>';
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
    
    </div>
    <div class="container mt-5">
        
        <!-- Add New Schedule form -->
        <h3>Add New Schedule</h3>
        <?php
        include('config.php');
        
        // Function to check if an employee is infected
        function isInfected($conn, $employeeID, $scheduleDate) {
            $medicareCard = "SELECT medicareCard FROM Employee WHERE employeeID = '$employeeID'";
            $result = mysqli_query($conn, $medicareCard);
            $row = mysqli_fetch_assoc($result);
            $medicareCard = $row['medicareCard'];
            $twoWeeksAgo = date('Y-m-d', strtotime('-2 weeks'));
            $sql = "SELECT * FROM InfectedPerson 
            JOIN Infection ON InfectedPerson.infectionID = Infection.infectionID
            WHERE InfectedPerson.medicareCard = '$medicareCard' AND Infection.infectionDate > '$twoWeeksAgo'";
            $result = mysqli_query($conn, $sql);
            return mysqli_num_rows($result) > 0;
        }

        // Function to check if an employee is vaccinated
        function isVaccinated($conn, $employeeID, $scheduleDate) {
            $medicareCard = "SELECT medicareCard FROM Employee WHERE employeeID = '$employeeID'";
            $result = mysqli_query($conn, $medicareCard);
            $row = mysqli_fetch_assoc($result);

            $medicareCard = $row['medicareCard'];
            echo "I am trying to see something $medicareCard";

            $sixMonthsAgo = date('Y-m-d', strtotime('-6 months'));
            $sql = "SELECT * FROM VaccinatedPerson 
            JOIN Vaccination ON VaccinatedPerson.vaccinatedPerson = Vaccination.VaccinationID
            WHERE VaccinatedPerson.medicareCard = '$medicareCard' AND Vaccination.doseDate < '$sixMonthsAgo'";
            $result = mysqli_query($conn, $sql);
            return mysqli_num_rows($result) > 0;
        }

        // Check if the form was submitted
        if (isset($_POST['addSchedule'])) {
            $employeeID = $_GET['employeeID'];
            $scheduleDate = $_POST['scheduleDate'];
            $startTime = $_POST['startTime'];
            $endTime = $_POST['endTime'];
            $startDateTime = $scheduleDate . ' ' . $startTime;
            $endDateTime = $scheduleDate . ' ' . $endTime;

            // Check if start time is not greater than end time
            if ($startTime >= $endTime) {
                echo '<div class="alert alert-danger">Start time cannot be greater than end time.</div>';
            }
            // Check if there is at least one hour gap between schedules
            elseif (strtotime($endTime) <= strtotime($startTime) + 3600) {
                echo '<div class="alert alert-danger">The schedule must be at least 1 hour apart.</div>';
            }
            // Check if the employee is infected
            elseif (isInfected($conn, $employeeID, $scheduleDate)) {
                echo '<div class="alert alert-danger">The employee is infected and cannot be scheduled within 2 weeks of infection.</div>';
            }
            // Check if the employee is not vaccinated
            elseif (!isVaccinated($conn, $employeeID, $scheduleDate)) {
                echo '<div class="alert alert-danger">The employee is not vaccinated within the past 6 months.</div>';
            }
            // All constraints met, insert schedule
            else {
                $scheduleDate = date('Y-m-d', strtotime($scheduleDate));
                $sql = "INSERT INTO Schedule (employeeID,scheduleDate, scheduleStartTime, scheduleEndTime) 
                        VALUES ('$employeeID','$scheduleDate' '$startDateTime', '$endDateTime')";
                if (mysqli_query($conn, $sql)) {
                    echo '<div class="alert alert-success">Schedule added successfully.</div>';
                } else {
                    echo '<div class="alert alert-danger">Error adding schedule: ' . mysqli_error($conn) . '</div>';
                }
            }
        }
        ?>
        <form action="<?php echo $_SERVER['PHP_SELF'] . '?employeeID=' . $_GET['employeeID']; ?>" method="post">
            <div class="form-group">
                <label for="scheduleDate">Schedule Date</label>
                <input type="date" name="scheduleDate" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="startTime">Start Time</label>
                <input type="time" name="startTime" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="endTime">End Time</label>
                <input type="time" name="endTime" class="form-control" required>
            </div>
            <input type="submit" name="addSchedule" value="Add Schedule" class="btn btn-primary">
        </form>
    </div>
    
   
</body>
</html>
