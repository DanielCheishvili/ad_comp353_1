<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Person Table</title>
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
    <button class="btn btn-primary">Insert Row</button>
        <button class="btn btn-danger">Delete Row</button>
        <button class="btn btn-warning">Edit Row</button>
    <div class="container mt-5">
        <h2>Person Table</h2>
        <p>Table displaying all the records of the Person table.</p>
        <!-- PHP code to fetch data from the database -->
        <?php
        include('../config.php'); // Assuming this file contains the database connection settings
        
        $sql = "SELECT * FROM Employee";
        $result = mysqli_query($conn, $sql);
        
        if (mysqli_num_rows($result) > 0) {
            echo '<table class="table table-bordered">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>Employee ID</th>';
            echo '<th>First Name</th>';
            echo '<th>Last Name</th>';
            echo '<th>Start Work Date</th>';
            echo '<th>Role</th>';
            echo '<th>Medicare Card Number</th>';
    
            echo '<th>Citizenship</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
        
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . $row['firstName'] . '</td>';
                echo '<td>' . $row['lastName'] . '</td>';
                echo '<td>' . $row['dateOfBirth'] . '</td>';
                echo '<td>' . $row['telephoneNumber'] . '</td>';
                echo '<td>' . $row['email'] . '</td>';
                echo '<td>' . $row['address'] . '</td>';
                echo '<td>' . $row['city'] . '</td>';
                echo '<td>' . $row['province'] . '</td>';
                echo '<td>' . $row['postalCode'] . '</td>';
                echo '<td>' . $row['medicareCard'] . '</td>';
                echo '<td>' . $row['medicareExpiryDate'] . '</td>';
                echo '<td>' . ($row['citizenship'] ? 'Yes' : 'No') . '</td>';

                echo '</tr>';
            }
        
            echo '</tbody>';
            echo '</table>';
        } else {
            echo 'No records found.';
        }
        
        mysqli_close($conn);
        ?>
        <!-- End of PHP code -->
        
        <!-- Buttons -->
       
    </div>

    <!-- Bootstrap JS -->
    <!-- ... (Same as in the previous example) ... -->
</body>
</html>
