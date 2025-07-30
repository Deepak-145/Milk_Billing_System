<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Manage Customers</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <style>
    /* Optional: Better mobile experience for table */
    .table-responsive {
      overflow-x: auto;
    }
  </style>
</head>

<body>

  <?php
  require("Element/navbar.php");
  require("php/db.php"); // adjust to your connection file

  // ✅ Create table if it doesn't exist
  $createTableQuery = "
CREATE TABLE IF NOT EXISTS register (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(100) NOT NULL,
    mobile_no VARCHAR(15) NOT NULL,
    rate DECIMAL(6,2) NOT NULL,
    date DATE NOT NULL
)";

  $db->query($createTableQuery); // create the table if not exists

  // ✅ Then fetch customers
  $customers = $db->query("SELECT * FROM register");
  ?>
  <div class="container mt-4">
    <h2 class="mb-4 text-center text-md-start">Add New Customer</h2>

    <?php if (isset($success)) echo '<div class="alert alert-success">Customer Added Successfully!</div>'; ?>

    <form class="row g-3 mb-5" id="add_cus">
      <div class="col-12 col-md-6">
        <label class="form-label">Name</label>
        <input type="text" name="name" class="form-control" maxlength="50" required>
      </div>
      <div class="col-12 col-md-6">
        <label class="form-label">Phone Number</label>
        <input type="number" name="phone" class="form-control" required>
      </div>
      <div class="col-12 col-md-6">
        <label class="form-label">Rate/Liter (₹)</label>
        <input type="number" step="0.01" name="rate" class="form-control" required>
      </div>

      <div class="col-12 col-md-6">
        <label class="form-label">Date</label>
        <input type="date" name="date" class="form-control" required>
      </div>
      <div class="col-12">
        <button type="submit" class="btn btn-primary w-100 w-md-auto">Add Customer</button>
      </div>
    </form>

    <h4 class="text-center text-md-start">Existing Customers</h4>
    <div class="table-responsive">
      <table class="table table-bordered table-striped align-middle">
        <thead class="table-light">
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Rate</th>
            <th>Date</th>
            <th>Delete</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = $customers->fetch_assoc()): ?>
            <tr>
              <td><?= $row['id'] ?></td>
              <td><?= htmlspecialchars($row['fullname']) ?></td>
              <td><?= htmlspecialchars($row['mobile_no']) ?></td>
              <td><?= htmlspecialchars($row['rate']) ?></td>
              <td><?= date("d-m-Y", strtotime($row['date'])) ?></td>
              <td>
                <button class="btn btn-danger btn-sm delete-btn" data-id="<?= $row['id'] ?>">
                  <i class="fas fa-trash-alt"></i>
                </button>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>

      </table>
    </div>
  </div>
  <script>
    $(document).ready(function() {
      $('#add_cus').submit(function(e) {
        e.preventDefault();
        let formData = new FormData(this);
        $.ajax({
          type: "POST",
          url: "php/add_user.php",
          data: formData,
          processData: false,
          contentType: false,
          cache: false,
          success: function(response) {

            location.reload();
          },
          error: function(xhr, status, error) {
            console.error("AJAX Error:", status, error);
          }
        });
      });
    });
    $(document).on('click', '.delete-btn', function() {
      const id = $(this).data('id');
      if (confirm("Are you sure you want to delete this customer?")) {
        $.ajax({
          type: "POST",
          url: "php/delete_user.php",
          data: {
            id: id
          },
          success: function(response) {
            if (response.trim() === "success") {
              location.reload();
            } else {
              alert("Failed to delete customer.");
            }
          },
          error: function(xhr, status, error) {
            console.error("AJAX Delete Error:", status, error);
          }
        });
      }
    });
  </script>
  <?php
  require("Element/footer.php");
  ?>
</body>

</html>