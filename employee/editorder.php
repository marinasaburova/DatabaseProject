<?php
$title = "Manage Order";
require '../view/empsession.php';
include '../view/empheader.php';
require '../functions/db.php';

$orderID = $_POST['orderID'];
$empID = $_SESSION['empID'];
?>

<div class="wrapper">
  <h1>Manage Order</h1>


  <div class="center-box">

    <h2>Order</h2>

    <?php

    // get order information
    $query = "SELECT * FROM ORDERS NATURAL JOIN ORDER_ITEMS WHERE OrderID = '$orderID'";
    $result = $db->query($query);
    $num_results = $result->num_rows;

    // calculate total price & quantity
    $cost = 0;
    $count = 0;
    for ($j = 0; $j < $num_results; $j++) {
      $order = $result->fetch_assoc();
      $cost += $order['OrderPrice'] * $order['Quantity'];
      $count += $order['Quantity'];
    }

    // Display Info
    echo '<p><b>Date:</b> ' . $order['OrderTimeStamp'] . '<br>';
    echo '<b>Order ID:</b> ' . $order['OrderID'] . '<br>';
    echo '<b>Order Status:</b> ' . $order['OrderStatus'] . '<br>';
    echo '<b>Items Purchased:</b> ' . $count . '<br>';
    echo '<b>Order Total:</b> $' . $cost . '<br>';
    echo '<b>Customer:</b> ' . $order['Customer'] . '<br>';
    echo '<b>Employee:</b> ' . $order['Employee'];
    if ($order['Employee'] == $empID) {
      echo ' <i>(you)</i>';
    }
    echo '</p></br>';

    echo '<p>
        <b>Shipping Address: </b><br>'
      . $order['ShipFName'] . ' ' . $order['ShipLName'] . '<br>'
      . $order['ShipAddrStreet'] . '<br>'
      . $order['ShipAddrCity'] . ', ' . $order['ShipAddrState'] . ' ' . $order['ShipAddrZip'] . '
        </p>';

    // Check if employee has permission to edit the order
    if ($order['Employee'] == $empID) {

    ?>
      <div class="filter center">
        <form action="editorder.php" method="post">
          <label for="status"><b>Order Status</b></label>
          <select name="status">
            <option value="processing">Processing</option>
            <option value="shipped">Shipped</option>
            <option value="delivered">Delivered</option>
            <option value="returned">Processing Return</option>
            <option value="refunded">Refunded</option>
            <option value="issue">Issue with Order</option>
          </select>
          <input type="hidden" name="orderID" value="<?php echo $orderID ?>" />
          <button type="submit" name="updatestatus">Set Status</button>
        </form>
      </div>
    <?php
    } else {
      echo '<form action="editorder.php" method="post">';
      echo '<input type="hidden" name="orderID" value="' . $orderID . '"/>';
      echo '<button type="submit" name="claim">claim order</button>';
      echo '</form>';
    }

    if (isset($_POST["claim"])) {
      $update = "UPDATE ORDERS SET Employee = '" . $empID . "' WHERE OrderID = '" . $_POST['orderID'] . "'";
      $result = $db->query($update);
      if (!$result) {
        echo '<p>Error updating employee. </p><br>';
      } else {
        echo '<p>You are now in charge of this order!
                <br>
                <i>refresh page to view update</i>
                </p><br>';
      }
    }

    if (isset($_POST["updatestatus"])) {

      $update = "UPDATE ORDERS SET OrderStatus = '" . $_POST['status'] . "' WHERE OrderID = '" . $_POST['orderID'] . "'";
      $result = $db->query($update);
      if (!$result) {
        echo '<p>Error updating status. </p></br>';
      } else {
        echo '<p>Order status successfully updated! 
                <br>
                <i>refresh page to view update</i>
                </p><br>';
      }
    }
    ?>

    </br>
    <h2>Items</h2>
    </br>

    <?php
    // list items from order
    $query = "SELECT ITEM.*, ORDERS.OrderID, ORDER_ITEMS.Quantity, ORDER_ITEMS.OrderPrice FROM ITEM JOIN ORDER_ITEMS ON ITEM.ItemID = ORDER_ITEMS.ItemID JOIN ORDERS ON ORDERS.OrderID = ORDER_ITEMS.OrderID WHERE ORDERS.OrderID = '" . $orderID . "'";
    $itemresult = $db->query($query);
    $num_items = $itemresult->num_rows;

    // Display items
    for ($i = 1; $i <= $num_items; $i++) {
      $item = $itemresult->fetch_assoc();
      echo '<p>' . $i . '</br>';
      echo '<b>Item Name:</b> ' . $item["Name"] . '</br>';
      echo '<b>JewelryType:</b> ' . $item["JewelryType"] . '</br>';
      echo '<b>Crystal:</b> ' . $item["Crystal"] . '</br>';
      echo '<b>Metal:</b> ' . $item["Metal"] . '</br>';
      echo '<b>Quantity Ordered:</b> ' . $item["Quantity"] . '</br>';
      echo '<b>Price:</b> $' . $item["OrderPrice"] * $item['Quantity'] . ' <i>(' . $item['Quantity'] . ' @ $' . $item["OrderPrice"] . ')</i></p></br>';
      echo '<br><br>';
    }

    $db->close();

    ?>

  </div>
</div>
</body>

</html>