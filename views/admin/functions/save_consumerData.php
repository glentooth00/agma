<?php
include_once __DIR__ . '/../../../vendor/autoload.php';

use App\Models\Registration;

$data = [
    'account_no'     => $_POST['id'],
    'member_name'    => $_POST['member_name'],
    'meter_number'   => $_POST['meter_number'],
    'contact_no'     => $_POST['contact_no'],
    'email'          => $_POST['email'],
    'date_of_birth'  => $_POST['date_of_birth'],
    'Address'        => $_POST['Address'],
    'image'          => $_FILES['image']
];

$saveRegistration = (new Registration)->saveRegistration($data);
$consumerData = json_decode($saveRegistration, true);

if ($consumerData) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- QR Code Library -->
<script src="https://cdn.jsdelivr.net/npm/qrcodejs/qrcode.min.js"></script>

<style>
    body{
    font-family: system-ui, -apple-system, "Segoe UI", sans-serif;
    background-color: #053668FF;
    }

.consumer-card {
    width: 100%;
    max-width: 420px;
    margin: 16px auto;
    background: #ffffff;
    border-radius: 14px;
    box-shadow: 0 6px 18px rgba(0,0,0,0.08);
    overflow: hidden;
    font-family: system-ui, -apple-system, "Segoe UI", sans-serif;
    
}

.consumer-card .card-header {
    background: #0d6efd;
    color: #fff;
    padding: 14px 16px;
    text-align: center;
    
}

.consumer-card .card-header h3 {
    margin: 0;
    font-size: clamp(16px, 4vw, 18px);
    font-weight: 600;
    
}

.consumer-card .card-body {
    padding: 16px;
    box-shadow: rgba(0, 0, 0, 0) 0px 0px 0px 0px, rgba(0, 0, 0, 0) 0px 0px 0px 0px, rgba(0, 0, 0, 0.1) 0px 1px 3px 0px, rgba(0, 0, 0, 0.06) 0px 1px 2px 0px
}

.consumer-card .info-row {
    margin-bottom: 14px;
}

.consumer-card .info-row span {
    font-size: clamp(11px, 3vw, 12px);
    color: #6c757d;
    display: block;
    margin-bottom: 4px;
    
}

.consumer-card .info-row p {
    margin: 0;
    font-size: clamp(14px, 4vw, 15px);
    font-weight: 600;
    color: #212529;
    word-break: break-word;
    line-height: 1.35;
}

/* QR SECTION */
.consumer-card .qr-section {
    border-top: 1px dashed #dee2e6;
    padding: 16px;
    text-align: center;
    background: #f8f9fa;
    margin-bottom: 35px;
}

.consumer-card .qr-label {
    margin-bottom: 10px;
    font-size: 13px;
    font-weight: 600;
}

.consumer-card .qr-image {
    width: 160px;
    height: 160px;
    margin: 0 auto;
    border: 1px solid #ced4da;
    padding: 8px;
    background: #fff;
    border-radius: 10px;
    box-shadow: rgba(0, 0, 0, 0) 0px 0px 0px 0px, rgba(0, 0, 0, 0) 0px 0px 0px 0px, rgba(0, 0, 0, 0.1) 0px 1px 3px 0px, rgba(0, 0, 0, 0.06) 0px 1px 2px 0px
}

/* Download button */
.card-actions {
    text-align: center;
    padding: 14px;
    box-shadow: rgba(0, 0, 0, 0) 0px 0px 0px 0px, rgba(0, 0, 0, 0) 0px 0px 0px 0px, rgba(0, 0, 0, 0.1) 0px 1px 3px 0px, rgba(0, 0, 0, 0.06) 0px 1px 2px 0px
}

#downloadCardBtn {
    width: 100%;
    max-width: 280px;
    padding: 12px;
    font-size: 14px;
    font-weight: 600;
    color: #fff;
    background: #198754;
    border: none;
    border-radius: 10px;
    cursor: pointer;
}

.hide-for-download {
    display: none !important;
}

@media only screen and (max-width: 600px) {
.consumer-card {
        margin-top: -5em;
        box-shadow: rgba(0, 0, 0, 0) 0px 0px 0px 0px, rgba(0, 0, 0, 0) 0px 0px 0px 0px, rgba(0, 0, 0, 0.1) 0px 1px 3px 0px, rgba(0, 0, 0, 0.06) 0px 1px 2px 0px
    }

}
    

</style>
</head>

<body>

<div id="cardWrapper" style="margin-top: 6em;">
    <div class="consumer-card">
        <div class="card-header">
            <h3>Consumer Registration</h3>
        </div>

        <div class="card-body">
            <div class="info-row">
                <span>Full Name</span>
                <p><?= htmlspecialchars($consumerData['fullname']) ?></p>
            </div>

            <div class="info-row">
                <span>Account Number</span>
                <p><?= htmlspecialchars($consumerData['account_number']) ?></p>
            </div>

            <div class="info-row">
                <span>Meter Number</span>
                <p><?= htmlspecialchars($consumerData['meter_number']) ?></p>
            </div>

            <div class="info-row">
                <span>Contact Number</span>
                <p><?= htmlspecialchars($consumerData['contact_number']) ?></p>
            </div>

            <div class="info-row">
                <span>Address</span>
                <p><?= htmlspecialchars($consumerData['address']) ?></p>
            </div>
        </div>

        <!-- QR CODE AREA -->
        <div class="qr-section ">
            <p class="qr-label">QR Code</p>
            <div id="consumerQR" class="qr-image"></div>
        </div>
    </div>
</div>

<!-- Download Button -->
<div class="card-actions">
    <button id="downloadCardBtn">Download Proof of Registration</button>
</div>

<!-- html2canvas -->
<script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>

<script>
/* ================================
   QR CODE GENERATION (Offcanvas-style)
================================ */
document.addEventListener("DOMContentLoaded", function () {

    const name    = "<?= addslashes($consumerData['fullname']); ?>";
    const account = "<?= addslashes($consumerData['account_number']); ?>";
    const meter   = "<?= addslashes($consumerData['meter_number']); ?>";
    const contact = "<?= addslashes($consumerData['contact_number']); ?>";
    const address = "<?= addslashes($consumerData['address']); ?>";

    const qrText =
        `Name: ${name}\n` +
        `Account #: ${account}\n` +
        `Meter #: ${meter}\n` +
        `Contact: ${contact}\n` +
        `Address: ${address}`;

    const qrDiv = document.getElementById("consumerQR");
    qrDiv.innerHTML = "";

    new QRCode(qrDiv, {
        text: qrText,
        width: 160,
        height: 160,
        correctLevel: QRCode.CorrectLevel.H
    });
});

/* ================================
   DOWNLOAD CARD AS IMAGE
================================ */
document.getElementById('downloadCardBtn').addEventListener('click', function () {

    const buttonArea = document.querySelector('.card-actions');
    buttonArea.classList.add('hide-for-download');

    html2canvas(document.getElementById('cardWrapper'), {
        scale: 2,
        useCORS: true
    }).then(canvas => {

        const link = document.createElement('a');
        link.download = 'consumer-card-<?= $consumerData['account_number']; ?>.png';
        link.href = canvas.toDataURL('image/png');
        link.click();

        buttonArea.classList.remove('hide-for-download');
    });
});
</script>

</body>
</html>

<?php } ?>
