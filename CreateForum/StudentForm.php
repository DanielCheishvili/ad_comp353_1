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

    $studentID  = $startSchoolDate = $endSchoolDate = $educationalFacilityId = $medicareCard = '';

    if ($action == 'create' || $action == 'edit') {
        if ($action == 'edit') {
            $studentID = isset($_GET['studentID']) ? $_GET['studentID'] : '';
            $sql = "SELECT * FROM Student WHERE studentID = '$studentID'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            if (!$result) {
                echo "Error: " . mysqli_error($conn); // Output the error message for debugging purposes
            }
            
            $studentID = $row['studentID'];
            $startSchoolDate = $row['startSchoolDate'];
            $endSchoolDate = $row['endSchoolDate'];
            $educationalFacilityId = $row['educationalFacilityId'];
            $medicareCard = $row['medicareCard'];
            

        }

        
            if ($action == 'create') {
                if(isset($_POST['submit']))
                {
                    $studentID = $_POST['studentID'];
                    $startSchoolDate = $_POST['startSchoolDate'];
                    $endSchoolDate = $_POST['endSchoolDate'] ? $_POST['endSchoolDate'] : null; // Set to null if empty
                    $educationalFacilityId = $_POST['educationalFacilityId'];
                    $medicareCard = $_POST['medicareCard'];

                    
                    $checkIfPerson = "SELECT * FROM Person WHERE medicareCard = '$medicareCard'";
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
                            $sql = "INSERT INTO Student (studentID, startSchoolDate, endSchoolDate, educationalFacilityId, medicareCard) VALUES (?, ?, ?, ?, ?)";
                            $stmt = mysqli_prepare($conn, $sql);
                            mysqli_stmt_bind_param($stmt, "sssss", $studentID, $startSchoolDate, $endSchoolDate, $educationalFacilityId, $medicareCard);
                            if (mysqli_stmt_execute($stmt)) {
                                echo "New record created successfully!";
                                //header("Location: ../Tables/person.php");
                                //exit();
                            } else {
                                echo "Error: " . mysqli_error($conn);
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
                    $originalStudentID = $_GET['originalStudentID'];
                    $newStudentID = $_POST['studentID'];
                    $newStartSchoolDate = $_POST['startSchoolDate'];
                    $newEndSchoolDate = $_POST['endSchoolDate'] ? $_POST['endSchoolDate'] : null; // Set to null if empty
                    $newEducationalFacilityId = $_POST['educationalFacilityId'];
                    //$newMedicareCard = $_POST['medicareCard'];


                    $sql = "UPDATE Student SET studentID = ?, startSchoolDate = ?, endSchoolDate = ?, educationalFacilityId = ? WHERE studentID = ?";
                    $stmt = mysqli_prepare($conn, $sql);
                    mysqli_stmt_bind_param($stmt, "ssssi", $newStudentID, $newStartSchoolDate, $newEndSchoolDate, $newEducationalFacilityId, $originalStudentID);
 
                    if (mysqli_stmt_execute($stmt)) {
                        echo "Record updated successfully!";
                        //header("Location: ../Tables/person.php");
                        //exit();
                    } else {
                        echo "Error: " . mysqli_error($conn);
                    }
 

                    mysqli_stmt_close($stmt);
                }
                
            }

    }
    elseif ($action == 'delete') {
        $studentID = isset($_GET['studentID']) ? $_GET['studentID'] : '';
        $sql = "DELETE FROM Student WHERE studentID = '$studentID'";
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
                <label for="studentID">Student ID</label>
                <input type="text" name="studentID" id="studentID" class="form-control" placeholder="Student ID" value="<?php echo $studentID; ?>"
                <?php
                if ($action == 'edit') {
                    echo 'readonly ';
                }
                echo 'value="' . $studentID . '"';
                ?>>
            </div>

            

            <div class="form-group">
                <label for="startSchoolDate">Start School Date </label>
                <input type="text" name="startSchoolDate" id="startSchoolDate" class="startSchoolDate" placeholder="Start School Date" value="<?php echo $startSchoolDate; ?>">
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="endSchoolDate">End School Date</label>
                    <input type="text" name="endSchoolDate" id="endSchoolDate" class="form-control" placeholder="End School Date" value="<?php echo $endSchoolDate; ?>">
                </div>

                <div class="form-group col-md-6">
                    <label for="educationalFacilityID">Educational Facility ID</label>
                    <input type="text" name="educationalFacilityID" id="educationalFacilityID" class="form-control" placeholder="Educational Facility ID " value="<?php echo $educationalFacilityId; ?>">
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
            <input type="hidden" name="originalStudentID" value="<?php echo $studentID; ?>">
            <input type="submit" name="submit" value="Submit" class="btn btn-primary">
        </form>
    </div>

    


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
