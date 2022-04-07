<?php
require '../view/session.php';

if (isset($_POST['remove'])) {

    // remove selected item
    $item = $_POST['itemID'];
    $cart = $_SESSION['cart'];
    $items = explode(',', $cart);
    $quantity = array_count_values($items);
    unset($quantity[$_POST['itemID']]);

    // rearrange cart
    $cart = '';
    foreach ($quantity as $item => $count) {
        for ($i = 0; $i < $count; $i++) {
            if ($cart) {
                $cart .= ',' . $item;
            } else {
                $cart = $item;
            }
        }
    }

    $_SESSION['cart'] = $cart;

    header('Location:' . $_SERVER['HTTP_REFERER']);
    exit;
}
