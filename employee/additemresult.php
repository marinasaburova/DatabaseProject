<?php
$title = "Add Item";
require '../view/empsession.php';
include '../view/empheader.php';
require '../functions/db.php';

// get variables
$itemid = $_POST['itemid'];
$itemname = ucwords(strtolower(trim($_POST['itemname'])));
$category = $_POST['category'];
$metal = $_POST['metal'];
$crystal = strtolower(trim($_POST['crystal']));
$price = trim($_POST['price']);
$quantity = trim($_POST['quantity']);
$time = time();
$desc = trim($_POST['desc']);
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
    $itemname = addslashes($itemname);
    $desc = addslashes($desc);
    $category = addslashes($category);
    $metal = addslashes($metal);
    $crystal = addslashes($crystal);
    $price = doubleval($price);
    $quantity = intval($quantity);

    $query = "INSERT INTO ITEM values ('" . $itemid . "', '" . $itemname . "', '" . $price . "', '" . $category . "', '" . $crystal . "', '" . $metal . "', '" . $quantity . "', '" . $desc . "', CURRENT_TIMESTAMP)";

    $result = $db->query($query);

    if ($result) {
      echo  "<p>" . $db->affected_rows . " item inserted into database.</p>";
      echo '<a href="additem.php">add more</a>';
      echo '<a href="inventory.php">view inventory</a>';
    } else {
      echo "<p>An error has occurred. The item was not added.</p>";
      echo '<a href="' . $_SERVER['HTTP_REFERER'] . '">go back</a>';
    }

    // $result->free();
    $db->close();
    ?>


  </div>
</div>
</body>

</html>