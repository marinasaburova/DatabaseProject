<?php
$title = "Add Item";
require '../view/empsession.php';
include '../view/empheader.php';
require '../functions/db.php';

// get variables
$itemid = $_POST['itemid'];
$itemname = $_POST['itemname'];
$category = $_POST['category'];
$metal = $_POST['metal'];
$crystal = $_POST['crystal'];
$price = $_POST['price'];
$quantity = $_POST['quantity'];
$desc = $_POST['desc'];

?>

<div class="wrapper">
  <h1>Add Item</h1>

  <div class="center-box">

    <?php
    if ((!is_numeric($price)) || ($price < 0)) {
      echo "<p>Please enter a valid price. The item was not added.</p>";
      echo '<a href="' . $_SERVER['HTTP_REFERER'] . '">go back</a>';

      exit;
    }

    // PREVENTS INJECTION
    $itemid = addslashes($itemid);
    $itemname = addslashes($itemname);
    $desc = addslashes($desc);
    $category = addslashes($category);
    $metal = addslashes($metal);
    $crystal = addslashes($crystal);
    $price = doubleval($price);
    $quantity = intval($quantity);

    // update query 
    $query = "UPDATE ITEM SET ItemID = '" . $itemid . "', Name = '" . $itemname . "', Price = '" . $price . "', JewelryType = '" . $category . "', Crystal = '" . $crystal . "', Metal = '" . $metal . "', QuantityInStock = '" . $quantity . "', Description = '" . $desc . "' WHERE ItemID = '" . $itemid . "'";
    $result = $db->query($query);

    if ($result) {
      echo  "<p>" . $db->affected_rows . " item updated in database.</p>";
    } else {
      echo "<p>An error has occurred. The item was not updated.</p>";
    }

    $result->free();
    $db->close();
    ?>

  </div>
</div>
</body>

</html>