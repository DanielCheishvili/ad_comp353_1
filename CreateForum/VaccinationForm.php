<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vaccination Form</title>
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

    $action = isset($_GET['action']) ? $_GET['action'] : '';
    $vaccinatedPersonID = $medicareCard = $vaccinationID = '';


    if ($action == 'create' || $action == 'edit') {
        if ($action == 'edit') {
            $vaccinatedPersonID = isset($_GET['vaccinatedPerson']) ? $_GET['vaccinatedPerson'] : '';
            $sql = "SELECT * FROM VaccinatedPerson WHERE vaccinatedPerson = '$vaccinatedPersonID'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result);
            $vaccinatedPersonID = $row['vaccinatedPerson'];
            $medicareCard = $row['medicareCard'];
            $vaccinationID = $row['vaccinationID'];
            
             
        }

        
            if ($action == 'create') {
                if(isset($_POST['submit']))
                {
                    $vaccinatedPersonID = $_POST['vaccinatedPerson'];
                    $medicareCard = $_POST['medicareCard'];
                    $vaccinationID = $_POST['vaccinationID'];
                    $sql = "INSERT INTO VaccinatedPerson (vaccinatedPerson, medicareCard, vaccinationID) VALUES ('$vaccinatedPersonID', '$medicareCard', '$vaccinationID')";
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
                    $originalVaccinationPersonID = $_POST['originalVaccinationPersonID'];
                    $newVaccinationID = $_POST['vaccinationID'];
                    $newMedicareCard = $_POST['medicareCard'];
                    $newVaccinatedPersonID = $_POST['vaccinatedPerson'];
                    $sql = "UPDATE VaccinatedPerson SET vaccinatedPerson = '$newVaccinatedPersonID', medicareCard = '$newMedicareCard', vaccinationID = '$newVaccinationID' WHERE vaccinatedPerson = '$originalVaccinationPersonID'";
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
        $vaccinatedPersonID = isset($_GET['vaccinatedPerson']) ? $_GET['vaccinatedPerson'] : '';
        $sql = "DELETE FROM VaccinatedPerson WHERE vaccinatedPerson = '$vaccinatedPersonID'";
        if (mysqli_query($conn, $sql)) {
            echo "Record deleted successfully!";
            //header("Location: ../Tables/person.php");
            exit();
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
                <label for="vaccinatedPerson">Vaccinated Person ID</label>
                <input type="text" name="vaccinatedPerson" id="vaccinatedPerson" class="form-control" placeholder="Vaccinated Person ID" value="<?php echo $vaccinatedPersonID; ?>">
            </div>

            <div class="form-group">
                <label for="medicareCard">Medicare Card</label>
                <input type="text" name="medicareCard" id="medicareCard" class="form-control" placeholder="Medicare Card" value="<?php echo $medicareCard; ?>"
                <?php
                if ($action == 'edit') {
                    echo 'readonly ';
                }
                echo 'value="' . $medicareCard . '"';
                ?>>
            </div>
            <div class="form-group">
                 <label for="vaccinationID">Vaccination ID</label>
                <input type="text" name="vaccinationID" id="vaccinationID" class="form-control" placeholder="Vaccination ID" value="<?php echo $vaccinationID; ?>">
            </div>
            <input type="hidden" name="originalVaccinationPersonID" value="<?php echo $vaccinatedPersonID; ?>">
            <input type="submit" name="submit" value="Submit" class="btn btn-primary">
        </form>
    </div>

    


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
