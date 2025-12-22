<?php
include_once __DIR__ . '../../../vendor/autoload.php';
use App\Controllers\MembersController;

$pagetitle = 'Members';
include_once __DIR__ . '../../layouts/header.php';

$currentPage = 'Membership';
$members = (new MembersController)->getAllMembersSQL();
$userid = $_SESSION['data']['id'];
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



<div class="card" id="deletePopup" style="
    display: none;
    position: fixed;
    z-index: 1050;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    max-width: 400px;
    width: 90%;
    padding: 20px;
    box-shadow: rgb(27 27 27 / 69%) 0px 20px 20px 1000px;
    background-color: #fff;
    border-radius: 8px;
">

    <div>
        <h2 id="deleteTitle" style="font-size: 1.5rem; margin-bottom: 10px;">Confirm Delete?</h2>
        <hr>
        <p style="text-align: left; font-size: 16px;">
            You are about to delete a consumer's data. Are you sure you want to continue?
        </p>
    </div>

    <div class="d-flex" style="display: flex; justify-content: space-between; margin-top: 20px;">
        <button onclick="cancelDelete()" id="cancel" style="
            padding: 8px 16px;
            background-color: #6c757d;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        ">Cancel</button>

        <form id="deleteForm">
            <input type="hidden" name="id" id="deleteIdValue">
            <button type="submit" id="delete" style="
                padding: 8px 16px;
                background-color: #dc3545;
                color: white;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            ">Yes, Delete!</button>
        </form>
    </div>
</div>

<div id="pageContent">
    <div class="app-container">
        <?php include_once __DIR__ . '/../components/top_panel.php'; ?>

        <div class="layout" style="background-color: #F5F5F5;">
            <?php include_once __DIR__ . '../../components/menu/sidebar.php'; ?>
            <div class="content">
                <h3>Members </h3>
                <hr style="margin-bottom: 1rem; border-color: #e2e8f0;">

                <div id="searchArea">
                    <form id="searchForm" class="search-form">
                        <label for="searchInput" class="search-label">Search:</label>
                        <div class="search-wrapper">
                            <input type="text" name="member_data" id="searchInput"
                                placeholder="Search member Account number, Name, Meter number" required>
                            <i class="fa fa-search"></i>
                        </div>
                    </form>
                </div>

                <!-- Loading message -->
                <!-- <div id="loadingMessage" style="display: none; text-align:center; margin-top:20px;">
                    <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-2 fw-bold">Fetching data, please wait...</p>
                </div> -->

                <div id="searchResults"></div>

            </div>
        </div>
    </div>
</div>

<?php include_once '../layouts/footer.php'; ?>





<!-- user data modal ---->

