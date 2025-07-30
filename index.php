<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Chauhan Dairy</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

  <!-- Custom Styles -->
  <style>
    body {
      background-color: #f8f9fa;
      font-family: 'Segoe UI', sans-serif;
    }

    .hero {
      background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)),
        url('https://images.unsplash.com/photo-1582819953331-fd8f59a7d269?auto=format&fit=crop&w=1350&q=80') no-repeat center center;
      background-size: cover;
      padding: 80px 20px;
      color: white;
      text-align: center;
    }

    .hero h1 {
      font-size: 2.5rem;
      font-weight: bold;
    }

    .hero p {
      font-size: 1.1rem;
    }

    .quick-links .btn {
      width: 100%;
      margin: 8px 0;
      font-size: 1rem;
    }

    .info-card {
      transition: transform 0.2s;
    }

    .info-card:hover {
      transform: translateY(-5px);
    }

    footer {
      margin-top: 50px;
      padding: 15px 0;
      background-color: #212529;
      color: #fff;
      text-align: center;
    }

    @media (min-width: 768px) {
      .hero h1 {
        font-size: 3.5rem;
      }

      .quick-links .btn {
        width: auto;
        margin: 8px 10px;
      }
    }
  </style>
</head>
<body>

  <?php require("Element/navbar.php"); ?>

  <!-- Hero Section -->
  <section class="hero">
    <div class="container">
      <h1>Welcome to Chauhan Dairy</h1>
      <p>Manage customers, milk entries, and bills – all in one place</p>
      <div class="d-flex flex-column flex-md-row justify-content-center align-items-center quick-links mt-4">
        <a href="add_customer.php" class="btn btn-light">➕ Add Customer</a>
        <a href="daily_entry.php" class="btn btn-warning">📝 Add Daily Entry</a>
        <a href="bill.php" class="btn btn-success">📄 Generate Bill</a>
      </div>
    </div>
  </section>

  <!-- Info Section -->
  <section class="container py-5">
    <h3 class="text-center mb-4">Why Choose Chauhan Dairy?</h3>
    <div class="row g-4">
      <div class="col-md-4">
        <div class="card info-card border-0 shadow-sm h-100 text-center">
          <div class="card-body">
            <h5 class="card-title">📱 Easy Entry</h5>
            <p class="card-text">Log milk entries quickly from your mobile or desktop.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card info-card border-0 shadow-sm h-100 text-center">
          <div class="card-body">
            <h5 class="card-title">📄 Instant Billing</h5>
            <p class="card-text">Generate bills for any date range in seconds.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card info-card border-0 shadow-sm h-100 text-center">
          <div class="card-body">
            <h5 class="card-title">🔒 Safe Records</h5>
            <p class="card-text">All data is stored securely in your own database.</p>
          </div>
        </div>
      </div>
    </div>
  </section>
  
<?php
  require("Element/footer.php");
?>
</body>
  <!-- Footer
