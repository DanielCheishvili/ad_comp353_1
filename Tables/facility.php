<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facility Table</title>
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
        <h2 class="text-center">Facility Table</h2>
        <p class="text-center">Table displaying all the records of the Facility table.</p>
        <?php
        include('../config.php');
        
        $sql = "SELECT facilityID, Ministry.ministryName, facilityName, address, city, Facility.province, postalCode, phoneNumber, webAddress, capacity, Facility.ministryID FROM Facility
        JOIN Ministry on Ministry.ministryID = Facility.ministryID";
        $result = mysqli_query($conn, $sql);
        
        if (mysqli_num_rows($result) > 0) {
            echo '<div class="d-flex justify-content-center">';
            echo '<table class="table table-bordered">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>Facility ID</th>';
            echo '<th>Facility Name</th>';
            echo '<th>Ministry</th>';
            echo '<th>Address</th>';
            echo '<th>City</th>';
            echo '<th>Provicne</th>';
            echo '<th>Postal Code</th>';
            echo '<th>Phone Number</th>';
            echo '<th>Web Address</th>';
            echo '<th>Capacity</th>';
            echo '<th>Ministry ID</th>';
            echo '<th>Action</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
        
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . $row['facilityID'] . '</td>';
                echo '<td>' . $row['facilityName'] . '</td>';
                echo '<td>' . $row['ministryName'] . '</td>';
                echo '<td>' . $row['address'] . '</td>';
                echo '<td>' . $row['city'] . '</td>';
                echo '<td>' . $row['province'] . '</td>';
                echo '<td>' . $row['postalCode'] . '</td>';
                echo '<td>' . $row['phoneNumber'] . '</td>';
                echo '<td>' . $row['webAddress'] . '</td>';
                echo '<td>' . $row['capacity'] . '</td>';
                echo '<td>' . $row['ministryID'] . '</td>';
                echo '<td>';
                echo "<button class=\"btn btn-danger\" onclick=\"deletePerson('" . $row['facilityID'] . "')\">Delete</button>";
                echo "<button class=\"btn btn-warning\" onclick=\"editPerson('" . $row['facilityID'] . "')\">Edit</button>";
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
            window.location.href = "../CreateForum/FacilityForm.php?action=create";
        }
        function deletePerson(facilityID) {
            if (confirm("Are you sure you want to delete this Facility?")) {
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == XMLHttpRequest.DONE ) {
                        if(xhr.status == 200)
                        {
                            alert("Facility deleted successfully");
                            window.location.reload();
                        }
                        else
                        {
                            alert("Error deleting Facility");
                        }
                        
                    }
                };
                xhr.open("GET", "../CreateForum/FacilityForm.php?facilityID=" + facilityID + "&action=delete", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.send("facilityID=" + facilityID);

            }
        }
        function editPerson(facilityID) {
            window.location.href = "../CreateForum/FacilityForm.php?facilityID=" + facilityID + "&action=edit";
        }
    </script>   
       
    </div>

</body>
</html>
