<?php
include ('config.php');

//display all students on the page
$sql = "SELECT * FROM students";
$result = mysqli_query($conn, $sql);

echo $result;



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
