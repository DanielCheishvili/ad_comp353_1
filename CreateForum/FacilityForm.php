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

    $action = isset($_GET['action']) ? $_GET['action'] : '';
    $facilityID = $facilityName = $address = $city = $province = $postalCode = $phoneNumber = $webAddress = $capacity = '';


    if ($action == 'create' || $action == 'edit') {
        if ($action == 'edit') {
            $facilityID = isset($_GET['facilityID']) ? $_GET['facilityID'] : '';
            $sql = "SELECT * FROM Facility WHERE facilityID = '$facilityID'";
            $result = mysqli_query($conn, $sql);

            $row = mysqli_fetch_assoc($result);
            $facilityID = $row['facilityID'];
            $facilityName = $row['facilityName'];
            $address = $row['address'];
            $city = $row['city'];
            $province = $row['province'];
            $postalCode = $row['postalCode'];
            $phoneNumber = $row['phoneNumber'];
            $webAddress = $row['webAddress'];
            $capacity = $row['capacity'];

             
        }

        
            if ($action == 'create') {
                if(isset($_POST['submit']))
                {
                    $facilityID = $_POST['facilityID'];
                    $facilityName = $_POST['facilityName'];
                    $address = $_POST['address'];
                    $city = $_POST['city'];
                    $province = $_POST['province'];
                    $postalCode = $_POST['postalCode'];
                    $phoneNumber = $_POST['phoneNumber'];
                    $webAddress = $_POST['webAddress'];
                    $capacity = $_POST['capacity'];
                    $sql = "INSERT INTO Facility (facilityID, facilityName, address, city, province, postalCode, phoneNumber, webAddress, capacity) VALUES ('$facilityID', '$facilityName', '$address', '$city', '$province', '$postalCode', '$phoneNumber', '$webAddress', '$capacity')";
                    if (mysqli_query($conn, $sql)) {
                        echo '<div class="text-center text-success mb-4">';
                        echo "New record created successfully";
                        echo '</div>';
                    } else {
                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                    }


                }
            } elseif ($action == 'edit') {
                
                if(isset($_POST['submit']))
                {
                    $originalFacilityID = $_POST['originalFacilityID'];
                    $newFacilityID = $_POST['facilityID'];
                    $newFacilityName = $_POST['facilityName'];
                    $newAddress = $_POST['address'];
                    $newCity = $_POST['city'];
                    $newProvince = $_POST['province'];
                    $newPostalCode = $_POST['postalCode'];
                    $newPhoneNumber = $_POST['phoneNumber'];
                    $newWebAddress = $_POST['webAddress'];
                    $newCapacity = $_POST['capacity'];
                    $sql = "UPDATE Facility SET facilityID = '$newFacilityID', facilityName = '$newFacilityName', address = '$newAddress', city = '$newCity', province = '$newProvince', postalCode = '$newPostalCode', phoneNumber = '$newPhoneNumber', webAddress = '$newWebAddress', capacity = '$newCapacity' WHERE facilityID = '$originalFacilityID'";
                    
                    if (mysqli_query($conn, $sql)) {
                        echo '<div class="text-center text-success mb-4">';
                        echo "Record updated successfully";
                        echo '</div>';
                    } else {
                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                    }
                }
                
            }

    }
    elseif ($action == 'delete') {
        $facilityID = isset($_GET['facilityID']) ? $_GET['facilityID'] : '';
        $sql = "DELETE FROM Facility WHERE facilityID = '$facilityID'";
        if (mysqli_query($conn, $sql)) {
            echo '<div class="text-center text-success mb-4">';
            echo "Record deleted successfully";
            echo '</div>';
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        
        
    }
        mysqli_close($conn);
    ?>
    
    <div class="container mt-5">
        <h2>Facility Form</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>?action=<?php echo $action; ?>" method="post">

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

            
            <input type="hidden" name="originalFacilityID" value="<?php echo $facilityID; ?>">
            <input type="submit" name="submit" value="Submit" class="btn btn-primary">
        </form>
    </div>

    


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
