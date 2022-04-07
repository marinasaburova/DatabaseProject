<?php
$title = "Register an Employee";
require '../view/empsession.php';
include '../view/empheader.php';
require '../functions/db.php';

// get variables
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$pwd = $_POST['pwd'];
$pwd2 = $_POST['pwd2'];
$id = $_POST['id'];
?>

<h1 style="padding-top: 40px">Registration Results:</h1>

<div id="log-in">

    <?php

    // prevents injection attack
    $fname = addslashes($fname);
    $lname = addslashes($lname);
    $email = addslashes($email);
    $pwd = addslashes($pwd);
    $pwd2 = addslashes($pwd2);
    $id = addslashes($id);

    if ($pwd !== $pwd2) {
        echo '<p>Passwords do not match.</p>';
        echo '<a class = "link" href="empregister.html">Try again.</a>';
        exit;
    }

    // encrypts password
    $epwd = password_hash($pwd, PASSWORD_BCRYPT);

    // inserts new tuple into database
    $query = "INSERT INTO EMPLOYEE (EmpID, EmpEmail, EmpPassword, EmpFName, EmpLName) VALUES ('" . $id . "', '" . $email . "', '" . $epwd . "', '" . $fname . "', '" . $lname . "')";

    $result = $db->query($query);

    if ($result) {
        echo '<p>Account successfully created!</p></br>';
        echo '<a class = "link" href="employeehome.php">Back to Employee Homepage.</a><br>';
        echo '<a class = "link" href="../functions/logout.php">Login to new account.</a><br>';
    } else {
        echo '<p>Error. Your account could not be created.</p></br>';
        echo '<a class = "link" href="empregister.html">Try again.</a>';
    }

    $result->free();
    $db->close();

    ?>
</div>
</body>

</html>