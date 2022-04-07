<?php
$title = "Checkout";

require '../view/session.php';
require '../functions/db.php';
include '../view/header.php';

$customer = $_SESSION['email'];
$cart = $_SESSION['cart'];
?>

<div class="wrapper">
    <h1>Checkout</h1>
    <div class="center-box">

        <?php

        $items = explode(',', $cart);
        if (count($items) < 1) {
            echo "<p>You have no items in your cart!</p>";
            exit;
        }
        ?>

        <table class="cart">
            <caption>cart summary<caption>

                <tr>
                    <th>Item:</th>
                    <th>Crystal:</th>
                    <th>Metal:</th>
                    <th>Quantity:</th>
                    <th>Price:</th>
                </tr>

                <?php

                $quantity = array_count_values($items);
                $totalcost = 0;

                foreach ($quantity as $item => $count) {

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
                    echo '</tr>';

                    $totalcost += ($row['Price'] * $count);
                }
                ?>
        </table>
        <br><br>
        <p><b>Total Cost: </b> $<?php echo $totalcost ?></br>
            <b>Total Items: </b><?php echo count($items) ?></br>
            <b>Unique Items: </b><?php echo count($quantity) ?></br>
        </p>

        <?php
        echo '<br><a href="cart.php">edit cart</a><br><br>';

        $result->free();
        $db->close();
        ?>


        <h2>Shipping Info</h2><br>
        <form action=place.php method="post">
            <label for="shipfname"><b>First Name</b></label>
            <input type="text" placeholder="Enter First Name" name="shipfname" maxlength="15" required />

            <label for="shiplname"><b>Last Name</b></label>
            <input type="text" placeholder="Enter Last Name" name="shiplname" maxlength="15" required />

            <label for="street"><b>Street Address</b></label>
            <input type="text" placeholder="Enter Street Address" name="street" maxlength="20" required />

            <label for="city"><b>City</b></label>
            <input type="text" placeholder="Enter City" name="city" maxlength="20" required />

            <label for="state"><b>State</b></label>
            <input type="text" placeholder="Enter State" name="state" minlength="2" maxlength="2" required />

            <label for="zip"><b>Zip Code</b></label>
            <input type="text" placeholder="Zip Code" name="zip" maxlength="5" maxlength="5" required />

            <button type="submit" name="order">Place Order</button>

        </form>
    </div>
</div>
</body>

</html>