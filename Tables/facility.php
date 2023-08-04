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
    <button class="btn btn-primary">Insert Row</button>
    <div class="container mt-5">
        <h2 class="text-center">Person Table</h2>
        <p>Table displaying all the records of the Person table.</p>
        <?php
        include('../config.php');
        
        $sql = "SELECT facilityName, ministryName, address, city, province, postalCode, phoneNumber, webAddress, capacity FROM Facility
        JOIN Ministry ON Facility.ministryID = Ministry.ministryID
        ORDER BY facilityName ASC";
        $result = mysqli_query($conn, $sql);
        
        if (mysqli_num_rows($result) > 0) {
            echo '<div class="d-flex justify-content-center">';
            echo '<table class="table table-bordered">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>Facility Name</th>';
            echo '<th>Minister</th>';
            echo '<th>Address</th>';
            echo '<th>City</th>';
            echo '<th>Provicne</th>';
            echo '<th>Postal Code</th>';
            echo '<th>Phone Number</th>';
            echo '<th>Web Address</th>';
            echo '<th>Capacity</th>';
            echo '<th>Action</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
        
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . $row['facilityName'] . '</td>';
                echo '<td>' . $row['ministryID'] . '</td>';
                echo '<td>' . $row['address'] . '</td>';
                echo '<td>' . $row['city'] . '</td>';
                echo '<td>' . $row['province'] . '</td>';
                echo '<td>' . $row['postalCode'] . '</td>';
                echo '<td>' . $row['phoneNumber'] . '</td>';
                echo '<td>' . $row['webAddress'] . '</td>';
                echo '<td>' . $row['capacity'] . '</td>';
                echo '<td>';
                echo '<button class="btn btn-danger" onclick="deletePerson(' . $row['employeeID'] . ')">Delete</button>';
                echo '<button class="btn btn-warning" onclick="editPerson(' . $row['employeeID'] . ')">Edit</button>';
                echo '</td>';
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

</body>
</html>
