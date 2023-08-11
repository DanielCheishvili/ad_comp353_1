<?php
include('config.php');


if (isset($_POST['queryNumber'])) {
    $queryNumber = $_POST['queryNumber'];
    
    $queryResult = ''; 
    
    switch ($queryNumber) {
        case 1:
            $queryResult = '<p>Query 1 result</p>';
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
            //write me a table of all the results
            if ($result && mysqli_num_rows($result) > 0) {
                $queryResult .= '<table class="table table-bordered table-striped">';
                $queryResult .= '<thead class="thead-dark"><tr><th scope="col">Facility Name</th><th scope="col">Address</th><th scope="col">City</th><th scope="col">Province</th><th scope="col">Postal Code</th><th scope="col">Phone Number</th><th scope="col">Web Address</th><th scope="col">Capacity</th><th scope="col">President/Principal</th><th scope="col">Number of Employees</th></tr></thead>';
                $queryResult .= '<tbody>';
                while ($row = mysqli_fetch_assoc($result)) {
                    $queryResult .= '<tr>';
                    $queryResult .= '<td>' . $row['facilityName'] . '</td>';
                    $queryResult .= '<td>' . $row['address'] . '</td>';
                    $queryResult .= '<td>' . $row['city'] . '</td>';
                    $queryResult .= '<td>' . $row['province'] . '</td>';
                    $queryResult .= '<td>' . $row['postalCode'] . '</td>';
                    $queryResult .= '<td>' . $row['phoneNumber'] . '</td>';
                    $queryResult .= '<td>' . $row['webAddress'] . '</td>';
                    $queryResult .= '<td>' . $row['capacity'] . '</td>';
                    $queryResult .= '<td>' . $row['firstName'] . ' ' . $row['lastName'] . '</td>';
                    $queryResult .= '<td>' . $row['NumberOfEmployees'] . '</td>';
                    $queryResult .= '</tr>';
                }
                $queryResult .= '</tbody>';
                $queryResult .= '</table>';
            } else {
                $queryResult .= '<p class="text-danger">No results found.</p>';
            }
           
            break;
        
        case 2:
            $queryResult = '<p>Query 2 result</p>';
            break;
        
        
        default:
            $queryResult = '<p>No query result found.</p>';
            break;
    }
    
    echo $queryResult;
}
?>


?>