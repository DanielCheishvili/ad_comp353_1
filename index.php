<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <h1> Create A Person </h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label for="medicareCard">Medicare Card</label>
        <input type="text" name="medicareCard" id="medicareCard" placeholder="Medicare Card">
        <br>
        <label for="firstName">First Name</label>
        <input type="text" name="firstName" id="firstName" placeholder="First Name">
        <br>
        <label for="lastName">Last Name</label>
        <input type="text" name="lastName" id="lastName" placeholder="Last Name">
        <br>
        <label for="address">Address</label>
        <input type="text" name="address" id="address" placeholder="Address">
        <br>
        <label for="city">City</label>
        <input type="text" name="city" id="city" placeholder="City">
        <br>
        <label for="province">Province</label>
        <input type="text" name="province" id="province" placeholder="Province">
        <br>
        <label for="postalCode">Postal Code</label>
        <input type="text" name="postalCode" id="postalCode" placeholder="Postal Code">
        <br>
        <label for="telephoneNumber">Telephone Number</label>
        <input type="text" name="telephoneNumber" id="telephoneNumber" placeholder="Telephone Number">
        <br>
        <label for="email">Email</label>
        <input type="text" name="email" id="email" placeholder="Email">
        <br>
        <label for="dateOfBirth">Date Of Birth</label>
        <input type="text" name="dateOfBirth" id="dateOfBirth" placeholder="Date Of Birth">
        <br>
        <label for="medicareExpiryDate">Medicare Expiry Date</label>
        <input type="text" name="medicareExpiryDate" id="medicareExpiryDate" placeholder="Medicare Expiry Date">
        <br>
        <label for="citizenship">Citizenship</label>
        <input type="checkbox" name="citizenship" id="citizenship" placeholder="Citizenship">
        <br>
        <input type="submit" name="submit" value="Submit">
    </form>

    <?php 
        include ('config.php');
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
               echo "Please fill all the fields";
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
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
            }
        }
        mysqli_close($conn);
?>
</body>
</html> -->



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Website</title>
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
                    <li class="nav-item active">
                        <a class="nav-link" href="Tables/person.php">Person</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Tables/employee.php">Employees</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Tables/student.php">Students</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Tables/facility.php">Facilities</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Tables/vaccination.php">Vaccinations</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Tables/infection.php">Infections</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h1>Welcome to My Website</h1>
        <p>This is the landing page for my website. Use the navigation bar to access the different tables.</p>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
