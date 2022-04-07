<?php
session_start();
// get variables
$fname = ucwords(trim($_POST['fname']));
$lname = ucwords(trim($_POST['lname']));
$email = strtolower(trim($_POST['email']));
$pwd = $_POST['pwd'];
$pwd2 = $_POST['pwd2'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/~saburom1/Project/style.css" />
    <title>Register Result</title>
</head>

<body>
    <h1 style="padding-top: 40px">Registration Results:</h1>

    <div id="log-in">

        <?php

        // prevents injection attack
        $fname = addslashes($fname);
        $lname = addslashes($lname);
        $email = addslashes($email);
        $pwd = addslashes($pwd);
        $pwd2 = addslashes($pwd2);

        if ($pwd !== $pwd2) {
            echo '<p>Passwords do not match.</p>';
            echo '<a class = "link" href=/~saburom1/Project/login/register.html>Try again.</a>';
            exit;
        }

        // connects to database
        @$db = new mysqli('localhost', 'saburom1_marina', 'GrumpyBoba1!', 'saburom1_JewelryShop');

        if (mysqli_connect_errno()) {
            echo "Error: Could not connect to database.  Please try again later.";
            exit;
        }

        $epwd = password_hash($pwd, PASSWORD_BCRYPT);

        // finds matching credentials
        $query = "INSERT INTO CUSTOMER (CEmail, CPassword, CFname, CLName) VALUES ('" . $email . "', '" . $epwd . "', '" . $fname . "', '" . $lname . "')";

        $result = $db->query($query);

        // checks for successful result
        if ($result) {
            echo '<p>Account successfully created!</p></br>';
            echo '<a class = "link" href=/~saburom1/Project/main/homepage.php>Please enter.</a>';
            $_SESSION["email"] = $email;
            $_SESSION["epwd"] = $epwd;
            $_SESSION["cfname"] = $fname;
            $_SESSION['loggedin'] = TRUE;
        } else {
            echo '<p>Error. Your account could not be created.</p></br>';
            echo '<a class = "link" href=/~saburom1/Project/login/register.html>Try again.</a>';
        }

        // disconnect from database
        $result->free();
        $db->close();

        ?>
    </div>
</body>

</html>