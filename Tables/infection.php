<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Infection Table</title>
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
    <button class="btn btn-primary" onclick="insertRow()">Insert Row</button>
    <div class="container mt-5">
        <h2 class="text-center">Infection Table</h2>
        <p class="text-center">Table displaying all the records of the Infection table.</p>
        <?php
        include('../config.php');
        
        $sql = "SELECT infectedPersonID, Person.firstName, Person.lastName,Person.medicareCard,Infection.infectionType, Infection.infectionDate 
        FROM InfectedPerson
        JOIN Person ON InfectedPerson.medicareCard = Person.medicareCard
        JOIN Infection ON InfectedPerson.infectionID = Infection.infectionID";
        $result = mysqli_query($conn, $sql);
        
        if (mysqli_num_rows($result) > 0) {
            echo '<div class="d-flex justify-content-center">';
            echo '<table class="table table-bordered">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>Infected Person ID</th>';
            echo '<th>Medicare Card</th>';
            echo '<th>First Name</th>';
            echo '<th>Last Name</th>';
            echo '<th>Infection Type</th>';
            echo '<th>Infection Date</th>';
            echo '<th>Action</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
        
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . $row['infectedPersonID'] . '</td>';
                echo '<td>' . $row['medicareCard'] . '</td>';
                echo '<td>' . $row['firstName'] . '</td>';
                echo '<td>' . $row['lastName'] . '</td>';
                echo '<td>' . $row['infectionType'] . '</td>';
                echo '<td>' . $row['infectionDate'] . '</td>';
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
            window.location.href = "../CreateForum/InfectionForm.php?action=create";
        }
        function deletePerson(InfectedPersonID) {
            if (confirm("Are you sure you want to delete this Infected person?")) {
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == XMLHttpRequest.DONE ) {
                        if(xhr.status == 200)
                        {
                            alert("Infected Person deleted successfully");
                            window.location.reload();
                        }
                        else
                        {
                            alert("Error deleting Infected Person");
                        }
                        
                    }
                };
                xhr.open("GET", "../CreateForum/InfectionForm.php?infectedPersonID=" + InfectedPersonID + "&action=delete", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.send("infectedPersonID=" + InfectedPersonID);

            }
        }
        function editPerson(InfectedPersonID) {
            window.location.href = "../CreateForum/InfectionForm.php?infectedPersonID=" + InfectedPersonID + "&action=edit";
        }
    </script>
       
    </div>

</body>
</html>
