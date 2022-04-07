<?php
session_start();
require '../functions/db.php';
// get variables
$email = $_POST['email'];
$pwd = $_POST['pwd'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css" />
    <title>Employee Login Result</title>
</head>

<body>
    <h1 style="padding-top: 40px">Employee Login Results:</h1>

    <div id="log-in">

        <?php

        // prevents injection attack 
        $email = addslashes($email);
        $pwd = addslashes($pwd);

        $query = "SELECT * FROM EMPLOYEE WHERE EmpEmail = '" . $email . "'";
        $result = $db->query($query);
        $row = $result->fetch_assoc();
        $epwd = $row['EmpPassword'];

        if (mysqli_num_rows($result) == 0 || !(password_verify($pwd, $epwd)) || $row['isActive'] == '0') {
            echo '<p>Incorrect credentials.</p></br>';
            echo '<a class = "link" href="login.html">try again</a>';
        } else {
            echo '<p>Correct credentials!</p></br>';
            echo '<a class = "link" href="employeehome.php">please enter</a>';
            $_SESSION["email"] = $email;
            $_SESSION["empID"] = $row['EmpID'];
            $_SESSION["epwd"] = $epwd;
            $_SESSION["emploggedin"] = TRUE;
        }

        $result->free();
        $db->close();

        ?>
    </div>
</body>

</html>