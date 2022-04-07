<?php
$title = "Edit Account";

require '../functions/db.php';
require '../view/session.php';
include '../view/header.php';

$customer = $_SESSION["email"];
?>

<div class="wrapper">
  <h1>Edit Account Info</h1>

  <div class="center-box">

    <h2>Modify Info</h2>

    <?php
    // find customer info 
    $query = "SELECT * FROM CUSTOMER WHERE CEmail = '" . $customer . "'";
    $result = $db->query($query);
    if (!$result) {
      echo 'Customer could not be found...';
      exit;
    }
    $row = $result->fetch_assoc();
    ?>


    <form action="editaccountresult.php" method="post">
      <label for="fname"><b>First Name</b></label>
      <input type="text" value="<?php echo $row['CFName']; ?>" name="fname" maxlength="15" required />

      <label for="itemname"><b>Last Name</b></label>
      <input type="text" value="<?php echo $row['CLName']; ?>" name="lname" maxlength="15" required />

      <label for="email"><b>Email</b></label>
      <input type="text" value="<?php echo $row['CEmail']; ?>" name="email" maxlength="30" required />

      <label for="pwd"><b>Current Password</b></label>
      <input type="password" placeholder="Confirm password to make changes" name="pwd" maxlength="30" required />
      <button type="submit" name="updateinfo">Update Info</button>
    </form>


    <h2>Change Password</h2>

    <form action="editaccountresult.php" method="post">
      <label for="newpwd1"><b>New Password</b></label>
      <input type="password" placeholder="Enter Password" name="newpwd1" maxlength="30" required />

      <label for="newpwd2"><b>Confirm New Password</b></label>
      <input type="password" placeholder="Confirm Password" name="newpwd2" maxlength="30" required />

      <label for="pwd"><b>Current Password</b></label>
      <input type="password" placeholder="Confirm current password to make changes" name="pwd" maxlength="30" required />

      <button type="submit" name="changepwd">Change Password</button>
    </form>


    <h2>Remove Account</h2>
    <form action="editaccountresult.php" method="post">
      <label for="pwd"><b>Current Password</b></label>
      <input type="password" placeholder="Confirm current password to remove account" name="pwd" maxlength="30" required />
      <button type="submit" name="removeacct">Remove Account</button>
    </form>

  </div>
</div>
</body>

</html>