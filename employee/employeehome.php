<?php
$title = "Employee Home";
require '../view/empsession.php';
include '../view/empheader.php';
?>

<div class="wrapper">
    <h1>Employee Home</h1>

    <div class="center-box">
        <div class="grid-container employee">
            <div class="grid-item">
                <form action="inventory.php" method="post">
                    <button type="submit" name="inventory">manage inventory</button>
                </form>
            </div>
            <div class="grid-item">
                <form action="orders.php" method="post">
                    <button type="submit" name="orders">manage orders</button>
                </form>
            </div>
            <div class="grid-item">
                <form action="empaccount.php" method="post">
                    <button type="submit" name="inventory">manage account</button>
                </form>
            </div>
        </div>
    </div>

</div>
</body>

</html>