<?php
$title = "Employee Account";
require '../view/empsession.php';
include '../view/empheader.php';
require '../functions/db.php';

$emp = $_SESSION['empID'];

?>

<div class="wrapper">
  <h1>Employee Account</h1>
  <div class="center-box-wide">
    <?php
    $query = "SELECT * FROM EMPLOYEE WHERE EmpID = '" . $emp . "'";
    $result = $db->query($query);
    $num_results = $result->num_rows;
    $row = $result->fetch_assoc();

    echo '<h2>Welcome, ' . $row['EmpFName'] . ' ' . $row['EmpLName'] . '</h2>';
    ?>
    <form action="../functions/logout.php" method="post">
      <button type="submit" name="logout">log out</button>
    </form>
    <h2>Account Information</h2>
    <?php
    // display account info 
    echo '<p>ID: ' . $row["EmpID"], '</br>';
    echo '<p>Email: ' . $row["EmpEmail"], '</br>';
    echo 'Name: ' . $row["EmpFName"] . ' ' . $row["EmpLName"] . '</p></br>';
    ?>

    <form action="editaccount.php" method="post">
      <button type="submit" name="editaccount">edit account info</button>
    </form>

    <br><br><br><br>
    <a href="empregister.php">register a new employee</a>

    <?php
    $result->free();
    $db->close();
    ?>

  </div>
</div>
</body>

</html>