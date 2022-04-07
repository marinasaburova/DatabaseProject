<?php
$title = "Register an Employee";
require '../view/empsession.php';
include '../view/empheader.php';
require '../functions/db.php';

$idquery = "SELECT EmpID FROM EMPLOYEE ORDER BY EmpID DESC";
$result = $db->query($idquery);
$row = $result->fetch_assoc();
$prevID = $row["EmpID"];
$newID = $prevID + 1;
?>


<h1 style="padding-top: 40px">Register an Employee:</h1>

<!-- LOGIN BOX -->
<div id="log-in">
  <form action="empregisterresults.php" method="post">
    <label for="fname"><b>First Name</b></label>
    <input type="text" placeholder="Enter First Name" name="fname" maxlength="15" required />

    <label for="lname"><b>Last Name</b></label>
    <input type="text" placeholder="Enter Last Name" name="lname" maxlength="15" required />

    <label for="id"><b>Employee ID</b></label>
    <input type="text" value="<?php echo $newID; ?>" name="id" readonly />

    <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="email" maxlength="30" required />

    <label for="pwd"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="pwd" maxlength="60" required />

    <label for="pwd2"><b>Confirm Password</b></label>
    <input type="password" placeholder="Confirm Password" name="pwd2" maxlength="60" required />

    <button type="submit" name="register">Register</button>
  </form>
</div>

<div class="bottom-links">
  <?php
  echo '<a href="' . $_SERVER['HTTP_REFERER'] . '">go back</a>';
  ?>
</div>
</body>

</html>