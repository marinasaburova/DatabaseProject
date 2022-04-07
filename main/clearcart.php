<?php
require '../view/session.php';

if (isset($_POST['clear'])) {
  unset($_SESSION['cart']);
  $_SESSION['cart'] = '';
  header('Location:' . $_SERVER['HTTP_REFERER']);
  exit;
}
