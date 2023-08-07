<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facility Form</title>
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
    <?php
include('config.php');

$studentID = isset($_POST['studentID']) ? $_POST['studentID'] : '';
$action = isset($_GET['action']) ? $_GET['action'] : '';

if ($action === 'register' && !empty($studentID)) {
    $facilityID = $_POST['facilityID'];
    $currentDate = date('Y-m-d');
    
    $updateQuery = "UPDATE Student SET educationalFacilityId = ?, startSchoolDate = ?, endSchoolDate = NULL WHERE studentID = ?";
    $stmt = mysqli_prepare($conn, $updateQuery);
    mysqli_stmt_bind_param($stmt, "iss", $facilityID, $currentDate, $studentID);
    
    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        header("Location: ../RegisterStudent.php?studentID=$studentID&action=register");
        exit;
    } else {
        echo '<div class="container mt-5">';
        echo '<h2>Error</h2>';
        echo '<p>An error occurred while registering the student.</p>';
        echo '</div>';
    }
}

$retreiveEducationalFacility = "SELECT Facility.facilityID, Facility.facilityName 
    From EducationalFacility
    JOIN Facility ON EducationalFacility.facilityID = Facility.facilityID";

$result = mysqli_query($conn, $retreiveEducationalFacility);
$facilities = [];

while($row = mysqli_fetch_assoc($result)){
    $facilities[$row['facilityID']] = $row['facilityName'];
}
mysqli_close($conn);
?>

<div class="container mt-5">
    <h2>Select Educational Facility</h2>
    <form action="<?php echo $_SERVER['PHP_SELF'] . '?action=register'; ?>" method="post">
        <div class="form-group">
            <label for="studentID">Student ID</label>
            <input type="text" name="studentID" id="studentID" class="form-control" placeholder="Student ID" value="<?php echo $studentID; ?>" readonly>
        </div>
        <div class="form-group">
            <label for="facilityID">Educational Facility</label>
            <select name="facilityID" id="facilityID" class="form-control" required>
                <option value="" disabled selected>Select an Educational Facility</option>
                <?php
                foreach ($facilities as $facilityID => $facilityName) {
                    echo '<option value="' . $facilityID . '">' . $facilityName . '</option>';
                }
                ?>
            </select>
        </div>
        <?php
            if ($action === 'register' && empty($studentID)) {
                echo '<div class="alert alert-danger" role="alert">Invalid Student ID</div>';
            }
        ?>
        <button type="submit" class="btn btn-primary">Register</button>
    </form>
</div>

    


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
