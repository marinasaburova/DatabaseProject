<?php
$title = "Inventory";
require '../view/empsession.php';
include '../view/empheader.php';
require '../functions/db.php';

?>

<div class="wrapper">
    <h1>Current Inventory</h1>
    <div class="center-box-wide">
        <div class="centered-stuff">

            <!-- Counts total unique items in inventory-->
            <?php
            $query = "SELECT COUNT(*) FROM ITEM";
            $result = $db->query($query);
            $row = $result->fetch_assoc();
            $count = $row['COUNT(*)'];

            echo '<br><p>Number of Products: ' . $count . '</p><br>'
            ?>

            <!-- Add item buttom -->
            <form action="additem.php" method="post">
                <button type="submit" name="additem">add new products</button>
            </form>

            <!-- Filter selection button -->
            <div class="filter center">
                <form action="inventory.php" method="get">
                    <label for="sortby">Sort by...</label>
                    <select name="sortby">
                        <option value="category">Category</option>
                        <option value="Metal">Metal</option>
                        <option value="Crystal">Crystal</option>
                        <option value="ItemID">Item ID</option>
                        <option value="QuantityInStock">Quantity</option>
                    </select>
                    <button type="submit" name="sort" style="margin: 10px">Sort</button>
                </form>
            </div>
        </div>


        <?php

        // default items: arranged by category
        if (!isset($_GET['sort']) || ($_GET['sortby'] == "category")) {

            $category = array("earring", "necklace", "bracelet", "ring", "hair");

            echo '<h2>Sorted by Category</h2><br><br>';

            for ($i = 0; $i < count($category); $i++) {
                $query = "SELECT * FROM ITEM WHERE JewelryType ='" . $category[$i] . "'";
                $result = $db->query($query);
                $num_results = $result->num_rows;

                echo '<table class="all-items">';
                echo '<caption>' . $category[$i] . '<caption> ';
                echo '<tr>';
                echo '<th>Item:</th>';
                echo '<th>ID:</th>';
                echo '<th>Crystal:</th>';
                echo '<th>Metal:</th>';
                echo '<th>Price:</th>';
                echo '<th>Quantity:</th>';
                echo '<th>Date Added:</th>';
                echo '<th>Description:</th>';
                echo '<th>Edit:</th>';
                echo '</tr>';

                for ($j = 0; $j < $num_results; $j++) {
                    $row = $result->fetch_assoc();
                    echo '<tr>';
                    echo '<td>' . $row['Name'] . '</td>';
                    echo '<td>' . $row['ItemID'] . '</td>';
                    echo '<td>' . $row['Crystal'] . '</td>';
                    echo '<td>' . $row['Metal'] . '</td>';
                    echo '<td>' . $row['Price'] . '</td>';
                    echo '<td>' . $row['QuantityInStock'] . '</td>';
                    echo '<td>' . $row['DateAdded'] . '</td>';
                    echo '<td>' . $row['Description'] . '</td>';

                    echo '<td>';
                    echo '<form action="edititem.php" method="post">';
                    echo '<input type="hidden" name="itemID" value="' . $row['ItemID'] . '"/>';
                    echo '<button type="submit" name="edititem">edit</button>';
                    echo '</form>';
                    echo '</td>';

                    echo '</tr>';
                }
                echo '</table>';
            }
        } else {
            // show items sorted
            $query = "SELECT * FROM ITEM ORDER BY `ITEM`.`" . $_GET['sortby'] . "` ASC";
            $result = $db->query($query);
            $num_results = $result->num_rows;

            echo '<table class="all-items">';
            echo '<caption> Sorted By ' . $_GET['sortby'] . '<caption> ';
            echo '<tr>';
            echo '<th>Item:</th>';
            echo '<th>ID:</th>';
            echo '<th>Crystal:</th>';
            echo '<th>Metal:</th>';
            echo '<th>Price:</th>';
            echo '<th>Quantity:</th>';
            echo '<th>Date Added:</th>';
            echo '<th>Description:</th>';
            echo '<th>Edit:</th>';
            echo '</tr>';

            for ($j = 0; $j < $num_results; $j++) {
                $row = $result->fetch_assoc();
                echo '<tr>';
                echo '<td>' . $row['Name'] . '</td>';
                echo '<td>' . $row['ItemID'] . '</td>';
                echo '<td>' . $row['Crystal'] . '</td>';
                echo '<td>' . $row['Metal'] . '</td>';
                echo '<td>' . $row['Price'] . '</td>';
                echo '<td>' . $row['QuantityInStock'] . '</td>';
                echo '<td>' . $row['DateAdded'] . '</td>';
                echo '<td>' . $row['Description'] . '</td>';

                echo '<td>';
                echo '<form action="edititem.php" method="post">';
                echo '<input type="hidden" name="itemID" value="' . $row['ItemID'] . '"/>';
                echo '<button type="submit" name="edititem">edit</button>';
                echo '</form>';
                echo '</td>';

                echo '</tr>';
            }
            echo '</table>';
        }

        $result->free();
        $db->close();

        ?>
    </div>
</div>
</body>

</html>