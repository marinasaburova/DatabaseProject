<?php
$title = "Order Details";

require '../view/session.php';
require '../functions/db.php';
include '../view/header.php';

$customer = $_SESSION["email"];
$orderID = $_GET["orderID"];
?>

<div class="wrapper">
    <h1>Order Details</h1>

    <div class="center-box">

        <h2>Order</h2>

        <?php
        // get order information
        $query = "SELECT * FROM ORDERS NATURAL JOIN ORDER_ITEMS WHERE OrderID = '" . $orderID . "'";
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

        echo '<p><b>Date:</b> ' . $order['OrderTimeStamp'] . '</br>';
        echo '<b>Order ID:</b> ' . $order['OrderID'] . '</br>';
        echo '<b>Order Status:</b> ' . $order['OrderStatus'] . '</br>';
        echo '<b>Items Purchased:</b> ' . $count . '</br>';
        echo '<b>Order Total:</b> $' . $cost . '</p></br>';


        echo '<p>
            <b>Shipping To: </b><br>'
            . $order['ShipFName'] . ' ' . $order['ShipLName'] . '<br>'
            . $order['ShipAddrStreet'] . '<br>'
            . $order['ShipAddrCity'] . ', ' . $order['ShipAddrState'] . ' ' . $order['ShipAddrZip'] . '
            </p>';

        ?>

        </br>
        <h2>Items</h2>
        </br>

        <?php
        // JOIN to find all items + descriptions from order
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

        $result->free();
        $itemresult->free();
        $db->close();
        ?>

    </div>
</div>
</body>

</html>