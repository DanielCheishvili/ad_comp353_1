<?php 
        include ('config.php');
        $medicareCard = $firstName = $lastName = $address = $city = $province = 
        $postalCode = $telephoneNumber = $email =  $dateOfBirth = $medicareExpiryDate = $citizenship = "";

        $medicareCard_err = $firstName_err = $lastName_err = $address_err = $city_err = $province_err = $postalCode_err = 
        $telephoneNumber_err = $email_err =  $dateOfBirth_err = $medicareExpiryDate_err = $citizenship_err = "";
        echo "Hello";
        if(isset($_POST['POST']))
        {
            echo "not empty";
            $medicareCard = $_POST['medicareCard'];
            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $address = $_POST['address'];
            $city = $_POST['city'];
            $province = $_POST['province'];
            $postalCode = $_POST['postalCode'];
            $telephoneNumber = $_POST['telephoneNumber'];
            $email = $_POST['email'];
            $dateOfBirth = $_POST['dateOfBirth'];
            $medicareExpiryDate = $_POST['medicareExpiryDate'];
            $citizenship = $_POST['citizenship'];
            if(empty($medicareCard) || empty($firstName) || empty($lastName) || empty($address) || empty($city) || empty($province) || empty($postalCode) || empty($telephoneNumber) || empty($email) || empty($dateOfBirth) || empty($medicareExpiryDate) || empty($citizenship))
            {
               echo "Please fill all the fields";
            }
            else
            {
                $sql = "INSERT INTO person (medicareCard, firstName, lastName, address, city, province, postalCode, telephoneNumber, email, dateOfBirth, medicareExpiryDate, citizenship)
                VALUES ('$medicareCard', '$firstName', '$lastName', '$address', '$city', '$province', '$postalCode', '$telephoneNumber', '$email', '$dateOfBirth', '$medicareExpiryDate', '$citizenship')";
                if(mysqli_query($conn, $sql))
                {
                    echo "Record added successfully";
                }
                else
                {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
            }
        }
        mysqli_close($conn);
?>