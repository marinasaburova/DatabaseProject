<?php

@$db = new mysqli('localhost', 'root', '', 'jewelryshop');

if (mysqli_connect_errno()) {
    echo "Error: Could not connect to database.  Please try again later.";
    exit;
}
?>