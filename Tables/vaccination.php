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
    <button class="btn btn-primary" onclick="insertRow()">Insert Row</button>
    <div class="container mt-5">
        <h2 class="text-center">Vaccination Table</h2>
        <p class="text-center">Table displaying all the records of the Infection table.</p>
        <?php
        include('../config.php');
        
        $sql = "SELECT vaccinatedPerson, Person.firstName, Person.lastName,Person.medicareCard,Vaccination.doseNumber, Vaccination.doseDate, Vaccination.doseType 
        FROM VaccinatedPerson
        JOIN Person ON VaccinatedPerson.medicareCard = Person.medicareCard
        JOIN Vaccination ON VaccinatedPerson.vaccinationID = Vaccination.vaccinationID";
        $result = mysqli_query($conn, $sql);
        
        if (mysqli_num_rows($result) > 0) {
            echo '<div class="d-flex justify-content-center">';
            echo '<table class="table table-bordered">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>Vaccinated Person ID</th>';
            echo '<th>Medicare Card</th>';
            echo '<th>First Name</th>';
            echo '<th>Last Name</th>';
            echo '<th>Dose Number</th>';
            echo '<th>Dose Date</th>';
            echo '<th>Dose Type</th>';
            echo '<th>Action</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
        
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . $row['vaccinatedPerson'] . '</td>';
                echo '<td>' . $row['medicareCard'] . '</td>';
                echo '<td>' . $row['firstName'] . '</td>';
                echo '<td>' . $row['lastName'] . '</td>';
                echo '<td>' . $row['doseNumber'] . '</td>';
                echo '<td>' . $row['doseDate'] . '</td>';
                echo '<td>' . $row['doseType'] . '</td>';

                echo '<td>';
                echo "<button class=\"btn btn-danger\" onclick=\"deletePerson('" . $row['infectedPersonID'] . "')\">Delete</button>";
                echo "<button class=\"btn btn-warning\" onclick=\"editPerson('" . $row['infectedPersonID'] . "')\">Edit</button>";
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
    <script>
        function insertRow()
        {
            window.location.href = "../CreateForum/VaccinationForm.php?action=create";
        }
        function deletePerson(InfectedPersonID) {
            if (confirm("Are you sure you want to delete this Vaccinated person?")) {
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == XMLHttpRequest.DONE ) {
                        if(xhr.status == 200)
                        {
                            alert("Vaccinated Person deleted successfully");
                            window.location.reload();
                        }
                        else
                        {
                            alert("Error deleting Vaccinated Person");
                        }
                        
                    }
                };
                xhr.open("GET", "../CreateForum/VaccinationForm.php?vaccinatedPerson=" + vaccinatedPersonID + "&action=delete", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.send("vaccinatedPerson=" + vaccinatedPersonID);

            }
        }
        function editPerson(vaccinatedPersonID) {
            window.location.href = "../CreateForum/VaccinationForm.php?vaccinatedPerson=" + vaccinatedPersonID + "&action=edit";
        }
    </script>
       
    </div>

</body>
</html>
