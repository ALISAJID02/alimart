<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>register</title>
</head>

<body>
<?php
include "header.php";
include "connection.php";

if(isset($_POST["submit"])) {
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Input validation
    if(empty($firstname) || empty($lastname) || empty($email) || empty($password)) {
        echo "<script>alert('Please fill in all fields');</script>";
    } else {
        $duplicate = mysqli_query($connection, "SELECT * FROM users WHERE email ='$email'");
        if(mysqli_num_rows($duplicate) > 0) {
            echo "<script>alert('Email is already taken');</script>";
        } else {
            $hashpass = password_hash($password, PASSWORD_DEFAULT);
            $insert = "INSERT INTO users (firstname, lastname, email, pass) VALUES ('$firstname', '$lastname', '$email', '$hashpass')";
            mysqli_query($connection, $insert);
            echo "<script>alert('Registration successful');</script>";
            echo "<script>window.location='login.php';</script>"; // Redirect to login page
        }
    }
}
?>

    <div class="register-wrapper">
        <div class="wishlist-nav">
            <a href="index.php">home</a>
            > Create Account
        </div>
        <div class="register">
            <h1>Create an Account</h1>
            <form action="register.php" method="post">
                <input type="text" placeholder="first name" class="names" require name="firstname">
                <input type="text" placeholder="last name" class="names" name="lastname"><br>
                <input type="email" placeholder="email" class="reg" require name="email"><br>
                <input type="password" placeholder="password" class="reg" require name="password"><br>
                <div class="checkbox"><input type="checkbox">Subscribe to stay updated with new products and offers!
                </div>
                <button name="submit">submit</button>
            </form>
        </div>
    </div>
    <?php include "footer.html";?>
    <script src="script.js"></script>

</body>

</html>