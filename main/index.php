<?php
// get variables from search 
$category = 'all';

if (isset($_GET['metalsearch'])) {
    $metal = $_GET['metalsearch'];
} else {
    $metal = 'all';
}

if (isset($_GET['crystalsearch'])) {
    $crystal = $_GET['crystalsearch'];
} else {
    $crystal = 'all';
}

$category = filter_input(
    INPUT_GET,
    'category'
);
if ($category == NULL || $category == FALSE) {
    $category = "all";
}

if (isset($_GET['searchterm'])) {
    $searchterm = trim($_GET['searchterm']);
}

include 'home.php';
