<?php
require("Element/navbar.php");
require("php/db.php");

// Fetch customers for dropdown
$customers = $db->query("SELECT id, fullname, mobile_no,rate FROM register");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Milk Daily Entry</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>

    <div class="container mt-4">
        <h2 class="text-center mb-4">Daily Milk Entry</h2>

        <form id="milk_entry_form" class="row g-3">
            <div class="col-12 col-md-6">
                <label class="form-label">Select Customer</label>
                <select name="customer_name" id="customer_id" class="form-select" required>
                    <option value="">Select Customer</option>
                    </option>
                    <?php while ($row = $customers->fetch_assoc()): ?>
                        <option value="<?= htmlspecialchars($row['fullname']) ?>" data-phone="<?= $row['mobile_no'] ?>" data-rate="<?= $row['rate'] ?>">
                            <?= htmlspecialchars($row['fullname']) ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="col-12 col-md-6">
                <label class="form-label">Mobile Number</label>
                <input type="text" name="customer_number" id="phone" class="form-control" readonly>

            </div>

            <div class="col-12 col-md-6">
                <label class="form-label">Date</label>
                <input type="date" name="date" class="form-control" required>
            </div>

            <div class="col-6 col-md-3">
                <label class="form-label">Liters</label>
                <input type="number" step="0.01" name="liters" class="form-control" required >
            </div>

            <div class="col-6 col-md-3">
                <label class="form-label">Rate/Liter (₹)</label>
                <input type="number" step="0.01" name="rate" class="form-control" id="rate" readonly>
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-success w-100 w-md-auto">Submit Entry</button>
            </div>
        </form>

        <div id="msg" class="mt-3"></div>
    </div>

    <script>
        // Auto-fill mobile number
        $('#customer_id').on('change', function() {
    const selected = $(this).find(':selected');
    $('#phone').val(selected.data('phone'));
    $('#rate').val(selected.data('rate'));
});


        // AJAX Form Submission
        $('#milk_entry_form').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: 'php/add_entry.php',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                   console.log(response);
                    $('#milk_entry_form')[0].reset();
                },
                error: function() {
                    $('#msg').html(`<div class="alert alert-danger">Something went wrong.</div>`);
                }
            });
        });
    </script>
<?php
  require("Element/footer.php");
?>
</body>

</html>