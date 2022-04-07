<?php
$title = "Edit Account Details";
require '../view/empsession.php';
include '../view/empheader.php';
require '../functions/db.php';
// get variables
$emp = $_SESSION['empID'];

$pwd = $_POST['pwd'];
$newemail = $_POST['email'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];

$newpwd1 = $_POST['newpwd1'];
$newpwd2 = $_POST['newpwd2'];
?>

<div class="wrapper">
  <h1>Employee Update Results</h1>

  <div class="center-box">

    <?php
    // prevents injection attack
    $pwd = addslashes($pwd);
    $newemail = addslashes($newemail);
    $fname = addslashes($fname);
    $lname = addslashes($lname);
    $newpwd1 = addslashes($newpwd1);
    $newpwd2 = addslashes($newpwd2);


    // finds matching credentials
    $query = "SELECT * FROM EMPLOYEE WHERE EmpID = '" . $emp . "'";
    $result = $db->query($query);
    $row = $result->fetch_assoc();
    $epwd = $row['EmpPassword'];

    if ((mysqli_num_rows($result) == 0) || !(password_verify($pwd, $epwd))) {
      echo '<p>Incorrect credentials.</p></br>';
      echo '<a class = "link" href=editaccount.php>Try again.</a></br>';
    } else {
      // update info option
      if (isset($_POST['updateinfo'])) {
        $query = "UPDATE EMPLOYEE SET EmpEmail = '" . $newemail . "', EmpFName = '" . $fname . "', EmpLName = '" . $lname . "' WHERE EmpID = '" . $emp . "'";
      }

      // change password option
      if (isset($_POST['changepwd'])) {
        if ($newpwd1 !== $newpwd2) {
          echo '<p>Passwords do not match.</p>';
          echo '<a class = "link" href=editaccount.php>Try again.</a>';
          exit;
        }

        $epwd = password_hash($newpwd1, PASSWORD_BCRYPT);
        $query = "UPDATE EMPLOYEE SET EmpPassword = '" . $epwd . "' WHERE EmpID = '" . $emp . "'";
      }

      // remove account option
      if (isset($_POST['removeacct'])) {
        $query = "UPDATE EMPLOYEE SET isActive = '0' WHERE EmpID = '" . $emp . "'";
        $result1 = $db->query($query);
        $query = "UPDATE ORDERS SET Employee = NULL WHERE Employee = '" . $emp . "'";
        $result2 = $db->query($query);

        if ($result1 && $result2) {
          echo '<p>You have successfully left. </p>';
        }
        //$result->free(); 
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
    }

    $result->free();
    $db->close();

    ?>
  </div>
  </body>

  </html>