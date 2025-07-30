<?php
require("db.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customer_name = $_POST['customer_name'];
    $customer_number = $_POST['customer_number']; // Get name directly from POST
    $date = $_POST['date'];
    $liters = $_POST['liters'];
    $rate = $_POST['rate'];
    $total = $liters * $rate;

    // Create the table if it doesn't exist
    $db->query("CREATE TABLE IF NOT EXISTS milk_entries (
        id INT AUTO_INCREMENT PRIMARY KEY,
        customer_name VARCHAR(100),
        customer_number VARCHAR(100),
        date DATE,
        liters DECIMAL(6,2),
        rate DECIMAL(6,2),
        total DECIMAL(10,2)
    )");

    // Insert milk entry
    $stmt = $db->prepare("INSERT INTO milk_entries (customer_name,customer_number, date, liters, rate, total) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssddd", $customer_name, $customer_number, $date, $liters, $rate, $total);

    if ($stmt->execute()) {
        echo "Milk entry added successfully!";
    } else {
        echo "Failed to add milk entry.";
    }
}
