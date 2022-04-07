<?php
$title = "Products";

require '../view/session.php';
require '../functions/db.php';
include '../view/header.php';

?>

<div class="wrapper">
    <h1>products</h1>

    <!-- CATEGORIES -->
    <div class="category-div">
        <nav class="category">
            <ul>
                <li><a href="?category=hair">Hair Accessories</a></li>
                <li><a href="?category=ring">Rings</a></li>
                <li><a href="?category=bracelet">Bracelets</a></li>
                <li><a href="?category=necklace">Necklaces</a></li>
                <li><a href="?category=earring">Earrings</a></li>
                <li><a href="?category=all">All</a></li>
            </ul>
        </nav>
    </div>


    <!-- Display main page with newest products -->

    <div class="flex-container">
        <div class="flex-child filter">
            <div class="filter">
                <form action="#" method="get">
                    <label for="metalsearch">Metal Type:</label>
                    <select name="metalsearch">
                        <option value="all">All</option>

                        <?php
                        // automatically pulls all metals from database
                        $query = "SELECT DISTINCT Metal FROM ITEM";
                        $result = $db->query($query);
                        $num_results = $result->num_rows;
                        for ($j = 0; $j < $num_results; $j++) {
                            $row = $result->fetch_assoc();
                            echo '<option value="' . $row['Metal'] . '">' . $row['Metal'] . '</option>';
                        }
                        ?>
                    </select>

                    <label for="crystalsearch">Crystal Type:</label>
                    <select name="crystalsearch">
                        <option value="all">All</option>

                        <?php
                        // automatically pulls all crystals from database
                        $query = "SELECT DISTINCT Crystal FROM ITEM";
                        $result = $db->query($query);
                        $num_results = $result->num_rows;
                        for ($j = 0; $j < $num_results; $j++) {
                            $row = $result->fetch_assoc();
                            echo '<option value="' . $row['Crystal'] . '">' . $row['Crystal'] . '</option>';
                        }
                        ?>

                    </select>

                    <input type="hidden" name="category" value=<?php echo $category ?>>
                    <button type="submit" name="search" style="margin: 10px">Search</button>
                </form>

                <br><br>
                <form action="#" method="get">
                    <label for="searchterm">Search by Keyword:</label>
                    <input name="searchterm" type="text">
                    <input type="hidden" name="category" value=<?php echo $category ?>>
                    <br>
                    <button type="submit" name="termsearch">Search</button>
                </form>

            </div>
        </div>

        <div class="flex-child items">

            <h2><?php echo $category ?></h2>

            <?php

            // Select items that are in stock
            $query = "SELECT * FROM ITEM WHERE QuantityInStock > 0";

            if ($category != 'all') {
                $query .= " AND JewelryType = '" . $category . "'";
            }

            if ($metal != 'all') {
                $query .= " AND Metal = '" . $metal . "'";
            }

            if ($crystal != 'all') {
                $query .= " AND Crystal = '" . $crystal . "'";
            }

            if (isset($_GET['termsearch'])) {
                $query = "SELECT * FROM ITEM WHERE QuantityInStock > 0 AND ((Name like '%" . $searchterm . "%') OR (Description like '%" . $searchterm . "%'))";

                if ($category != 'all') {
                    $query .= " AND JewelryType = '" . $category . "'";
                }
            }

            $result = $db->query($query);

            $num_results = $result->num_rows;
            if ($num_results == 0) {
                echo '<p>No items were found.</p></br>';
            }

            echo '<div class="grid-container">';

            for ($i = 0; $i < $num_results; $i++) {
                $row = $result->fetch_assoc();
                echo '<div class="grid-item">';
                echo '<form action="product.php" method="get">';

                echo '<p>' . $row['Name'] . '<br>';
                echo '<i>' . $row['Crystal'] . ', ' . $row['Metal'] . '</i><br>';
                echo '$' . $row['Price'] . '</p><br>';
                echo '<input type="hidden" name="itemID" value="' . $row['ItemID'] . '"/>';
                echo '<button type="submit" name="details">view details</button>';
                echo '</form>';
                echo '</div>';
            }

            $result->free();
            $db->close();

            ?>
        </div>
    </div>
</div>
</div>
</body>

</html>