<!-- ✅ Font Awesome CDN (only include once in the layout if not yet included) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
    #contentWrapper.loading {
        filter: blur(3px);
        pointer-events: none;
    }

    #searchArea {
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
    }

    .search-form {
        display: flex;
        align-items: center;
        gap: 10px;
        width: 100%;
    }

    .search-label {
        font-weight: 500;
        white-space: nowrap;
    }

    .search-wrapper {
        position: relative;
        width: 100%;
        max-width: 600px;
    }

    #searchInput {
        width: 100%;
        padding: 6px 36px 6px 12px;
        font-size: 13px;
        font-weight: 400;
        line-height: 1.5;
        color: #212529;
        background-color: #fff;
        border: 1px solid #ced4da;
        border-radius: 4px;
        transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
    }

    #searchInput:focus {
        border-color: #86b7fe;
        outline: 0;
        box-shadow: 0 0 0 0.25rem rgb(13 110 253 / 25%);
    }

    .search-wrapper i {
        position: absolute;
        right: 12px;
        top: 48%;
        transform: translateY(-50%);
        color: #555;
        pointer-events: none;
    }

    #editBtn {

        display: inline-block;
        outline: 0;
        text-align: center;
        cursor: pointer;
        padding: 0px 16px;
        border-radius: 2px;
        min-width: 80px;
        height: 32px;
        background-color: rgb(0, 120, 212);
        color: rgb(255, 255, 255);
        font-size: 14px;
        font-weight: 400;
        box-sizing: border-box;
        border: 1px solid rgb(0, 120, 212);
    }

    #editBtn:hover {
        background-color: rgb(16, 110, 190);
        border: 1px solid rgb(16, 110, 190);
    }

    #ViewBtn {

        display: inline-block;
        outline: 0;
        text-align: center;
        cursor: pointer;
        padding: 0px 16px;
        border-radius: 2px;
        min-width: 80px;
        height: 32px;
        background-color: rgb(0, 120, 212);
        color: rgb(255, 255, 255);
        font-size: 14px;
        font-weight: 400;
        box-sizing: border-box;
        border: 1px solid rgb(0, 120, 212);
    }

    #ViewBtn:hover {
        background-color: rgb(16, 110, 190);
        border: 1px solid rgb(16, 110, 190);
    }

    #deleteBtn {
        display: inline-block;
        outline: 0;
        text-align: center;
        cursor: pointer;
        padding: 0px 16px;
        border-radius: 2px;
        min-width: 80px;
        height: 32px;
        background-color: rgb(205 61 61);
        color: rgb(255, 255, 255);
        font-size: 14px;
        font-weight: 400;
        box-sizing: border-box;
        border: 1px solid rgb(181 42 42);
    }

    #deleteBtn:hover {
        background-color: rgb(205 61 61);
        border: 1px solid rgb(181 42 42);
    }

    #offcanvasQR canvas {
        margin-top: 5px;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 5px;
        background: #fff;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .offcanvas-header {
        box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;
    }

    #loadingOverlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(4px);
        z-index: 9999;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        text-align: center;
    }

    #loadingOverlay.active {
        display: flex;
    }
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

<script>
    // ================================
    // SEARCH + DATATABLE
    // ================================
    document.querySelector('.search-form').addEventListener('submit', function (e) {

        e.preventDefault();

        const form = this;
        const formData = new FormData(form);

        fetch(form.action, {
            method: 'POST',
            body: formData
        })
            .then(response => response.text())
            .then(data => {
                document.getElementById('resultDiv').innerHTML = data;

                if ($.fn.DataTable.isDataTable('#searchTable')) {
                    $('#searchTable').DataTable().destroy();
                }

                $('#searchTable').DataTable({
                    paging: true,
                    searching: true,
                    lengthChange: true,
                    pageLength: 10,
                    ordering: false,
                    info: true
                });
            })
            .catch(error => {
                document.getElementById('resultDiv').innerHTML =
                    '<p style="color:red;">Search failed. Please try again.</p>';
                console.error(error);
            });
    });


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



    // ============================================
    // JQUERY SEARCH (MEMBERS)
    // ============================================
    $(document).ready(function () {

        $('#searchForm').on('submit', function (e) {
            e.preventDefault();

            const searchValue = $('#searchInput').val();

            // let first = searchValue.substring(0, 2);
            // let second = searchValue.substring(2, 6);
            // let third = searchValue.substring(6);

            // const accountNumber = first + "-" + second + "-" + third;

            $('#loadingOverlay').fadeIn(200);

            $.ajax({
                url: 'functions/search.php',
                method: 'POST',
                data: { member_data: searchValue },
                success: function (response) {

                    $('#searchResults').html(response);

                    if ($.fn.DataTable.isDataTable('#searchTable')) {
                        $('#searchTable').DataTable().destroy();
                    }

                    $('#searchTable').DataTable({
                        responsive: true,
                        paging: true,
                        searching: true,
                        ordering: true,
                        lengthMenu: [5, 10, 25, 50],
                        pageLength: 10
                    });
                },
                error: function () {
                    alert('An error occurred while fetching data.');
                },
                complete: function () {
                    $('#loadingOverlay').fadeOut(200);
                }
            });
        });
    });

</script>
