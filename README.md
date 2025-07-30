# 🥛 Milk Billing System

A complete PHP-based dairy billing project for local milk vendors. This system allows dairy owners to manage customer milk entries, generate daily/monthly bills, print them, and even share via WhatsApp as PDF.

---

## 📌 Project Overview

This application was built for **Chauhan Doodh Bhandar**, a local dairy service, to simplify the milk collection and billing process. It supports:

* Daily milk entry for each customer
* Bill generation for any date range
* Total liters and payment calculation
* One-click print
* PDF generation and WhatsApp sharing
* Option to delete all milk entries

---

## ✅ Features

* 👥 Add and manage customers
* 📅 Record daily milk entries with liters and rate
* 🧾 Generate bills with grand total of liters and ₹
* 🖨️ Print well-formatted bills
* 📤 Send bill as PDF through WhatsApp
* 🗑️ Delete all milk records with confirmation

---

## 🧰 Technology Used

* **PHP** – Server-side scripting for handling backend logic
* **MySQL** – Database to store customers and milk entries
* **HTML/CSS** – Web page structure and styling
* **Bootstrap 5** – Responsive layout and modern UI
* **JavaScript** – Client-side interactivity
* **jQuery + AJAX** – Dynamic data actions (fetch, delete)
* **html2canvas** – Convert bill layout into image
* **jsPDF** – Generate downloadable/sharable PDF

---

## 📁 Project Structure

```
chauhan-milk-bill/
│
├── Bill.php                  # Generate and print/send bill
├── daily_entry.php          # Add daily milk records
├── add_user.php             # Add new customers
├── php/
│   ├── db.php               # Database connection file
│   └── delete_all_entries.php # AJAX delete script
├── Element/
│   ├── navbar.php
│   └── footer.php
├── milkwebsite.sql          # MySQL DB file (import in phpMyAdmin)
└── README.md
```

---

## 🧪 How to Use This Project

### 1. Download or Clone the Repository

```bash
git clone https://github.com/yourusername/chauhan-milk-bill.git
```

### 2. Set Up in Localhost

* Install [WAMP](https://www.wampserver.com/) or [XAMPP](https://www.apachefriends.org/index.html)
* Copy the project folder into:

  * `C:/wamp64/www/` for WAMP
  * `C:/xampp/htdocs/` for XAMPP

### 3. Import the Database

* Open any browser and go to: `http://localhost/phpmyadmin`
* Create a new database named `milkwebsite`
* Run the following SQL command:

```sql
CREATE DATABASE milkwebsite;
```

* Import the `milkwebsite.sql` file provided in the project folder

### 4. Configure Database Connection

Edit the `php/db.php` file:

```php
<?php
$db = new mysqli("localhost", "root", "", "milkwebsite");
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
?>
```

### 5. Launch the Website

Open your browser and go to:

```
http://localhost/chauhan-milk-bill/index.php
```

---

## 🦾 How to Use the Website

### ➕ Add a Customer

* Navigate to `add_user.php`
* Fill in customer full name and mobile number
* Submit — the customer will appear in billing dropdown
* 

### 🐄 Make Daily Milk Entry

* Go to `daily_entry.php`
* Choose customer, select date, enter liters and rate
* The system auto-calculates total

### 📅 Generate a Bill

* Open `Bill.php`
* Select customer and a date range
* Click **"Show Bill"**
* A table appears with:

  * Date-wise entries
  * Total liters
  * Grand total ₹ amount

### 🖨️ Print the Bill

Click **"🖨️ Print This Bill"** to open your browser's print dialog

### 📤 Share via WhatsApp

Click **"Send Bill on WhatsApp"**

* Captures the bill as an image
* Converts it to PDF
* Opens WhatsApp web with message or allows native sharing

### 🗑️ Delete All Entries (Admin Only)

Click **"🗑️ Delete All Entries"**

* Shows a warning confirmation
* Deletes all records from `milk_entries`

## 👨‍💻 Developer

**Deepak Varshney**
