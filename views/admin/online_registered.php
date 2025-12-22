<?php
use App\Controllers\AreaController;

include_once __DIR__ . '../../../vendor/autoload.php';
$pagetitle = 'Attendees';
include_once __DIR__ . '../../layouts/header.php';
$currentPage = 'Online Registrations';

$userid = $_SESSION['data']['id'];


$getAttendeesPerAreas = ( new AreaController )->getAttendees($userid);



?>

<div class="offcanvas offcanvas-start shadow-lg rounded-3" style="width: 900px;" tabindex="-1" id="offcanvasExample"
    aria-labelledby="offcanvasExampleLabel">

    <!-- Header -->
    <div class="offcanvas-header text-white rounded-top" style="background: rgb(0, 82, 204);">
        <h4 class="offcanvas-title fw-semibold mb-0" id="offcanvasExampleLabel">
            <i class="fa-regular fa-address-card me-2"></i>

            Member Details
        </h4>
        <button type="button" class="btn-close btn-close-white text-reset" data-bs-dismiss="offcanvas"
            aria-label="Close"></button>
    </div>

    <div class="offcanvas-body bg-light">
        <div class="row g-4">
            <!-- Left column: member details -->
            <div class="col-md-8">
                <div class="card border-0 shadow-sm rounded-4 p-3">
                    <div class="mb-3">
                        <label class="form-label fw-bold text-secondary">Member Name</label>
                        <p id="offcanvasName" class="text-dark fs-5 fw-semibold"></p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold text-secondary">Account Number</label>
                        <p id="offcanvasAccount" class="text-dark fs-5 fw-semibold"></p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold text-secondary">Address</label>
                        <p id="offcanvasAddress" class="text-dark"></p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold text-secondary">Member OR</label>
                        <p id="offcanvasOR" class="text-dark"></p>
                    </div>
                </div>
            </div>

            <!-- Right column: QR Code -->
            <div class="col-md-4">
                <div
                    class="card border-0 shadow-sm rounded-4 text-center p-4 h-100 d-flex flex-column justify-content-center align-items-center">
                    <label class="form-label fw-bold text-secondary mb-3">QR Code</label>
                    <div id="offcanvasQR" class="bg-white border rounded-3 p-3 shadow-sm"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="d-flex p-3 justify-content-end border-top bg-white">
        <button class="btn btn-success" id="editBtn">Edit</button>
    </div>
</div>

<div class="app-container">

    <!-- Top Panel -->
    <?php include_once __DIR__ . '/../components/top_panel.php'; ?>


    <!-- Main Layout (Sidebar + Content) -->
    <div class="layout" style="background-color: #F5F5F5;">

        <?php include_once __DIR__ . '../../components/menu/sidebar.php'; ?>

        <div class="content">
            <h3>Online Registrations</h3>
            <hr style="margin-bottom: 2rem; border-color: #BCC0C6FF;">

            <div class="card-grid">
                <table id="searchTable" class="mt-3 table table-striped table-bordered hover display" style="width: 100%; background-color: white;">
                    <thead>
                        <th class="bg-dark text-white" style="width:30em;">Name</th>
                        <th class="bg-dark text-white">Account No.</th>
                        <th class="bg-dark text-white">Address</th>
                        <th class="bg-dark text-white">Action</th>
                    </thead>
                    <tbody>
                        <?php if( !empty($getAttendeesPerAreas) ): ?>
                            <?php foreach($getAttendeesPerAreas as $getAttendeesPerArea): ?>
                                <tr>
                                    <td>
                                        <?= $getAttendeesPerArea['consumer_name'] ?>
                                    </td>
                                    <td>
                                        <?= $getAttendeesPerArea['account_no'] ?>
                                    </td>
                                    <td>
                                        <?= $getAttendeesPerArea['address'] ?>
                                    </td>
                                    <td>
                                        <button
                                            id="ViewBtn"
                                            class="btn btn-sm btn-primary"
                                            data-bs-toggle="offcanvas"
                                            data-bs-target="#offcanvasExample"
                                            aria-controls="offcanvasExample"
                                            data-id="<?= $getAttendeesPerArea['account_no'] ?>"
                                            data-name="' . $name . '"
                                            data-account="' . $accountNo . '"
                                            data-address="' . $address . '"
                                        >
                                            View
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            no data
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include_once __DIR__ . '../../layouts/footer.php'; ?>

<script>
        // ============================================
    // SINGLE Offcanvas Listener + QR Code Generator
    // ============================================
    document.addEventListener("DOMContentLoaded", function () {

        const offcanvas = document.getElementById("offcanvasExample");

        offcanvas.addEventListener("show.bs.offcanvas", function (event) {

            const button = event.relatedTarget;

            const name = button.getAttribute("data-name") || "";
            const account = button.getAttribute("data-account") || "";
            const address = button.getAttribute("data-address") || "";
            const orNo = button.getAttribute("data-or") || "";
            const townCode = button.getAttribute("data-towncode") || "";

            // Fill text values
            document.getElementById("offcanvasName").textContent = name;
            document.getElementById("offcanvasAccount").textContent = account;
            document.getElementById("offcanvasAddress").textContent = address;
            document.getElementById("offcanvasOR").textContent = orNo;

            // Generate QR text
            const qrText =
                `Name: ${name}\n` +
                `Account #: ${account}\n` +
                `Address: ${address}\n` +
                `OR: ${orNo}\n` +
                `Town Code: ${townCode}`;

            // Generate QR Code
            const qrDiv = document.getElementById("offcanvasQR");
            qrDiv.innerHTML = ""; // Clear old QR

            new QRCode(qrDiv, {
                text: qrText,
                width: 220,
                height: 220
            });
        });

    });
</script>