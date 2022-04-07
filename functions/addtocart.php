<?php

require '../view/session.php';
require '../functions/db.php';

// add to cart
if (isset($_POST['addcart'])) {
    $cart = $_SESSION['cart'];
    $itemid = $_POST['itemID'];

    $query = "SELECT * FROM ITEM WHERE ItemID = '" . $itemid . "'";
    $result = $db->query($query);
    $num_results = $result->num_rows;
    $product = $result->fetch_assoc();

    // append item once for each quantity
    for ($i = 0; $i < $_POST['quantity']; $i++) {
        if ($cart) {
            $cart .= ',' . $itemid;
        } else {
            $cart = $itemid;
        }
    }

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

    $_SESSION["cart"] = $cart;

    header('Location:' . $_SERVER['HTTP_REFERER'] . '?' . $_SERVER['QUERY_STRING']);
    die;
}
