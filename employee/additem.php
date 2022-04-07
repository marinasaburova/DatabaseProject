<?php
$title = "Add Item";
require '../view/empsession.php';
include '../view/empheader.php';
require '../functions/db.php';

// Generate next order id:
$query = "SELECT ItemID FROM ITEM ORDER BY ItemID DESC";
$result = $db->query($query);
$row = $result->fetch_assoc();
$prevID = $row["ItemID"];
$nextID = $prevID + 1;

$result->free();
$db->close();

?>

<div class="wrapper">
  <h1>Add Item</h1>

  <div class="center-box">
    <!-- Form to add a new product -->

    <form action="additemresult.php" method="post">
      <label for="itemid"><b>Item ID</b></label>
      <input type="text" value="<?php echo $nextID; ?>" name="itemid" maxlength="10" readonly />

      <label for="itemname"><b>Item Name</b></label>
      <input type="text" placeholder="Enter Item Name" name="itemname" maxlength="40" required />

      <label for="category"><b>Category</b></label>
      <!--dropdown -->
      <select name="category">
        <option value="earring">Earring</option>
        <option value="necklace">Necklace</option>
        <option value="bracelet">Bracelet</option>
        <option value="ring">Ring</option>
        <option value="hair">Hair Accessory</option>
      </select>

      <label for="crystal"><b>Crystal</b></label>
      <input type="text" placeholder="Enter Item Crystal" name="crystal" maxlength="20" required />

      <label for="metal"><b>Metal Type</b></label>
      <!--dropdown -->
      <select name="metal">
        <option value="silver">Silver</option>
        <option value="gold">Gold</option>
        <option value="rose gold">Rose Gold</option>
      </select>

      <label for="price"><b>Price</b></label>
      <input type="text" placeholder="Enter Item Price" name="price" maxlength="5" required />

      <label for="quantity"><b>Quantity</b></label>
      <input type="number" placeholder="Enter Item Quantity" name="quantity" min="0" ; maxlength="3" required />

      <label for="desc"><b>Description</b></label>
      <input type="text" placeholder="Describe the product..." name="desc" required />

      <button type="submit" name="additem">Add Item</button>
    </form>
  </div>
</div>
</body>

</html>