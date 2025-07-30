<?php
require("db.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);

    $delete = $db->query("DELETE FROM register WHERE id = $id");

    if ($delete) {
        echo "success";
    } else {
        echo "error";
    }
} else {
    echo "invalid";
}
?>
