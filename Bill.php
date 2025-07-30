<?php
require("php/db.php");

// Fetch customers
$customers = $db->query("SELECT * FROM register");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Milk Bill</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>

  <style>
    @media (max-width: 576px) {
      h3, h4 { font-size: 1.3rem; }
      table th, table td { font-size: 0.85rem; }
    }

    @media (max-width: 360px) {
      #send-whatsapp-pdf { margin-top: 10px; }
    }

    @media print {
      body * { visibility: hidden; }
      #bill-section, #bill-section * { visibility: visible; }
      #bill-section {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
      }
    }
  </style>
</head>

<body>
<?php require("Element/navbar.php"); ?>
<br>

<div class="container">
  <h3 class="mb-4 text-center">Generate Milk Bill</h3>

  <!-- Bill Form -->
  <form method="POST" class="row g-3" id="bill-form">
    <div class="col-12 col-sm-6 col-md-4">
      <label class="form-label">Customer Name</label>
      <select name="customer_name" id="customer_select" class="form-select" required>
        <option value="">Select Customer</option>
        <?php while ($row = $customers->fetch_assoc()): ?>
          <option value="<?= $row['fullname'] ?>" data-phone="<?= $row['mobile_no'] ?>">
            <?= htmlspecialchars($row['fullname']) ?>
          </option>
        <?php endwhile; ?>
      </select>
    </div>

    <div class="col-12 col-sm-6 col-md-4">
      <label class="form-label">Mobile Number</label>
      <input type="text" id="customer_number" class="form-control" readonly>
    </div>

    <div class="col-6 col-md-2">
      <label class="form-label">From</label>
      <input type="date" name="from_date" class="form-control" required>
    </div>

    <div class="col-6 col-md-2">
      <label class="form-label">To</label>
      <input type="date" name="to_date" class="form-control" required>
    </div>

    <div class="col-12 col-md-4">
      <label class="form-label">Adjustment Amount (Optional)</label>
      <input type="number" name="adjustment" step="0.01" class="form-control" placeholder="e.g. -50 or 100">
    </div>

    <div class="col-12 col-md-8">
      <label class="form-label">Adjustment Note (Optional)</label>
      <input type="text" name="adjustment_note" class="form-control" placeholder="e.g. पिछली बार के बचे पैसे">
    </div>

    <div class="col-12 text-end">
      <button type="submit" class="btn btn-success">Show Bill</button>
    </div>
  </form>

  <script>
    document.getElementById('customer_select').addEventListener('change', function () {
      const selected = this.options[this.selectedIndex];
      document.getElementById('customer_number').value = selected.dataset.phone || '';
    });
  </script>

  <?php
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['customer_name'];
    $from = $_POST['from_date'];
    $to = $_POST['to_date'];
    $adjustment = isset($_POST['adjustment']) ? floatval($_POST['adjustment']) : 0;
    $adjustment_note = isset($_POST['adjustment_note']) ? trim($_POST['adjustment_note']) : '';

    $stmt = $db->prepare("SELECT * FROM milk_entries WHERE customer_name = ? AND date BETWEEN ? AND ?");
    $stmt->bind_param("sss", $name, $from, $to);
    $stmt->execute();
    $result = $stmt->get_result();

    $grand_total = 0;
    $grand_liters = 0;
  ?>
    <hr class="my-4">
    <div class="text-end mb-3">
      <button onclick="window.print()" class="btn btn-primary">🖨️ Print This Bill</button>
      <button id="send-whatsapp-pdf" class="btn btn-success">Send Bill on WhatsApp</button>
    </div>

    <div id="bill-section">
      <h4 class="mb-3 text-center">🥛 चौहान दूध भंडार</h4>
      <h4 class="mb-3 text-center">📞 8445777634 | गांव: चौहानपुर, पोस्ट: हरदुआगंज</h4>
      <h5 class="mb-3 text-center">👤 Proprietor: Shri Mahendra Singh Ji</h5>

      <h4 class="mb-3 text-center">
        Bill for <?= htmlspecialchars($name) ?> <br>
        <small>(<?= date('d-m-Y', strtotime($from)) ?> to <?= date('d-m-Y', strtotime($to)) ?>)</small>
      </h4>

      <div class="table-responsive">
        <table class="table table-bordered table-striped text-center">
          <thead class="table-dark">
            <tr>
              <th>Date</th>
              <th>Liters</th>
              <th>Cost</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($row = $result->fetch_assoc()):
              $grand_total += $row['total'];
              $grand_liters += $row['liters'];
            ?>
              <tr>
                <td><?= date('d-m-Y', strtotime($row['date'])) ?></td>
                <td><?= $row['liters'] ?></td>
                <td>₹<?= number_format($row['total'], 2) ?></td>
              </tr>
            <?php endwhile; ?>
          </tbody>
          <tfoot>
            <tr>
              <th>Total</th>
              <th><?= number_format($grand_liters, 2) ?> Ltr</th>
              <th>₹<?= number_format($grand_total, 2) ?></th>
            </tr>
            <?php if ($adjustment != 0): ?>
            <tr>
              <th colspan="2" class="text-end"><?= $adjustment_note ? htmlspecialchars($adjustment_note) : 'Adjustment' ?></th>
              <th><?= $adjustment >= 0 ? '+' : '' ?>₹<?= number_format($adjustment, 2) ?></th>
            </tr>
            <?php endif; ?>
            <tr class="table-success">
              <th colspan="2" class="text-end">Final Total</th>
              <th>₹<?= number_format($grand_total + $adjustment, 2) ?></th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>

    <script>
      document.getElementById('send-whatsapp-pdf').addEventListener('click', async function () {
        const bill = document.getElementById('bill-section');
        const name = <?= json_encode($name) ?>;
        const mobile = document.getElementById("customer_number").value;
        const finalTotal = <?= json_encode(number_format($grand_total + $adjustment, 2)) ?>;
        const note = <?= json_encode($adjustment_note) ?>;

        const canvas = await html2canvas(bill, { scale: 3 });
        const imgData = canvas.toDataURL('image/png');
        const { jsPDF } = window.jspdf;
        const pdf = new jsPDF('p', 'mm', 'a4');
        const pageWidth = pdf.internal.pageSize.getWidth();
        const pageHeight = pdf.internal.pageSize.getHeight();

        let imgWidth = pageWidth;
        let imgHeight = (canvas.height * imgWidth) / canvas.width;

        if (imgHeight > pageHeight) {
          imgHeight = pageHeight;
          imgWidth = (canvas.width * imgHeight) / canvas.height;
        }

        const x = (pageWidth - imgWidth) / 2;
        const y = (pageHeight - imgHeight) / 2;

        pdf.addImage(imgData, 'PNG', x, y, imgWidth, imgHeight);

        const pdfBlob = pdf.output('blob');
        const pdfFile = new File([pdfBlob], `Milk_Bill_${name}.pdf`, { type: "application/pdf" });

        const message = `Hello ${name}, your milk bill from Chauhan Dairy is ready.%0AFinal Amount: ₹${finalTotal}.` + 
          (note ? `%0AAdjustment Note: ${note}` : '') + `%0APlease check the attached bill.`;

        if (navigator.canShare && navigator.canShare({ files: [pdfFile] })) {
          try {
            await navigator.share({
              files: [pdfFile],
              title: 'Milk Bill',
              text: message.replace(/%0A/g, "\n"),
            });
          } catch (err) {
            alert("Sharing failed or was canceled.");
          }
        } else {
          const whatsappUrl = `https://wa.me/91${mobile}?text=${message}`;
          window.open(whatsappUrl, '_blank');

          const downloadLink = document.createElement('a');
          downloadLink.href = URL.createObjectURL(pdfBlob);
          downloadLink.download = `Milk_Bill_${name}.pdf`;
          downloadLink.click();
        }
      });
    </script>

  <?php } ?>
</div>

<?php require("Element/footer.php"); ?>
</body>
</html>
