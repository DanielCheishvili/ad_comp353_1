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
            if ($result && mysqli_num_rows($result) > 0) {
                $queryResult .= '<div class="text-center">'; 
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
                $queryResult .= '</div>';
            } else {
                $queryResult .= '<p class="text-danger">No results found.</p>';
            }
           
            break;
        
        case 2:
            $queryResult = '<p>Query 2 result</p>';
            $sql = "SELECT
            Person.firstName,
            Person.lastName,
            Employee.startWorkDate,
            Person.dateOfBirth,
            Person.medicareCard,
            Person.telephoneNumber,
            Person.address,
            Person.city,
            Person.province,
            Person.postalCode,
            Person.citizenship,
            Person.email,
            Employee.employeeRole
            FROM Employee
            INNER JOIN Person ON Person.medicareCard = Employee.medicareCard
            ORDER BY
            Employee.employeeRole ASC, Person.firstName ASC, Person.lastName";

            $result = mysqli_query($conn, $sql);
            if ($result && mysqli_num_rows($result) > 0) {
                $queryResult .= '<div class="text-center">'; 
                $queryResult .= '<table class="table table-bordered table-striped">';
                $queryResult .= '<thead class="thead-dark"><tr><th scope="col">First Name</th><th scope="col">Last Name</th><th scope="col">Start Work Date</th><th scope="col">Date of Birth</th><th scope="col">Medicare Card</th><th scope="col">Telephone Number</th><th scope="col">Address</th><th scope="col">City</th><th scope="col">Province</th><th scope="col">Postal Code</th><th scope="col">Citizenship</th><th scope="col">Email</th><th scope="col">Employee Role</th></tr></thead>';
                $queryResult .= '<tbody>';
                while ($row = mysqli_fetch_assoc($result)) {
                    $queryResult .= '<tr>';
                    $queryResult .= '<td>' . $row['firstName'] . '</td>';
                    $queryResult .= '<td>' . $row['lastName'] . '</td>';
                    $queryResult .= '<td>' . $row['startWorkDate'] . '</td>';
                    $queryResult .= '<td>' . $row['dateOfBirth'] . '</td>';
                    $queryResult .= '<td>' . $row['medicareCard'] . '</td>';
                    $queryResult .= '<td>' . $row['telephoneNumber'] . '</td>';
                    $queryResult .= '<td>' . $row['address'] . '</td>';
                    $queryResult .= '<td>' . $row['city'] . '</td>';
                    $queryResult .= '<td>' . $row['province'] . '</td>';
                    $queryResult .= '<td>' . $row['postalCode'] . '</td>';
                    $queryResult .= '<td>' . $row['citizenship'] . '</td>';
                    $queryResult .= '<td>' . $row['email'] . '</td>';
                    $queryResult .= '<td>' . $row['employeeRole'] . '</td>';
                    $queryResult .= '</tr>';
                }
                $queryResult .= '</tbody>';
                $queryResult .= '</table>';
                $queryResult .= '</div>';
            } else {
                $queryResult .= '<p class="text-danger">No results found.</p>';
            }
            break;
        case 3:
            $queryResult = '<p>Query 3 result</p>';
            $sql = "SELECT
            Facility.facilityName,
            Schedule.scheduleDate,
            Schedule.scheduleStartTime,
            Schedule.scheduleEndTime
            FROM Schedule
            INNER JOIN Facility ON Facility.facilityID = Schedule.facilityID
            WHERE
            Schedule.employeeID = '6'
            AND Schedule.scheduleDate >= '2023-07-04'
            AND Schedule.scheduleDate <= '2023-10-05'
            ORDER BY
            Facility.facilityName ASC, Schedule.scheduleDate ASC, Schedule.scheduleStartTime ASC";

            $result = mysqli_query($conn, $sql);

            if ($result && mysqli_num_rows($result) > 0) {
                $queryResult .= '<div class="text-center">'; 
                $queryResult .= '<table class="table table-bordered table-striped">';
                $queryResult .= '<thead class="thead-dark"><tr><th scope="col">Facility Name</th><th scope="col">Schedule Date</th><th scope="col">Schedule Start Time</th><th scope="col">Schedule End Time</th></tr></thead>';
                $queryResult .= '<tbody>';
                while ($row = mysqli_fetch_assoc($result)) {
                    $queryResult .= '<tr>';
                    $queryResult .= '<td>' . $row['facilityName'] . '</td>';
                    $queryResult .= '<td>' . $row['scheduleDate'] . '</td>';
                    $queryResult .= '<td>' . $row['scheduleStartTime'] . '</td>';
                    $queryResult .= '<td>' . $row['scheduleEndTime'] . '</td>';
                    $queryResult .= '</tr>';
                }
                $queryResult .= '</tbody>';
                $queryResult .= '</table>';
                $queryResult .= '</div>';
            } else {
                $queryResult .= '<p class="text-danger">No results found.</p>';
            }
            break;
        case 4:

            $queryResult = '<p>Query 4 result</p>';
            $sql = "SELECT
            Person.firstName,
            Person.lastName,
            Infection.infectionDate,
            Facility.facilityName
            FROM Teacher
            INNER JOIN Employee ON Employee.employeeID = Teacher.employeeID
            INNER JOIN Person ON Person.medicareCard = Employee.medicareCard
            INNER JOIN InfectedPerson ON InfectedPerson.medicareCard = Person.medicareCard
            INNER JOIN Infection ON Infection.infectionID = InfectedPerson.infectionID
            INNER JOIN EducationalFacility ON EducationalFacility.educationFacilityID = Teacher.educationalFacilityID
            INNER JOIN Facility ON Facility.FacilityID = EducationalFacility.FacilityID	
            WHERE
                Infection.infectionType = 'covid-19'
            AND Infection.infectionDate >= DATE_SUB(NOW(), INTERVAL 14 DAY)
            ORDER BY
                Facility.facilityName ASC, Person.firstName ASC";

            $result = mysqli_query($conn, $sql);


            if ($result && mysqli_num_rows($result) > 0) {
                $queryResult .= '<div class="text-center">'; 
                $queryResult .= '<table class="table table-bordered table-striped">';
                $queryResult .= '<thead class="thead-dark"><tr><th scope="col">First Name</th><th scope="col">Last Name</th><th scope="col">Infection Date</th><th scope="col">Facility Name</th></tr></thead>';
                $queryResult .= '<tbody>';
                while ($row = mysqli_fetch_assoc($result)) {
                    $queryResult .= '<tr>';
                    $queryResult .= '<td>' . $row['firstName'] . '</td>';
                    $queryResult .= '<td>' . $row['lastName'] . '</td>';
                    $queryResult .= '<td>' . $row['infectionDate'] . '</td>';
                    $queryResult .= '<td>' . $row['facilityName'] . '</td>';
                    $queryResult .= '</tr>';
                }
                $queryResult .= '</tbody>';
                $queryResult .= '</table>';
                $queryResult .= '</div>';
            } else {
                $queryResult .= '<p class="text-danger">No results found.</p>';
            }
            break;
        
        case 5:

            $queryResult = '<p>Query 5 result</p>';
            $sql = "SELECT
            emailDate,
            senderFacility,
            receiverEmail,
            emailSubject,
            emailBody
            From Log
            Where 
            senderFacility = 'Rosemont Elementary School'
            ORDER BY 
            emailDate ASC";

            $result = mysqli_query($conn, $sql);


            if ($result && mysqli_num_rows($result) > 0) {
                $queryResult .= '<div class="text-center">'; 
                $queryResult .= '<table class="table table-bordered table-striped">';
                $queryResult .= '<thead class="thead-dark"><tr><th scope="col">Email Date</th><th scope="col">Sender Facility</th><th scope="col">Receiver Email</th><th scope="col">Email Subject</th><th scope="col">Email Body</th></tr></thead>';
                $queryResult .= '<tbody>';
                while ($row = mysqli_fetch_assoc($result)) {
                    $queryResult .= '<tr>';
                    $queryResult .= '<td>' . $row['emailDate'] . '</td>';
                    $queryResult .= '<td>' . $row['senderFacility'] . '</td>';
                    $queryResult .= '<td>' . $row['receiverEmail'] . '</td>';
                    $queryResult .= '<td>' . $row['emailSubject'] . '</td>';
                    $queryResult .= '<td>' . $row['emailBody'] . '</td>';
                    $queryResult .= '</tr>';
                }
                $queryResult .= '</tbody>';
                $queryResult .= '</table>';
                $queryResult .= '</div>';
            } else {
                $queryResult .= '<p class="text-danger">No results found.</p>';
            }

            break;
        
        case 6: 
            $queryResult = '<p>Query 6 result</p>';
            $sql = "SELECT
            Person.firstName,
            Person.lastName,
            Teacher.specialization
            FROM Teacher
            INNER JOIN Employee ON Employee.employeeID = Teacher.employeeID
            INNER JOIN Person ON Person.medicareCard = Employee.medicareCard
            INNER JOIN Schedule ON Schedule.employeeID = Employee.employeeID
            WHERE
                Schedule.facilityID = '1'
            AND Schedule.scheduleDate >= DATE_SUB(NOW(), INTERVAL 14 DAY)
            ORDER BY Teacher.specialization ASC, Person.firstName ASC"; 
            
            $result = mysqli_query($conn, $sql);


            if ($result && mysqli_num_rows($result) > 0) {
                $queryResult .= '<div class="text-center">'; 
                $queryResult .= '<table class="table table-bordered table-striped">';
                $queryResult .= '<thead class="thead-dark"><tr><th scope="col">First Name</th><th scope="col">Last Name</th><th scope="col">Specialization</th></tr></thead>';
                $queryResult .= '<tbody>';
                while ($row = mysqli_fetch_assoc($result)) {
                    $queryResult .= '<tr>';
                    $queryResult .= '<td>' . $row['firstName'] . '</td>';
                    $queryResult .= '<td>' . $row['lastName'] . '</td>';
                    $queryResult .= '<td>' . $row['specialization'] . '</td>';
                    $queryResult .= '</tr>';
                }
                $queryResult .= '</tbody>';
                $queryResult .= '</table>';
                $queryResult .= '</div>';
            } else {
                $queryResult .= '<p class="text-danger">No results found.</p>';
            }
            break;

        case 7:

            $queryResult = '<p>Query 7 result</p>';
            $sql = "SELECT 
            Person.firstName,
            Person.lastName,
            SUM((TIMESTAMPDIFF(SECOND, Schedule.scheduleStartTime, Schedule.scheduleEndTime)) / 3600) AS totalHours
            FROM Person 
            JOIN 
            Employee ON Person.medicareCard= Employee.medicareCard
            LEFT JOIN 
                 Teacher ON Employee.employeeID = Teacher.employeeID
            LEFT JOIN 
            Schedule ON Employee.employeeID = Schedule.employeeID
            AND Schedule.facilityID = (SELECT facilityID FROM Facility WHERE facilityName = 'Rosemont Elementary School')
            WHERE 
                 Schedule.scheduleDate >= '2023-07-04'
                    AND Schedule.scheduleDate <= '2023-10-05'
            GROUP BY 
                    Person.firstName,Person.lastName
            ORDER BY 
                    Person.firstName,Person.lastName";
            
            $result = mysqli_query($conn, $sql);


            if ($result && mysqli_num_rows($result) > 0) {
                $queryResult .= '<div class="text-center">'; 
                $queryResult .= '<table class="table table-bordered table-striped">';
                $queryResult .= '<thead class="thead-dark"><tr><th scope="col">First Name</th><th scope="col">Last Name</th><th scope="col">Total Hours</th></tr></thead>';
                $queryResult .= '<tbody>';
                while ($row = mysqli_fetch_assoc($result)) {
                    $queryResult .= '<tr>';
                    $queryResult .= '<td>' . $row['firstName'] . '</td>';
                    $queryResult .= '<td>' . $row['lastName'] . '</td>';
                    $queryResult .= '<td>' . $row['totalHours'] . '</td>';
                    $queryResult .= '</tr>';
                }
                $queryResult .= '</tbody>';
                $queryResult .= '</table>';
                $queryResult .= '</div>';
            } else {
                $queryResult .= '<p class="text-danger">No results found.</p>';
            }
            break;

        case 8:
            $queryResult = '<p>Query 8 result</p>';
            $sql = "SELECT
            Facility.province,
            Facility.facilityName AS School,
            Facility.capacity,
            COUNT(DISTINCT CASE WHEN Teacher.teacherID IS NOT NULL AND Infection.infectionDate >= DATE_SUB(NOW(), INTERVAL 14 DAY) THEN Teacher.teacherID END) AS totalTeachersInfected,
            COUNT(DISTINCT CASE WHEN Student.studentID IS NOT NULL AND Infection.infectionDate >= DATE_SUB(NOW(), INTERVAL 14 DAY) THEN Student.studentID END) AS totalStudentsInfected
            FROM Facility 
            JOIN
            EducationalFacility ON Facility.facilityID = EducationalFacility.facilityID
            LEFT JOIN
            Teacher ON EducationalFacility.educationFacilityID = Teacher.educationalFacilityID
            LEFT JOIN
                    Employee ON Employee.employeeID = Teacher.employeeID
            LEFT JOIN
            InfectedPerson ON Employee.medicareCard = InfectedPerson.medicareCard
            LEFT JOIN
            Infection ON InfectedPerson.infectionID = Infection.infectionID
            LEFT JOIN
            Student ON EducationalFacility.studentID = Student.studentID
            WHERE
            Infection.infectionDate >= DATE_SUB(NOW(), INTERVAL 14 DAY) 
            OR Infection.infectionDate IS NULL
            GROUP BY
            Facility.province, Facility.facilityName, Facility.capacity
            ORDER BY Facility.province ASC, totalTeachersInfected ASC";

            $result = mysqli_query($conn, $sql);


            if ($result && mysqli_num_rows($result) > 0) {
                $queryResult .= '<div class="text-center">'; 
                $queryResult .= '<table class="table table-bordered table-striped">';
                $queryResult .= '<thead class="thead-dark"><tr><th scope="col">Province</th><th scope="col">School</th><th scope="col">Capacity</th><th scope="col">Total Teachers Infected</th><th scope="col">Total Students Infected</th></tr></thead>';
                $queryResult .= '<tbody>';
                while ($row = mysqli_fetch_assoc($result)) {
                    $queryResult .= '<tr>';
                    $queryResult .= '<td>' . $row['province'] . '</td>';
                    $queryResult .= '<td>' . $row['School'] . '</td>';
                    $queryResult .= '<td>' . $row['capacity'] . '</td>';
                    $queryResult .= '<td>' . $row['totalTeachersInfected'] . '</td>';
                    $queryResult .= '<td>' . $row['totalStudentsInfected'] . '</td>';
                    $queryResult .= '</tr>';
                }
                $queryResult .= '</tbody>';
                $queryResult .= '</table>';
                $queryResult .= '</div>';
            } else {
                $queryResult .= '<p class="text-danger">No results found.</p>';
            }
            break;

        case 9:
            $queryResult = '<p>Query 9 result</p>';

            $sql = "SELECT 
            Person.firstName,
            Person.lastName,
            Person.city AS ministerCity,
            (
            SELECT COUNT(DISTINCT ManagementFacility.managementFacilityID)
                        FROM ManagementFacility
            WHERE ManagementFacility.presidentID = Employee.employeeID
                    ) 
            AS totalManagementFacilities,
                    (
            SELECT COUNT(DISTINCT EducationalFacility.educationFacilityID)
                        FROM EducationalFacility 
            WHERE EducationalFacility.principalID = Employee.employeeID
                    ) 
            AS totalEducationalFacilities
            FROM Employee
            JOIN 
                    Person ON Employee.medicareCard = Person.medicareCard
            WHERE
            Employee.employeeRole = 'other'OR Employee.employeeRole = 'principle'
            GROUP BY 
            Employee.employeeID, Person.firstName, Person.lastName, Person.city
            ORDER BY 
            Person.city ASC, totalEducationalFacilities DESC";

            $result = mysqli_query($conn, $sql);


            if ($result && mysqli_num_rows($result) > 0) {
                $queryResult .= '<div class="text-center">'; 
                $queryResult .= '<table class="table table-bordered table-striped">';
                $queryResult .= '<thead class="thead-dark"><tr><th scope="col">First Name</th><th scope="col">Last Name</th><th scope="col">City</th><th scope="col">Total Management Facilities</th><th scope="col">Total Educational Facilities</th></tr></thead>';
                $queryResult .= '<tbody>';
                while ($row = mysqli_fetch_assoc($result)) {
                    $queryResult .= '<tr>';
                    $queryResult .= '<td>' . $row['firstName'] . '</td>';
                    $queryResult .= '<td>' . $row['lastName'] . '</td>';
                    $queryResult .= '<td>' . $row['ministerCity'] . '</td>';
                    $queryResult .= '<td>' . $row['totalManagementFacilities'] . '</td>';
                    $queryResult .= '<td>' . $row['totalEducationalFacilities'] . '</td>';
                    $queryResult .= '</tr>';
                }
                $queryResult .= '</tbody>';
                $queryResult .= '</table>';
                $queryResult .= '</div>';
            } else {
                $queryResult .= '<p class="text-danger">No results found.</p>';
            }
            break;
        
        case 10:
            $queryResult = '<p>Query 10 result</p>';
            $sql = "SELECT 
            Person.firstName,
                    Person.lastName,
                    Employee.startWorkDate,
                    Teacher.specialization,
                    Person.dateOfBirth,
                  Person.email,
            SUM((TIMESTAMPDIFF(SECOND, Schedule.scheduleStartTime, Schedule.scheduleEndTime)) / 3600) AS totalScheduledHours
            FROM Person
            JOIN Employee ON Person.medicareCard = Employee.medicareCard
            JOIN Teacher ON Employee.employeeID = Teacher.employeeID
            JOIN InfectedPerson ON Person.medicareCard = InfectedPerson.medicareCard
            JOIN Infection ON InfectedPerson.infectionID = Infection.infectionID AND Infection.infectionType = 'covid-19'
            JOIN Schedule ON Employee.employeeID = Schedule.employeeID
            WHERE 
                    Teacher.additionalRole = 'school counselor'
            GROUP BY 
                    Person.firstName,
                   Person.lastName,
                    Employee.startWorkDate,
                    Teacher.specialization,
                    Person.dateOfBirth,
                    Person.email
            HAVING 
            COUNT(InfectedPerson.infectionID) >= 3
            ORDER BY 
                    Teacher.specialization ASC,
                    Person.firstName ASC,
                    Person.lastName ASC";
            
            $result = mysqli_query($conn, $sql);

            //write me a table to display all results
            if ($result && mysqli_num_rows($result) > 0) {
                $queryResult .= '<div class="text-center">'; 
                $queryResult .= '<table class="table table-bordered table-striped">';
                $queryResult .= '<thead class="thead-dark"><tr><th scope="col">First Name</th><th scope="col">Last Name</th><th scope="col">Start Work Date</th><th scope="col">Specialization</th><th scope="col">Date of Birth</th><th scope="col">Email</th><th scope="col">Total Scheduled Hours</th></tr></thead>';
                $queryResult .= '<tbody>';
                while ($row = mysqli_fetch_assoc($result)) {
                    $queryResult .= '<tr>';
                    $queryResult .= '<td>' . $row['firstName'] . '</td>';
                    $queryResult .= '<td>' . $row['lastName'] . '</td>';
                    $queryResult .= '<td>' . $row['startWorkDate'] . '</td>';
                    $queryResult .= '<td>' . $row['specialization'] . '</td>';
                    $queryResult .= '<td>' . $row['dateOfBirth'] . '</td>';
                    $queryResult .= '<td>' . $row['email'] . '</td>';
                    $queryResult .= '<td>' . $row['totalScheduledHours'] . '</td>';
                    $queryResult .= '</tr>';
                }
                $queryResult .= '</tbody>';
                $queryResult .= '</table>';
                $queryResult .= '</div>';
            } else {
                $queryResult .= '<p class="text-danger">No results found.</p>';
            }
    
            break;
            
              
        
        
        default:
            $queryResult = '<p>No query result found.</p>';
            break;
    }
    
    echo $queryResult;
}
?>


?>