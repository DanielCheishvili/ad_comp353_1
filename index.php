<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <h1> Create A Person </h1>
    <form action="createPerson.php" method="POST">
        <label for="medicareCard">Medicare Card</label>
        <input type="text" name="medicareCard" id="medicareCard" placeholder="Medicare Card">
        <br>
        <label for="firstName">First Name</label>
        <input type="text" name="firstName" id="firstName" placeholder="First Name">
        <br>
        <label for="lastName">Last Name</label>
        <input type="text" name="lastName" id="lastName" placeholder="Last Name">
        <br>
        <label for="address">Address</label>
        <input type="text" name="address" id="address" placeholder="Address">
        <br>
        <label for="city">City</label>
        <input type="text" name="city" id="city" placeholder="City">
        <br>
        <label for="province">Province</label>
        <input type="text" name="province" id="province" placeholder="Province">
        <br>
        <label for="postalCode">Postal Code</label>
        <input type="text" name="postalCode" id="postalCode" placeholder="Postal Code">
        <br>
        <label for="telephoneNumber">Telephone Number</label>
        <input type="text" name="telephoneNumber" id="telephoneNumber" placeholder="Telephone Number">
        <br>
        <label for="email">Email</label>
        <input type="text" name="email" id="email" placeholder="Email">
        <br>
        <label for="dateOfBirth">Date Of Birth</label>
        <input type="text" name="dateOfBirth" id="dateOfBirth" placeholder="Date Of Birth">
        <br>
        <label for="medicareExpiryDate">Medicare Expiry Date</label>
        <input type="text" name="medicareExpiryDate" id="medicareExpiryDate" placeholder="Medicare Expiry Date">
        <br>
        <label for="citizenship">Citizenship</label>
        <input type="checkbox" name="citizenship" id="citizenship" placeholder="Citizenship">
        <br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>