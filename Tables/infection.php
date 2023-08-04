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
        <h2 class="text-center">Infection Table</h2>
        <p class="text-center">Table displaying all the records of the Infection table.</p>
        <?php
        include('../config.php');
        
        $sql = "SELECT * FROM Infection";
        $result = mysqli_query($conn, $sql);
        
        if (mysqli_num_rows($result) > 0) {
            echo '<div class="d-flex justify-content-center">';
            echo '<table class="table table-bordered">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>Infection ID</th>';
            echo '<th>Nature</th>';
            echo '<th>Infection Type</th>';
            echo '<th>Infection Date</th>';
            echo '<th>Action</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
        
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . $row['infectionID'] . '</td>';
                echo '<td>' . $row['nature'] . '</td>';
                echo '<td>' . $row['infectionType'] . '</td>';
                echo '<td>' . $row['infectionDate'] . '</td>';
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
