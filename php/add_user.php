<?php
require("db.php");
// php/add_user.php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize input
    $name = $_POST['name'];
    $phone = $_POST['phone'] ;
    $rate = $_POST['rate'];
    $date = $_POST['date'];

    // You can add database code here

   $db->query("CREATE TABLE IF NOT EXISTS register (
    id INT PRIMARY KEY AUTO_INCREMENT,
    fullname VARCHAR(100),
    mobile_no VARCHAR(15),
    rate varchar(50),
    date VARCHAR(100)
    
    )");

    $store_data=$db->query("INSERT INTO register (fullname,mobile_no,rate,date) VALUES ('$name','$phone','$rate','$date')");
    if($store_data){
        echo "success";
    }
    else{
        echo "unsuccess";
    }
   
} else {
    echo "Invalid request";
    exit;
}
