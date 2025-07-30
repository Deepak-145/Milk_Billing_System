<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Milk Daily Entry</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

  <style>
    body {
      background-color: #f8f9fa;
    }

    .delete-btn {
      font-size: 1.2rem;
      padding: 12px 24px;
      box-shadow: 0 4px 10px rgba(220, 53, 69, 0.3);
      transition: all 0.3s ease-in-out;
      border-radius: 8px;
    }

    .delete-btn:hover {
      background-color: #c82333 !important;
      transform: scale(1.05);
      box-shadow: 0 6px 16px rgba(220, 53, 69, 0.4);
    }
  </style>
</head>

<body>
     <?php
  require("Element/navbar.php");
  ?>

  <div class="container mt-5 text-center">
    <button type="button" id="delete_all_entries" class="btn btn-danger delete-btn animate__animated animate__fadeInUp">
      🗑️ Delete All Milk Entries
    </button>

    <p class="mt-3 text-danger fw-bold">
      ⚠️ Warning: This will permanently delete all milk entry records.<br>
      Once deleted, <u>you will not be able to recover them</u>.
    </p>
  </div>

  <script>
    $('#delete_all_entries').on('click', function () {
      if (confirm("⚠️ Are you sure you want to delete ALL milk entries?\n\nThis action is PERMANENT and cannot be undone.\n\nOnce deleted, data cannot be recovered.")) {
        $.ajax({
          url: 'php/delete_all_entries.php',
          type: 'POST',
          success: function (res) {
            if (res.trim() === "success") {
              alert("✅ All milk entries have been permanently deleted.");
              location.reload();
            } else {
              alert("❌ Failed to delete entries.");
              console.error(res);
            }
          },
          error: function (xhr, status, error) {
            alert("AJAX error: " + status + " - " + error);
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
