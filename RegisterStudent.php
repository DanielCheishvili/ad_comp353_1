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
    $retreiveEducationalFacility = "SELECT Facility.facilityName 
    From EducationalFacility
    JOIN Facility ON EducationalFacility.facilityID = Facility.facilityID";

    $result = mysqli_query($conn, $retreiveEducationalFacility);
    $facilites = [];

    while($row = mysqli_fetch_assoc($result)){
       $facilites[$row['facilityID'] = $row['facilityName']];
    }

    mysqli_close($conn);


    ?>
    
    <div class="container mt-5">
        <h2>Registration Form</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
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
           
            
            <input type="hidden" name="originalFacilityID" value="<?php echo $facilityID; ?>">
            <input type="submit" name="submit" value="Submit" class="btn btn-primary">
        </form>
    </div>

    


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
