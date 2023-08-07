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
    var_dump($_POST);
    include('config.php');
    $action = isset($_GET['action']) ? $_GET['action'] : '';
    $studentID = $facilityID = '';
    


    $retreiveEducationalFacility = "SELECT Facility.facilityID, Facility.facilityName 
    From EducationalFacility
    JOIN Facility ON EducationalFacility.facilityID = Facility.facilityID";

    $result = mysqli_query($conn, $retreiveEducationalFacility);
    $facilites = [];

    while($row = mysqli_fetch_assoc($result)){
        $facilities[$row['facilityID']] = $row['facilityName'];
    }
    if($action == 'register')
    {
        echo "register";
        $studentID = isset($_GET['studentID']) ? $_GET['studentID'] : '';
        $sql = "SELECT * FROM Student WHERE studentID = '$studentID'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        if(!$result)
        {
            echo "Can't retrieve data " . mysqli_error($conn);
        }
        
        $studentID = $row['studentID'];
        $facilityID = $row['educationalFacilityId'];
        echo $studentID;
        echo $facilityID;

        if(isset($_POST['submit']))
        {
            echo "submit";
            $originalStudentID = $_POST['originalStudentID'];
            $newFacilityID = $_POST['facilityID'];
            $currentDate = date('Y-m-d');
            
            $updateQuery = "UPDATE Student SET educationalFacilityId = ?, startSchoolDate = ?, endSchoolDate = NULL WHERE studentID = ?";
            $stmt = mysqli_prepare($conn, $updateQuery);
            mysqli_stmt_bind_param($stmt, "iss", $newFacilityID, $currentDate, $originalStudentID);

            
            if (mysqli_stmt_execute($stmt)) {
                echo "Registered Successfully";
                
            } else {
                echo "Error: " . mysqli_error($conn);
            }
            mysqli_stmt_close($stmt);
        }
    }
    mysqli_close($conn);
    ?>

<div class="container mt-5">
    <h2>Select Educational Facility</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
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
        <input type="hidden" name="originalStudentID" value="<?php echo $studentID; ?>">

        <input type="submit" name="submit" value="Register" class="btn btn-primary">
    </form>
</div>

    


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
