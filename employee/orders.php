<?php
$title = "All Orders";
require '../view/empsession.php';
include '../view/empheader.php';
require '../functions/db.php';

if (isset($_GET['status'])) {
    $status = $_GET['status'];
}

?>

<div class="wrapper">
    <h1>All Orders</h1>
    <div class="center-box-wide">
        <div class="centered-stuff">
            <div class="filter center">
                <form action="orders.php" method="get">
                    <label for="status">Status</label>
                    <select name="status">
                        <option value="all">all</option>
                        <option value="processing">processing</option>
                        <option value="shipped">shipped</option>
                        <option value="delivered">delivered</option>
                        <option value="refunded">refunded</option>
                        <option value="issue">issue with order</option>
                    </select>
                    <button type="submit" name="filter" style="margin: 10px">Filter</button>
                </form>
            </div>
        </div>

        <?php
        $query = "SELECT * FROM ORDERS";

        // filter orders if specified
        if (isset($_GET['filter']) && $status != "all") {
            $query .= " WHERE OrderStatus = '" . $status . "'";
        }

        $query .= " ORDER BY OrderTimeStamp DESC";

        $result = $db->query($query);
        $num_results = $result->num_rows;

        echo '<table class="all-items">';
        echo '<caption>Orders<caption> ';
        echo '<tr>';
        echo '<th>Order ID:</th>';
        echo '<th>Timestamp:</th>';
        echo '<th>Status:</th>';
        echo '<th>Customer:</th>';
        echo '<th>Employee:</th>';
        echo '<th>Details/Manage:</th>';
        echo '</tr>';

        // display orders 
        for ($j = 0; $j < $num_results; $j++) {
            $row = $result->fetch_assoc();
            echo '<tr>';
            echo '<td>' . $row['OrderID'] . '</td>';
            echo '<td>' . $row['OrderTimeStamp'] . '</td>';
            echo '<td>' . $row['OrderStatus'] . '</td>';
            echo '<td>' . $row['Customer'] . '</td>';
            echo '<td>' . $row['Employee'] . '</td>';
            echo '<td>';
            echo '<form action="editorder.php" method="post">';
            echo '<input type="hidden" name="orderID" value="' . $row['OrderID'] . '"/>';
            echo '<button type="submit" name="editorder">manage</button>';
            echo '</form>';
            echo '</td>';
            echo '</tr>';

            $button = 'button' . $j;
        }

        echo '</table>';

        $result->free();
        $db->close();

        ?>
    </div>
</div>
</body>

</html>