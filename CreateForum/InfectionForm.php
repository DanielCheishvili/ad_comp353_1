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
                </ul>
            </div>
        </div>
    </nav>
    <?php
    
    
    include('../config.php');

    $action = isset($_GET['action']) ? $_GET['action'] : '';
    $infectedPersonID = $medicareCard = $infectionID = '';


    if ($action == 'create' || $action == 'edit') {
        if ($action == 'edit') {
            $infectedPersonID = isset($_GET['infectedPersonID']) ? $_GET['infectedPersonID'] : '';
            $sql = "SELECT * FROM InfectedPerson WHERE infectedPersonID = '$infectedPersonID'";
            $result = mysqli_query($conn, $sql);
            
            $row = mysqli_fetch_assoc($result);
            $infectedPersonID = $row['infectedPersonID'];
            $medicareCard = $row['medicareCard'];
            $infectionID = $row['infectionID'];
             
        }

        
            if ($action == 'create') {
                if(isset($_POST['submit']))
                {
                    $infectedPersonID = $_POST['infectedPersonID'];
                    $medicareCard = $_POST['medicareCard'];
                    $infectionID = $_POST['infectionID'];

                    $checkIfPerson = "SELECT * FROM Person WHERE medicareCard = '$medicareCard'";
                    $result = mysqli_query($conn, $checkIfPerson);
                    if($result)
                    {
                        if(mysqli_num_rows($result) == 0)
                        {
                            echo '<div class="text-center text-danger mb-4">';
                            echo "Person with the following medicare card does not exist: " . $medicareCard;
                            echo '</div>';
    
                        }
                        else{
                           $sql = "INSERT INTO InfectedPerson (infectedPersonID, medicareCard, infectionID) VALUES ('$infectedPersonID', '$medicareCard', '$infectionID')";
                            if (mysqli_query($conn, $sql)) {
                                echo '<div class="text-center text-success mb-4">';
                                echo "New record created successfully";
                                echo '</div>';
                                echo $medicareCard;
                                $sendEmail ="SELECT Person.firstName, Person.lastName, Infection.infectionDate
                                from InfectedPerson
                                JOIN Infection ON InfectedPerson.infectionID = Infection.infectionID
                                JOIN Person ON InfectedPerson.medicareCard = Person.medicareCard
                                WHERE InfectedPerson.medicareCard = '$medicareCard'";

                                $result = mysqli_query($conn, $sendEmail);
                                $row = mysqli_fetch_assoc($result);
                                if($result)
                                {
                                    echo "success";
                                    var_dump($row);
                                    
                                }
                                else
                                {
                                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                                }
                                $firstName = $row['firstName'];
                                $lastName = $row['lastName'];
                                $infectionDate = $row['infectionDate'];

                                echo $firstName, $lastName, $infectionDate;

                                // $to = 'emaldan2000@gmail.com'; 
                                // $subject = 'WARNING: New Infected Person';
                                // $message = 'Hello, ' . $firstName . ' ' . $lastName . ' has been infected with COVID-19 on ' . $infectionDate . '. Please take the necessary precautions.';
                                // $headers = 'From: sender@example.com'; 
                                // if (mail($to, $subject, $message, $headers)) {
                                //     echo '<div class="text-center text-success mb-4">';
                                //     echo "Email sent successfully";
                                //     echo '</div>';
                                // } else {
                                //     echo '<div class="text-center text-danger mb-4">';
                                //     echo "Error sending email";
                                //     echo '</div>';
                                // }

                            } else {
                                 echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                            }
                           
                        }
                    }
                    else
                    {
                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                    }

                }
            } elseif ($action == 'edit') {
                
                if(isset($_POST['submit']))
                {
                    $originalInfectedPersonID = $_POST['originalInfectedPersonID'];
                    $newInfectedPersonID = $_POST['infectedPersonID'];
                    $newMedicareCard = $_POST['medicareCard'];
                    $newInfectionID = $_POST['infectionID'];
                    $infectedPersonID = isset($_GET['infectedPersonID']) ? $_GET['infectedPersonID'] : '';
                    $sql = "UPDATE infectedperson SET infectedPersonID = '$newInfectedPersonID', medicareCard = '$newMedicareCard', infectionID = '$newInfectionID' WHERE infectedPersonID = '$originalInfectedPersonID'";

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
        $infectedPersonID = isset($_GET['infectedPersonID']) ? $_GET['infectedPersonID'] : '';
        $sql = "DELETE FROM InfectedPerson WHERE infectedPersonID = '$infectedPersonID'";
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
                <label for="infectedPersonID">Infected Person ID</label>
                <input type="text" name="infectedPersonID" id="infectedPersonID" class="form-control" placeholder="Infected Person ID" value="<?php echo $infectedPersonID; ?>">
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
            <div class="form-row">
                <label for="infectionID">Infection ID</label>
                <input type="text" name="infectionID" id="infectionID" class="form-control" placeholder="Infection ID" value="<?php echo $infectionID; ?>">
   
            </div>
            <input type="hidden" name="originalInfectedPersonID" value="<?php echo $infectedPersonID; ?>">
            <input type="submit" name="submit" value="Submit" class="btn btn-primary">
        </form>
    </div>

    


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
