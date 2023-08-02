<?php
include ('config.php');

//display all students on the page
$sql = "SELECT * FROM Student";
$result = mysqli_query($conn, $sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      echo "id: " . $row["studentID"]. " - medicare Card: " . $row["medicareCard"]. "<br>";
    }
  } else {
    echo "0 results";
  }
  $conn->close();



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
