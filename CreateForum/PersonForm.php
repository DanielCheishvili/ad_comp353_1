<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Person Form</title>
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
                    <li class="nav-item">
                        <a class="nav-link" href="../ShowQueries.php">Show Queries</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <?php
    
    
    include('../config.php');

    $table = isset($_GET['table']) ? $_GET['table'] : '';
    $action = isset($_GET['action']) ? $_GET['action'] : '';

    $medicareCard = $firstName = $lastName = $address = $city = $province = $postalCode = $telephoneNumber = $email = 
    $dateOfBirth = $medicareExpiryDate = $citizenship = '';

    if ($action == 'create' || $action == 'edit') {
        if ($action == 'edit') {
            $medicareCard = isset($_GET['medicareCard']) ? $_GET['medicareCard'] : '';
            $sql = "SELECT * FROM Person WHERE medicareCard = '$medicareCard'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            if (!$result) {
                echo "Error: " . mysqli_error($conn); // Output the error message for debugging purposes
            }
            
            $medicareCard = $row['medicareCard'];
            $firstName = $row['firstName'];
            $lastName = $row['lastName'];
            $address = $row['address'];
            $city = $row['city'];
            $province = $row['province'];
            $postalCode = $row['postalCode'];
            $telephoneNumber = $row['telephoneNumber'];
            $email = $row['email'];
            $dateOfBirth = $row['dateOfBirth'];
            $medicareExpiryDate = $row['medicareExpiryDate'];
            $citizenship = $row['citizenship'];
            
        }

        
            if ($action == 'create') {
                if(isset($_POST['submit']))
                {
                    $medicareCard = $_POST['medicareCard'];
                    $firstName = $_POST['firstName'];
                    $lastName = $_POST['lastName'];
                    $address = $_POST['address'];
                    $city = $_POST['city'];
                    $province = $_POST['province'];
                    $postalCode = $_POST['postalCode'];
                    $telephoneNumber = $_POST['telephoneNumber'];
                    $email = $_POST['email'];
                    $dateOfBirth = $_POST['dateOfBirth'];
                    $medicareExpiryDate = $_POST['medicareExpiryDate'];
                    $citizenship = isset($_POST['citizenship']) ? 1 : 0;

                    if (empty($medicareCard) || empty($firstName) || empty($lastName) || empty($address) || empty($city) || empty($province) || empty($postalCode) || empty($telephoneNumber) || empty($email) || empty($dateOfBirth) || empty($medicareExpiryDate)) {
                        echo '<div class="text-center text-danger mb-4">';
                        echo "Please fill all the fields";
                        echo '</div>';
                    } else {
                        $sql = "INSERT INTO Person (medicareCard, firstName, lastName, address, city, province, postalCode, telephoneNumber, email, dateOfBirth, medicareExpiryDate, citizenship)
                        VALUES ('$medicareCard', '$firstName', '$lastName', '$address', '$city', '$province', '$postalCode', '$telephoneNumber', '$email', '$dateOfBirth', '$medicareExpiryDate', '1')";
                        if (mysqli_query($conn, $sql)) {
                            echo '<div class="text-center text-success mb-4">';
                            echo "Record Inserted successfully";
                            echo '</div>';
                        } else {
                            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                        }
                    }
                }
            } elseif ($action == 'edit') {
                
                if(isset($_POST['submit']))
                {
                    $originalMedicareCard = $_POST['originalMedicareCard'];
                    $medicareCard = $_POST['medicareCard'];
                    $newMedicareCard = $_POST['medicareCard'];
                    $newfirstName = $_POST['firstName'];
                    $newlastName = $_POST['lastName'];
                    $newaddress = $_POST['address'];
                    $newcity = $_POST['city'];
                    $newprovince = $_POST['province'];
                    $newpostalCode = $_POST['postalCode'];
                    $newtelephoneNumber = $_POST['telephoneNumber'];
                    $newemail = $_POST['email'];
                    $newdateOfBirth = $_POST['dateOfBirth'];
                    $newmedicareExpiryDate = $_POST['medicareExpiryDate'];
                    $newcitizenship = isset($_POST['citizenship']) ? 1 : 0;
                    $sql = "UPDATE Person SET medicareCard = '$newMedicareCard', firstName = '$newfirstName', lastName = '$newlastName', 
                    address = '$newaddress', city = '$newcity', province = '$newprovince', postalCode = '$newpostalCode', telephoneNumber = '$newtelephoneNumber', 
                    email = '$newemail', dateOfBirth = STR_TO_DATE('$newdateOfBirth', '%Y-%m-%d'), medicareExpiryDate = STR_TO_DATE('$newmedicareExpiryDate', '%Y-%m-%d'), citizenship = '$newcitizenship' 
                    WHERE medicareCard = '$originalMedicareCard'";

                    if (mysqli_query($conn, $sql)) {
                        echo '<div class="text-center text-success mb-4">';
                        echo "Record updated successfully";
                        echo '</div>';
                    } 
                    else {
                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                    }
                }
                
            }

    }
    elseif ($action == 'delete') {
        $medicareCard = isset($_GET['medicareCard']) ? $_GET['medicareCard'] : '';
        $sql = "DELETE FROM Person WHERE medicareCard = '$medicareCard'";
        if (mysqli_query($conn, $sql)) {
            echo '<div class="text-center text-success mb-4">';
            echo "Record Deleted successfully";
            echo '</div>';
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
        mysqli_close($conn);
    ?>
    
    <div class="container mt-5">
        <h2>Person Form</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>?action=<?php echo $action; ?>" method="post">

            <div class="form-group">
                <label for="medicareCard">Medicare Card</label>
                <input type="text" name="medicareCard" id="medicareCard" class="form-control" placeholder="Medicare Card" value="<?php echo $medicareCard; ?>">
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="firstName">First Name</label>
                    <input type="text" name="firstName" id="firstName" class="form-control" placeholder="First Name" value="<?php echo $firstName; ?>">
                </div>

                <div class="form-group col-md-6">
                    <label for="lastName">Last Name</label>
                    <input type="text" name="lastName" id="lastName" class="form-control" placeholder="Last Name" value="<?php echo $lastName; ?>">
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
                <label for="email">Email</label>
                <input type="text" name="email" id="email" class="form-control" placeholder="Email" value="<?php echo $email; ?>">
            </div>

            <div class="form-group">
                <label for="dateOfBirth">Date Of Birth</label>
                <input type="text" name="dateOfBirth" id="dateOfBirth" class="form-control" placeholder="Date Of Birth" value="<?php echo $dateOfBirth; ?>">
            </div>

            <div class="form-group">
                <label for="medicareExpiryDate">Medicare Expiry Date</label>
                <input type="text" name="medicareExpiryDate" id="medicareExpiryDate" class="form-control" placeholder="Medicare Expiry Date" value="<?php echo $medicareExpiryDate; ?>">
            </div>

            <div class="form-group">
                <label for="citizenship">Citizenship</label>
                <input type="checkbox" name="citizenship" id="citizenship" class="form-check-input" <?php echo $citizenship == 1 ? 'checked' : ''; ?>>
                <!-- <input type="checkbox" name="citizenship" id="citizenship" class="form-check-input" value="<?php echo $citizenship; ?>"> -->
            </div>
            <input type="hidden" name="originalMedicareCard" value="<?php echo $medicareCard; ?>">
            <input type="submit" name="submit" value="Submit" class="btn btn-primary">
        </form>
    </div>

    


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
