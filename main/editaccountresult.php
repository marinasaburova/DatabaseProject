<?php
$title = "Account Update Result";

require '../view/session.php';
require '../functions/db.php';
include '../view/header.php';

// get variables
$email = $_SESSION['email'];

if (isset($_POST['updateinfo'])) {
    $pwd = $_POST['pwd'];
    $newemail = $_POST['email'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];

    $pwd = addslashes($pwd);
    $newemail = addslashes($newemail);
    $fname = addslashes($fname);
    $lname = addslashes($lname);
}

if (isset($_POST['changepwd'])) {
    $newpwd1 = $_POST['newpwd1'];
    $newpwd2 = $_POST['newpwd2'];
    $pwd = $_POST['pwd'];

    $newpwd1 = addslashes($newpwd1);
    $newpwd2 = addslashes($newpwd2);
    $pwd = addslashes($pwd);
}
?>

<div class="wrapper">
    <h1>Account Update Results</h1>

    <div class="center-box">

        <?php
        // finds matching credentials
        $query = "SELECT * FROM CUSTOMER WHERE CEmail = '" . $email . "'";
        $result = $db->query($query);
        $row = $result->fetch_assoc();
        $epwd = $row['CPassword'];

        if ((mysqli_num_rows($result) == 0) || !(password_verify($pwd, $epwd))) {
            echo '<p>Incorrect credentials.</p></br>';
            echo '<a class = "link" href="' . $_SERVER['HTTP_REFERER'] . '"]>Try again.</a></br>';
        } else {
            // Attempt to update database

            if (isset($_POST['updateinfo'])) {
                $query = "UPDATE CUSTOMER SET CEmail = '" . $newemail . "', CFName = '" . $fname . "', CLName = '" . $lname . "' WHERE CEmail = '" . $email . "'";
            }

            if (isset($_POST['changepwd'])) {
                if ($newpwd1 !== $newpwd2) {
                    echo '<p>Passwords do not match.</p>';
                    echo '<a class = "link" href="' . $_SERVER['HTTP_REFERER'] . '">Try again.</a>';
                    exit;
                }

                $epwd = password_hash($newpwd1, PASSWORD_BCRYPT);
                $query = "UPDATE CUSTOMER SET CPassword = '" . $epwd . "' WHERE CEmail = '" . $email . "'";
            }

            if (isset($_POST['removeacct'])) {
                $query = "UPDATE CUSTOMER SET isActive = '0' WHERE CEmail = '" . $email . "'";
                $result = $db->query($query);

                if ($result) {
                    echo '<p>You have successfully removed your account. </p>';
                }

                $db->close();
                session_destroy();
                header('Location: ../index.html');
                exit;
            }

            $result = $db->query($query);

            if ($result) {
                echo  "<p>Account successfully updated.</p>";
            } else {
                echo "<p>An error has occurred. The item was not updated.</p>";
            }

            $_SESSION['email'] = $email;
            $_SESSION['cfname'] = $fname;
        }

        $db->close();

        ?>
    </div>
    </body>

    </html>