<?php
include('config.php');

if (isset($_GET['studentID']) && $_GET['action'] == 'check_register') {
    $studentID = $_GET['studentID'];
    
    $checkEndDateQuery = "SELECT endSchoolDate FROM Student WHERE studentID = '$studentID'";
    $checkEndDateResult = mysqli_query($conn, $checkEndDateQuery);

    if ($checkEndDateResult && mysqli_num_rows($checkEndDateResult) > 0) {
        $row = mysqli_fetch_assoc($checkEndDateResult);
        $endSchoolDate = $row['endSchoolDate'];
        
        if ($endSchoolDate === null) {
            echo 'cannot_register';
        } else {
            echo 'can_register';
        }
    } else {
        echo 'error';
    }

    mysqli_close($conn);
}
?>
