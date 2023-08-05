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

    $employeeID = $startWorkDate = $endWorkDate = $role = $medicareCard = '';

    if ($action == 'create' || $action == 'edit') {
        if ($action == 'edit') {
            echo "Does it go here?";
            echo $medicareCard;
            $employeeID = isset($_GET['employeeID']) ? $_GET['employeeID'] : '';
            $sql = "SELECT * FROM Employee WHERE employeeID = '$employeeID'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            if (!$result) {
                echo "Error: " . mysqli_error($conn); // Output the error message for debugging purposes
            }
            
            $employeeID = $row['employeeID'];
            $startWorkDate = $row['startWorkDate'];
            $endWorkDate = $row['endWorkDate'];
            $role = $row['employeeRole'];
            $medicareCard = $row['medicareCard'];

        }

        
            if ($action == 'create') {
                if(isset($_POST['submit']))
                {
                    $employeeID = $_POST['employeeID'];
                    $startWorkDate = $_POST['startWorkDate'];
                    $endWorkDate = $_POST['endWorkDate'];
                    $role = $_POST['employeeRole'];
                    $medicareCard = $_POST['medicareCard'];
                    
                    $checkIfPerson = "SELECT * FROM Person WHERE medicareCard = '$medicareCard'";
                    echo $checkIfPerson;
                    $result = mysqli_query($conn, $checkIfPerson);
                    if($result)
                    {
                        echo $medicareCard;
                        if(mysqli_num_rows($result) == 0)
                        {
                            echo '<div class="text-center text-danger mb-4">';
                            echo "Person with the following medicare card does not exist: " . $medicareCard;
                            echo '</div>';
    
                        }
                        else{
                            $sql = "INSERT INTO Employee (employeeID, startWorkDate, endWorkDate, employeeRole, medicareCard) VALUES ('$employeeID', '$startWorkDate', '$endWorkDate', '$role', '$medicareCard')";
                            if (mysqli_query($conn, $sql)) {
                                echo "New record created successfully!";
                                //header("Location: ../Tables/person.php");
                                //exit();
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
                    
            
                    $originalEmployeeID = $_POST['originalEmployeeID'];
                    $newEmployeeID = $_POST['employeeID'];
                    $newStartWorkDate = $_POST['startWorkDate'];
                    $newEndWorkDate = $_POST['endWorkDate'];
                    $newRole = $_POST['employeeRole'];
                    $newMedicareCard = $_POST['medicareCard'];
                    // if (empty($newEndWorkDate)) {
                    //     $newEndWorkDate = 'NULL';
                    // } else {
                    //     $newEndWorkDate = "'" . date('Y-m-d', strtotime($newEndWorkDate)) . "'";
                    // }
                    if (empty($newEndWorkDate)) {
                        $endWorkDate = "NULL";
                    } else {
                        $endWorkDate = "'" . date('Y-m-d', strtotime($newEndWorkDate)) . "'";
                    }
                    $sql = "UPDATE Employee SET employeeID = '$newEmployeeID', startWorkDate = '$newStartWorkDate', endWorkDate = '$endWorkDate', employeeRole = '$newRole', medicareCard = '$newMedicareCard' WHERE employeeID = '$originalEmployeeID'";
                    if (mysqli_query($conn, $sql)) {
                        echo "Record updated successfully!";
                        //header("Location: ../Tables/person.php");
                        //exit();
                    } else {
                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                    }
                }
                
            }

    }
    elseif ($action == 'delete') {
        $employeeID = isset($_GET['employeeID']) ? $_GET['employeeID'] : '';
        $sql = "DELETE FROM Employee WHERE employeeID = '$employeeID'";
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
                <label for="employeeID">Employee ID</label>
                <input type="text" name="employeeID" id="employeeID" class="form-control" placeholder="Employee ID" value="<?php echo $employeeID; ?>">
            </div>
            <div class="form-group">
                <label for="startWorkDate">Start Work Date </label>
                <input type="text" name="startWorkDate" id="startWorkDate" class="startWorkDate" placeholder="Start Work Date" value="<?php echo $startWorkDate; ?>">
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="endWorkDate">End Work Date</label>
                    <input type="text" name="endWorkDate" id="endWorkDate" class="form-control" placeholder="End Work Date" value="<?php echo $endWorkDate; ?>">
                </div>

                <div class="form-group col-md-6">
                    <label for="employeeRole">Employee Role</label>
                    <input type="text" name="employeeRole" id="employeeRole" class="form-control" placeholder="Employee Role" value="<?php echo $employeeRole; ?>">
                </div>
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
            <input type="hidden" name="originalEmployeeID" value="<?php echo $employeeID; ?>">
            <input type="submit" name="submit" value="Submit" class="btn btn-primary">
        </form>
    </div>

    


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
