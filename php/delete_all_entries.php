<?php
require("db.php");

$query = "DELETE FROM milk_entries";

if ($db->query($query) === TRUE) {
    echo "success";
} else {
    echo "error";
}
?>
