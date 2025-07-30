<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold fs-4" href="index.php">🧺 चौहान दूध भंडार</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-white <?= basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active fw-bold' : '' ?>" href="index.php">🏠 Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white <?= basename($_SERVER['PHP_SELF']) == 'add_customer.php' ? 'active fw-bold' : '' ?>" href="add_customer.php">➕ Add Customer</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white <?= basename($_SERVER['PHP_SELF']) == 'daily_entry.php' ? 'active fw-bold' : '' ?>" href="daily_entry.php">📅 Daily Entry</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white <?= basename($_SERVER['PHP_SELF']) == 'Bill.php' ? 'active fw-bold' : '' ?>" href="Bill.php">🧾 Bill</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white <?= basename($_SERVER['PHP_SELF']) == 'delete_data.php' ? 'active fw-bold' : '' ?>" href="delete_data.php">🗑️ Delete Data</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
