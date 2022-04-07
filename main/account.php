<?php
$title = "Account";

require '../view/session.php';
require '../functions/db.php';
include '../view/header.php';

$customer = $_SESSION["email"];
$cfname = $_SESSION["cfname"];

?>

<div class="wrapper">
    <h1>Your Account</h1>

    <div class="center-box">

        <?php
        echo '<h2>Welcome, ' . $cfname . '</h2>'; ?>

        <form action="../login/logout.php" method="post">
            <button type="submit" name="logout">log out</button>
        </form>

        <h2>Account Information</h2>

        <?php
        // get customer info from database
        $query = "SELECT * FROM CUSTOMER WHERE CEmail = '" . $customer . "'";
        $result = $db->query($query);
        $num_results = $result->num_rows;
        $row = $result->fetch_assoc();

        echo '<p>Name: ' . $row["CFName"] . ' ' . $row["CLName"] . '</br>';
        echo 'Email: ' . $customer, '</p></br>';
        ?>

        <form action="editaccount.php" method="post">
            <button type="submit" name="editaccount">edit account info</button>
        </form>

        <h2>Order History</h2>

        <?php
        // get order info from database
        $query = "SELECT * FROM ORDERS WHERE Customer = '" . $customer . "' ORDER BY OrderTimeStamp DESC";
        $result = $db->query($query);
        $num_results = $result->num_rows;

        if ($num_results == 0) {
            echo '<p>You have no orders.</p><br>';
        }

        for ($i = 0; $i < $num_results; $i++) {
            $row = $result->fetch_assoc();
            echo '<div class="grid-item">';
            echo '<p>Order ID: ' . $row['OrderID'] . '</br>';
            echo 'Order Status: ' . $row['OrderStatus'] . '</br>';
            echo 'Date: ' . $row['OrderTimeStamp'] . '</br></p>';

            echo '<form action="orderdetails.php" method="get">';
            echo '<input type="hidden" name="orderID" value="' . $row['OrderID'] . '"/>';
            echo '<button type="submit" name="orderdetails">view details</button>';
            echo '</form>';

            echo '</div>';
        }

        $result->free();
        $db->close();
        ?>

    </div>
</div>
</body>

</html>