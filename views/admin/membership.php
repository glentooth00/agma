<?php
include_once __DIR__ . '../../../vendor/autoload.php';
use App\Controllers\MembersController;

$pagetitle = 'Members';
include_once __DIR__ . '../../layouts/header.php';

$currentPage = 'Membership';
$members = (new MembersController)->getAllMembers();
$userid = $_SESSION['data']['id'];
?>


<div class="offcanvas offcanvas-start" style="width: 1000px;" tabindex="-1" id="offcanvasExample"
    aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
        <h4 class="offcanvas-title" id="offcanvasExampleLabel">Member Details</h4>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <hr>
    <div class="offcanvas-body">
        <div class="mb-3">
            <label class="form-label"><strong>Member Name:</strong></label>
            <p id="offcanvasName"></p>
        </div>
        <div class="mb-3">
            <label class="form-label"><strong>Account Number:</strong></label>
            <p id="offcanvasAccount"></p>
        </div>
        <div class="mb-3">
            <label class="form-label"><strong>Address:</strong></label>
            <p id="offcanvasAddress"></p>
        </div>
        <div class="mb-3">
            <label class="form-label"><strong>Member OR:</strong></label>
            <p id="offcanvasOR"></p>
        </div>
    </div>
    <div class="d-flex p-3 float-end">
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
                <hr style="margin-bottom: 2rem; border-color: #e2e8f0;">

                <div id="searchArea">
                    <form action="functions/search.php" method="post" class="search-form">
                        <label for="searchInput" class="search-label">Search:</label>
                        <div class="search-wrapper">
                            <input type="text" name="member_data" id="searchInput"
                                placeholder="Search member Account number, Name, Meter number">
                            <i class="fa fa-search"></i>
                        </div>
                    </form>
                </div>

                <div id="resultDiv">

                </div>

            </div>
        </div>
    </div>
</div>

<?php include_once '../layouts/footer.php'; ?>





<!-- user data modal ---->

<!-- ✅ Font Awesome CDN (only include once in the layout if not yet included) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
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
</style>
<script>
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

                // Destroy old DataTable instance if any
                if ($.fn.DataTable.isDataTable('#searchTable')) {
                    $('#searchTable').DataTable().destroy();
                }

                // Initialize new DataTable
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
                document.getElementById('resultDiv').innerHTML = '<p style="color:red;">Search failed. Please try again.</p>';
                console.error(error);
            });
    });


    //pass to pffcanva

    document.addEventListener('DOMContentLoaded', function () {
        const offcanvasEl = document.getElementById('offcanvasExample');

        offcanvasEl.addEventListener('show.bs.offcanvas', function (event) {
            const button = event.relatedTarget;

            document.getElementById('offcanvasName').innerText = button.getAttribute('data-name') || '';
            document.getElementById('offcanvasAccount').innerText = button.getAttribute('data-account') || '';
            document.getElementById('offcanvasAddress').innerText = button.getAttribute('data-address') || '';
            document.getElementById('offcanvasOR').innerText = button.getAttribute('data-or') || '';
        });
    });


</script>