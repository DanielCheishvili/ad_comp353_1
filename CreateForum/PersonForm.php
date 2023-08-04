<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Person Form</title>
    <!-- Bootstrap CSS -->
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

    
    <div class="container mt-5">
        <h2>Person Form</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

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
                <input type="checkbox" name="citizenship" id="citizenship" class="form-check-input" value="<?php echo $citizenship; ?>">
            </div>

            <input type="submit" name="submit" value="Submit" class="btn btn-primary">
        </form>
    </div>

    <?php 
        include ('../config.php');
        $medicareCard = $firstName = $lastName = $address = $city = $province = 
        $postalCode = $telephoneNumber = $email =  $dateOfBirth = $medicareExpiryDate = $citizenship = "";        
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
            $citizenship = $_POST['citizenship'];
            if(empty($medicareCard) || empty($firstName) || empty($lastName) || empty($address) || empty($city) || empty($province) || empty($postalCode) || empty($telephoneNumber) || empty($email) || empty($dateOfBirth) || empty($medicareExpiryDate))
            {
                echo '<div class="text-center text-danger mb-4">';
                echo "Please fill all the fields";
                echo '</div>';
            }
            else
            {
                $sql = "INSERT INTO Person (medicareCard, firstName, lastName, address, city, province, postalCode, telephoneNumber, email, dateOfBirth, medicareExpiryDate, citizenship)
                VALUES ('$medicareCard', '$firstName', '$lastName', '$address', '$city', '$province', '$postalCode', '$telephoneNumber', '$email', '$dateOfBirth', '$medicareExpiryDate', '1')";
                if(mysqli_query($conn, $sql))
                {
                    echo "Record added successfully";
                }
                else
                {
                    echo '<div class="text-center text-danger mb-4">';
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                    echo '</div>';
                    
                }
            }
        }
        mysqli_close($conn);
    ?> 

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
