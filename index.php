<?php
include ('config.php');

// //display all students on the page
// $sql = "SELECT * FROM Student";
// $result = mysqli_query($conn, $sql);

// if ($result->num_rows > 0) {
//     // output data of each row
//     while($row = $result->fetch_assoc()) {
//       echo "id: " . $row["studentID"]. " - medicare Card: " . $row["medicareCard"]. " " . $row["lastname"]. "<br>";
//     }
//   } else {
//     echo "0 results";
//   }
//   $conn->close();

//Form to create a new student
echo "<form action='create.php' method='post'>";
echo "First name: <input type='text' name='firstname'><br>";
echo "Last name: <input type='text' name='lastname'><br>";
echo "Medicare Card: <input type='text' name='medicareCard'><br>";
echo "<input type='submit'>";
echo "</form>";




?>




<!-- <HTML>
<HEAD>
 <TITLE>Date/Time Functions Demo</TITLE>
</HEAD>
<BODY>
<H1>Date/Time Functions Demo</H1>
<P>The current date and time is
<EM><?echo date("D M d, Y H:i:s", time())?></EM>
<P>Current PHP version:
<EM><?echo  phpversion()?></EM>
</BODY>
</HTML> -->
