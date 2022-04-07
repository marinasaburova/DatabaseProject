<?php
$title = "Product Details";

require '../view/session.php';
require '../functions/db.php';
include '../view/header.php';

// get variables
$itemid = $_GET['itemID'];
$cart = $_SESSION['cart'];

?>

<div class="wrapper">
    <h1>Product Details</h1>
    <div class="center-box">

        <?php
        // get item info from database
        $query = "SELECT * FROM ITEM WHERE ItemID = '" . $itemid . "'";
        $result = $db->query($query);
        $num_results = $result->num_rows;
        $product = $result->fetch_assoc();

        if ($num_results > 1) {
            echo "More than 1 item with ID. Error.";
        }

        // display item info
        echo '<br><p><b>Item:</b> ' . $product['Name'] . '</br>';
        echo '<b>Category:</b> ' . $product['JewelryType'] . '</br>';
        echo '<b>Metal:</b> ' . $product['Metal'] . '</br>';
        echo '<b>Crystal:</b> ' . $product['Crystal'] . '</br>';
        echo '<b>Price:</b> $' . $product['Price'] . '<br><br>';
        echo '<b>Description:</b> ' . $product['Description'] . '</p><br><br>';

        // keep track of items in cart to avoid adding more than allowed
        if (!empty($cart)) {
            $items = explode(",", $cart);
            $temp = array_count_values($items);
            if (in_array($itemid, $temp)) {
                $count = $product['QuantityInStock'] - $temp[$itemid];
            } else {
                $count = $product['QuantityInStock'];
            }
        } else {
            $count = $product['QuantityInStock'];
        }

        ?>
        <div class="add-quantity">
            <form action="../functions/addtocart.php" method="post">
                <input type="hidden" name="itemID" value="' <?php echo $itemid ?> '">
                <label for="quantity">Quantity: </label>
                <input type="number" id="quantity" name="quantity" min="1" max="'<?php echo $count ?>'" value="1">
                <input type="hidden" name="itemID" value="<?php echo $itemid ?>">
                <button type="submit" name="addcart">Add to Cart</button>
            </form>
        </div>
        <?php

        $result->free();
        $db->close();

        echo '<br>';
        echo '<a href="' . $_SERVER['HTTP_REFERER'] . '">back to shopping</a>';
        ?>
        <br><br><br>
    </div>

</div>
</body>

</html>