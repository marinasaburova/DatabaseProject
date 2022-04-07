<?php
$title = "Edit Item";
require '../view/empsession.php';
include '../view/empheader.php';
require '../functions/db.php';

$item = $_POST['itemID'];
?>

<div class="wrapper">
  <h1>Edit Item</h1>


  <div class="center-box">
    <?php

    // get item info to autofill form
    $query = "SELECT * FROM ITEM WHERE ItemID = '" . $item . "'";
    $result = $db->query($query);
    if (!$result) {
      echo 'Item could not be found...';
    }
    $row = $result->fetch_assoc();
    ?>

    <form action="edititemresult.php" method="post">

      <label for="itemid"><b>Item ID</b></label>
      <input type="text" value="<?php echo $row['ItemID']; ?>" name="itemid" maxlength="10" readonly />

      <label for="itemname"><b>Item Name</b></label>
      <input type="text" value="<?php echo $row['Name']; ?>" name="itemname" maxlength="40" required />

      <label for="category"><b>Category</b></label>
      <select name="category">
        <option value="earring">Earring</option>
        <option value="necklace">Necklace</option>
        <option value="bracelet">Bracelet</option>
        <option value="ring">Ring</option>
        <option value="hair">Hair Accessory</option>
      </select>

      <label for="crystal"><b>Crystal</b></label>
      <input type="text" value="<?php echo $row['Crystal']; ?>" name="crystal" maxlength="20" required />

      <label for="metal"><b>Metal Type</b></label>
      <!--dropdown -->
      <select name="metal">
        <option value="silver">Silver</option>
        <option value="gold">Gold</option>
        <option value="rose gold">Rose Gold</option>
      </select>

      <label for="price"><b>Price</b></label>
      <input type="text" value="<?php echo $row['Price']; ?>" name="price" maxlength="5" required />

      <label for="quantity"><b>Quantity</b></label>
      <input type="text" value="<?php echo $row['QuantityInStock']; ?>" name="quantity" min="0" maxlength="3" required />

      <label for="desc"><b>Description</b></label>
      <input type="text" value="<?php echo $row['Description']; ?>" name="desc" required />

      <!--Time Stamp: Auto -->

      <button type="submit" name="update">Update</button>
    </form>


    <p>Note: There is no way to delete items.</br></p>
    <p>If you want an item to no longer show up, set the quantity to 0.</p>

  </div>
</div>
</body>

</html>