<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
<div class='wishlist-nav' style="margin-top:185px;">
            <a href='index.php'>home</a>
            > logout
        </div>
</body>
</html>
<?php
session_start(); // Start the session
include "connection.php";
include "header.php";

// Check if the user is already logged in
if (isset($_SESSION['user_id'])) {
    // Fetch the user details from the database using the session user_id
    $user_id = $_SESSION['user_id'];
    $result = mysqli_query($connection, "SELECT * FROM users WHERE id ='$user_id'");
    $user = mysqli_fetch_assoc($result);

    // Show the logout button and user name
    echo "<h1 style='color:black; text-align:center;text-transform: uppercase;margin:100px 0 0 0;'>Welcome " . htmlspecialchars($user['firstname']) . "!</h1>";
    echo "<form method='post'>
            <button type='submit' name='logout' style='background-color: #081d3a; margin:10px 720px; padding:10px; border-radius:5px; font-size:15px;text-transform: uppercase;'>Logout</button>
          </form>";

    // Handle logout logic
    if (isset($_POST['logout'])) {
        session_destroy(); // Destroy the session to log the user out
        echo "<script>window.location='login.php';</script>"; // Redirect to login page
        exit;
    }

} else {
    // If the user is not logged in, show the login form
    if (isset($_POST["submit"])) {
        $email = $_POST["email"];
        $pass = $_POST["password"];

        // Check if email and password are empty
        if (empty($email) || empty($pass)) {
            echo "<script>alert('please enter email and password');</script>";
        } else {
            $result = mysqli_query($connection, "SELECT * FROM users WHERE email ='$email'");
            $row = mysqli_fetch_assoc($result);

            if ($row) {
                $hash = password_verify($pass, $row['pass']);
                if ($hash && $email == $row["email"]) {
                    $_SESSION['user_id'] = $row['id'];
                    // echo "<div class='alert success'>Login successful</div>";
                    echo "<script>window.location='index.php';</script>"; // Redirect to login page
                    exit;
                } else {
                    echo "<script>alert('wrong password');</script>";
                }
            } else {
                echo "<script>alert('user not found');</script>";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Login</title>
</head>

<body>

<div class="login-wrapper">
        <div class="wishlist-nav">
            <a href="index.php">home</a>
            > Account
        </div>
        <h1>my account</h1>
        <div class="login">
            <h2>login</h2>
            <p>If you have an account with us, please log in.</p>
            <form action="login.php" method="post">
            <input type="email" placeholder="email" name="email" class="input">
            <input type="password" placeholder="password" name="password" class="input">
            <div class="login-btn">
                <button name="submit">SIGN IN</button>
                <a href="">forget your password?</a>
            </div>
            </form>
        </div>
        <div class="new-costomer">
            <h2>new costumer</h2>
            <p>Registering for this site allows you to access your order status and history. We’ll get a new account set
                up for you in no time. For this will only ask you for information necessary to make the purchase process
                faster and easier</p>
            <button><a href="register.php">create an account</a></button>
        </div>
    </div>

    <?php include "./footer.html";?>

</body>

</html>

<?php
} // End of if-else block for login
