<?php
$title = "Cart";

require '../functions/db.php';
require '../view/session.php';
include '../view/header.php';
$cart = $_SESSION['cart'];
?>

<div class="wrapper">
    <h1>Your Cart</h1>
    <div class="center-box">
        <?php

        // Explode cart with , symbol
        $items = explode(',', $cart);
        if ((count($items) == 0) || $items[0] == '') {
            echo "<p>You have no items in your cart!</p>";
            exit;
        } ?>

        <table class="cart">
            <caption>Your Items<caption>
                <tr>
                    <th>Item:</th>
                    <th>Crystal:</th>
                    <th>Metal:</th>
                    <th>Quantity:</th>
                    <th>Price:</th>
                    <th>Remove:</th>
                </tr>

                <?php
                $quantity = array_count_values($items);
                $totalcost = 0;

                // display in table
                foreach ($quantity as $item => $count) {

                    // query to get item info 
                    $query = "SELECT * FROM ITEM WHERE ItemID = '" . $item . "'";

                    $result = $db->query($query);

                    $num_results = $result->num_rows;
                    if ($num_results == 0) {
                        exit;
                    }

                    $row = $result->fetch_assoc();
                    echo '<tr>';
                    echo '<td>' . $row['Name'] . '</td>';
                    echo '<td>' . $row['Crystal'] . '</td>';
                    echo '<td>' . $row['Metal'] . '</td>';
                    echo '<td>' . $count . '</td>';
                    echo '<td>$' . $row['Price'] * $count . ' <br><i>(' . $count . ' @ $' . $row['Price'] . ')</i></td>';

                    echo '<td>';
                    echo '<form action="../functions/remove.php" method="post">';
                    echo '<input type="hidden" name="itemID" value="' . $row['ItemID'] . '"/>';
                    echo '<button type="submit" name="remove">X</button>';
                    echo '</form>';
                    echo '</td>';

                    echo '</tr>';

                    $totalcost += ($row['Price'] * $count);
                }
                echo '</table>';

                // clear cart button
                echo '<form action=clearcart.php method="post">';
                echo '<button type="submit" name="clear">Clear Cart</button>';
                echo '</form>';

                // information about cart
                echo '<br><p><b>Total Cost:</b> $' . $totalcost . '</br>';
                echo '<b>Total Items:</b> ' . count($items) . '</br>';
                echo '<b>Unique Items:</b> ' . count($quantity) . '</br></p>';

                // send to shipping/payment info page
                echo '<form action="checkout.php">';
                echo '<button type="submit" name="checkout">Proceed to Checkout</button>';
                echo '</form>';

                $result->free();
                $db->close();
                ?>

    </div>
</div>
</body>

</html>