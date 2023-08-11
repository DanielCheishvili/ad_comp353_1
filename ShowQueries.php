<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    include('config.php');
    $sql = "SELECT
    Facility.facilityName,
    Facility.address,
    Facility.city,
    Facility.province,
    Facility.postalCode,
    Facility.phoneNumber,
    Facility.webAddress,
    Facility.capacity,
    Person.firstName,
    Person.lastName,
    COUNT(Employee.employeeID) AS NumberOfEmployees
    FROM Facility
    LEFT JOIN ManagementFacility ON ManagementFacility.facilityID = Facility.facilityID
    LEFT JOIN EducationalFacility ON EducationalFacility.educationFacilityID = Facility.facilityID
    LEFT JOIN Employee ON Employee.employeeID = ManagementFacility.presidentID OR Employee.employeeID = EducationalFacility.principalID
    LEFT JOIN Person ON Person.medicareCard = Employee.medicareCard
    GROUP BY
    Facility.facilityName,
    Facility.address,
    Facility.city,
    Facility.province,
    Facility.postalCode,
    Facility.phoneNumber,
    Facility.webAddress,
    Facility.capacity,
    Person.firstName,
    Person.lastName
    ORDER BY 
    Facility.province ASC, Facility.city ASC, Facility.facilityID ASC, NumberOfEmployees ASC
    ";

    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        echo "<table border='1'><tr><th>Facility Name</th><th>Address</th><th>City</th><th>Province</th><th>Postal Code</th><th>Phone Number</th><th>Web Address</th><th>Capacity</th><th>President/Principal</th><th>Number of Employees</th></tr>";
        while($row = mysqli_fetch_assoc($result)) {
            echo "<tr><td>".$row["facilityName"]."</td><td>".$row["address"]."</td><td>".$row["city"]."</td><td>".$row["province"]."</td><td>".$row["postalCode"]."</td><td>".$row["phoneNumber"]."</td><td>".$row["webAddress"]."</td><td>".$row["capacity"]."</td><td>".$row["firstName"]." ".$row["lastName"]."</td><td>".$row["NumberOfEmployees"]."</td></tr>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }
    ?>
</body>
</html>