<?php

// One-time Init Pagination
$start = STARTING_PAGE;
$limit = ITEM_PER_PAGE;
if (isset($_GET['page'])) {
    if ($_GET['page'] == NULL) {
        header('location: ' . URL . 'error');
    } else {
        $id = $_GET['page'];
        $start = ($id - 1) * $limit;
    }
} else {
    $id = STARTING_PAGE;
}
