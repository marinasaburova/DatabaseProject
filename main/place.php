<?php
$title = "Order Summary";

require '../view/session.php';
require '../functions/db.php';
include '../view/header.php';

// get variables & trim
$customer = $_SESSION['email'];
$cart = $_SESSION['cart'];
$shipfname = trim($_POST['shipfname']);
$shiplname = trim($_POST['shiplname']);
$street = trim($_POST['street']);
$city = trim($_POST['city']);
$state = trim($_POST['state']);
$zip = trim($_POST['zip']);
?>

<div class="wrapper">
    <h1>Order Results</h1>
    <div class="center-box">
        <?php
        // PREVENTS INJECTION
        $shipfname = addslashes($shipfname);
        $shiplname = addslashes($shiplname);
        $street = addslashes($street);
        $city = addslashes($city);
        $state = addslashes($state);
        $zip = addslashes($zip);

        // Generate next order id:
        $idquery = "SELECT OrderID FROM ORDERS ORDER BY OrderID DESC";
        $result = $db->query($idquery);
        $row = $result->fetch_assoc();
        $prevID = $row["OrderID"];
        $orderID = $prevID + 1;


        // CHECK ITEMS & UPDATE
        $items = explode(',', $cart);
        $quantity = array_count_values($items);


        // Check all items for being in-stock 
        foreach ($quantity as $item => $count) {
            $inventory = "SELECT QuantityInStock FROM ITEM WHERE ItemID = '" . $item . "'";
            $result = $db->query($inventory);
            $row = $result->fetch_assoc();
            if ($row['QuantityInStock'] < $count) {
                echo 'We do not have enough items in stock!';
                exit;
            }
        }

        // Create add order items to order 
        foreach ($quantity as $item => $count) {
            $query = "SELECT Price FROM ITEM WHERE ItemID = '" . $item . "'";
            $result = $db->query($query);
            $row = $result->fetch_assoc();
            $price = $row['Price'];

            $query2 = "INSERT INTO ORDER_ITEMS VALUES ('" . $orderID . "', '" . $item . "', '" . $count . "', '" . $price . "')";
            $result2 = $db->query($query2);

            if (!$result2) {
                echo "Error! Item " . $item . " could not be added to order.";
                exit;
            }

            // Updates inventory for each item ordered
            $update = "UPDATE ITEM SET QuantityInStock = QuantityInStock-" . $count . " WHERE ItemID = '" . $item . "'";
            $result3 = $db->query($update);
            if (!$result3) {
                echo "Error updating stock";
                exit;
            }
        }

        // Create new order
        $query = "INSERT INTO ORDERS VALUES ('" . $orderID . "', 'processing', CURRENT_TIMESTAMP, '" . $shipfname . "', '" . $shiplname . "', '" . $street . "', '" . $city . "', '" . $state . "', '" . $zip . "', '" . $customer . "', NULL)";
        $result = $db->query($query);

        if (!$result) {
            echo "<p>Error! Your order could not be placed.</p>";
            exit;
        }

        // clear cart     
        $_SESSION["cart"] = '';
        echo "</br><p>Order Placed!</p>";

        $db->close();
        ?>

    </div>
</div>
</body>

</html>