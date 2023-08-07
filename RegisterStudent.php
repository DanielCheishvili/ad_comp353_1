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
    
    
    include('../config.php');



    ?>
    
    <div class="container mt-5">
        <h2>Registration Form</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

            <div class="form-group">
                <label for="facilityID">Facility ID</label>
                <input type="text" name="facilityID" id="facilityID" class="form-control" placeholder="Facility ID" value="<?php echo $facilityID; ?>">
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="facilityName">Facility Name</label>
                    <input type="text" name="facilityName" id="facilityName" class="form-control" placeholder="Facility Name" value="<?php echo $facilityName; ?>">
                </div>
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" name="address" id="address" class="form-control" placeholder="Address" value="<?php echo $address; ?>">
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="city">City</label>
                    <input type="text" name="city" id="city" class="form-control" placeholder="City" value="<?php echo $city; ?>">
                </div>

                <div class="form-group col-md-6">
                    <label for="province">Province</label>
                    <input type="text" name="province" id="province" class="form-control" placeholder="Province" value="<?php echo $province; ?>">
                </div>
            </div>

            <div class="form-group">
                <label for="postalCode">Postal Code</label>
                <input type="text" name="postalCode" id="postalCode" class="form-control" placeholder="Postal Code" value="<?php echo $postalCode; ?>">
            </div>

            <div class="form-group">
                <label for="telephoneNumber">Telephone Number</label>
                <input type="text" name="telephoneNumber" id="telephoneNumber" class="form-control" placeholder="Telephone Number" value="<?php echo $telephoneNumber; ?>">
            </div>

            <div class="form-group">
                <label for="webAddress">Web Address</label>
                <input type="text" name="webAddress" id="webAddress" class="form-control" placeholder="Web Address" value="<?php echo $webAddress; ?>">
            </div>

            <div class="form-group">
                <label for="capacity">Capacity</label>
                <input type="text" name="capacity" id="capacity" class="form-control" placeholder="Capacity" value="<?php echo $capacity; ?>">
            </div>
            <div class="form-group">
                <label for="ministryID">Ministry ID</label>
                <input type="text" name="ministryID" id="ministryID" class="form-control" placeholder="Ministry ID" value="<?php echo $ministryID; ?>">
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
