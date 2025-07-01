<?php

use App\Controllers\MembersController;
$pagetitle = 'Registration';
require_once __DIR__ . '/views/layouts/header.php';
include_once __DIR__ . '/vendor/autoload.php';
?>

<div class="container" style="border-radius:10px;">
    <div>
        <h2 >Registration</h2>
        <hr>
    </div>

    <div id="rubyText">
        <?php 
            $member_data = $_POST['member_data'] ?? '';
        ?>
        <h5 class="text-muted">Find your account</h5>
        <form action="registration.php" method="post">
            <div class="search-wrapper">
                <input id="search" type="text" name="member_data"value="<?= $member_data ?>"
                    placeholder="search your Account Number, Meter Number or Fullname" required>
                <button type="submit">
                    <i class="fa fa-magnifying-glass"></i>
                </button>
            </div>
        </form>
        <label id="sample" class="badge mt-1" style="color: #758694 ;">Example : Account No. (11-1111-1111) / Meter No.
            (11-1111-1111)</label>
        <hr>
    </div>
    <div class="resultDiv">
        <?php
        $members = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST['member_data'];
            $members = (new MembersController)->searchMember($data);

            // var_dump($members);
        }
        ?>

        <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
            <?php if (!empty($members)): ?>
                <table id="table">
                    <thead>
                        <tr>
                            <th style="width:23em;">Member name</th>
                            <th>Account No.</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($members as $member): ?>
                            <tr>
                                <td>
                                    <?php 
                                        $routeCode = $member['TownCode'].$member['RouteCode'];
                                        $accountNo = $member['TownCode'].'-'. $routeCode.'-'.$member['AcctCode'];
                                        $address = $member['Address'];
                                    ?>
                                    <a href="#" class="passData"
                                        data-id="<?= $member['ConsumerID'] ?>"
                                        data-name="<?= $member['Name'] ?>"
                                        data-accountNum="<?= $accountNo ?>"
                                        data-address="<?= $address ?>"
                                        data-meterNumber="<?= $member['MeterSN'] ?>">
                                        <?= $member['Name'] ?>
                                    </a>
                                </td>
                                <td id="accountNo"><?= $member['TownCode'] ?>-<?= $member['TownCode'] ?><?= $member['RouteCode'] ?>-<?= $member['AcctCode'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <!-- ✅ No data found block -->
                <div id="emptyResult"
                    style="margin-bottom:5em;display: flex; flex-direction: column; align-items: center; justify-content: center; margin-top: 30px;">
                    <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs"
                        type="module"></script>

                    <dotlottie-player src="https://lottie.host/45b316dd-8e34-4b8d-a7e4-d8648190f9f1/Dy1SBBe7z1.lottie"
                        background="transparent" speed="1" style="width: 300px; height: 300px;" loop autoplay>
                    </dotlottie-player>

                    <h1 style="text-align: center;">No Data Found</h1>
                </div>

            <?php endif; ?>
        <?php endif; ?>


    </div>
</div>


<div id="customModal">
    <h3>Register</h3>
    <span id="close" class="float-end" onclick="closeDiv()"><i class="fa fa-close"></i></span>
    <hr>
    <input type="hidden" name="id" id="id" readonly>
    <div class="col-d-12 d-flex gap-3 mb-2">
        <div class="mb-2">
            <div class="mb-2">
                <label class="badge text-muted">Member Name</label>
                <input type="text" name="member_name" id="memberName" readonly>
            </div>
            <div class="mb-2">
                <label class="badge text-muted">Meter number</label>
                <input type="text" name="member_name" id="meterNumber" readonly>
            </div>
        </div>
        <div class="mb-2">
            <div class="mb-2">
                <label class="badge text-muted">Account number</label>
                <input type="text" name="accountNumber" id="accountNumber" readonly>
            </div>
            <div class="mb-2">
                <label class="badge text-muted">Address</label>
                <input type="text" name="Address" id="address" readonly>
            </div>
        </div>
    </div>
    <hr>
    <h5>Contact Information</h5>
    <div class="col-d-12 d-flex gap-3 mt-2">
        
        <div class="mb-2">
            <div class="mb-2">
                <label class="badge text-muted">Member Name</label>
                <input type="text" name="member_name" id="memberName" readonly>
            </div>
            <div class="mb-2">
                <label class="badge text-muted">Meter number</label>
                <input type="text" name="member_name" id="meterNumber" readonly>
            </div>
        </div>
        <div class="mb-2">
            <div class="mb-2">
                <label class="badge text-muted">Account number</label>
                <input type="text" name="accountNumber" id="accountNumber" readonly>
            </div>
            <div class="mb-2">
                <label class="badge text-muted">Address</label>
                <input type="text" name="Address" id="address" readonly>
            </div>
        </div>
    </div>

</div>


<?php
require_once __DIR__ . '/views/layouts/footer.php';
?>
<script>
    function showModal() {

        var modal = document.getElementById('customModal');

        if (modal.style.display === "block") {
            modal.style.display = "none";
        } else {
            modal.style.display = "block";
        }

    }

function closeDiv() {
    var modal = document.getElementById('customModal');

    // Toggle visibility
    if (modal.style.display === "none" || modal.style.display === "") {
        modal.style.display = "block";

        // Escape key listener
        document.addEventListener('keydown', escHandler);

        // Outside click listener
        document.addEventListener('click', outsideClickHandler);
    } else {
        modal.style.display = "none";

        // Remove listeners when hidden
        document.removeEventListener('keydown', escHandler);
        document.removeEventListener('click', outsideClickHandler);
    }

    // Handler to close on Escape key
    function escHandler(e) {
        if (e.key === "Escape") {
            modal.style.display = "none";
            document.removeEventListener('keydown', escHandler);
            document.removeEventListener('click', outsideClickHandler);
        }
    }

    // Handler to close on outside click
    function outsideClickHandler(e) {
        if (!modal.contains(e.target)) {
            modal.style.display = "none";
            document.removeEventListener('keydown', escHandler);
            document.removeEventListener('click', outsideClickHandler);
        }
    }
}



   document.addEventListener('DOMContentLoaded', function () {
    const buttons = document.querySelectorAll('.passData');

    const inputId = document.getElementById('id');
    const memberName = document.getElementById('memberName');
    const accountNo = document.getElementById('accountNumber');
    const meterno =  document.getElementById('meterNumber');
    const consumer_address = document.getElementById('address');

    // You can add more fields here as needed
    // Example:
    // const memberOr = document.getElementById('memberOr');
    // const town = document.getElementById('town');

    buttons.forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault(); // prevent default anchor behavior

            inputId.value = this.dataset.id;
            memberName.value = this.dataset.name;
            accountNo.value = this.dataset.accountnum;
            meterno.value = this.dataset.meternumber;
            consumer_address.value = this.dataset.address;

            // Show the modal
            showModal();
        });
    });
});



</script>

<style>

    #customModal {
        display: none;
        background-color: #ffffff;
        margin: auto;
        position: relative;
        width: 35%;
        top: -15em;
        padding: 20px;
        border-radius: 10px;
        box-shadow: #000000db 20px 20px 20px 60em;
    }

    #close {
        position: relative;
        top: -40px;
        margin-bottom: 5px;

    }

    #close:hover {
        cursor: pointer;
    }

    a {
        text-decoration: none;
    }
    
    #memberName,#accountNumber,#meterNumber,#membershipType
    ,#address{
        box-shadow: inset #abacaf 0 0 0 2px;
        border: 0;
        background: rgba(0, 0, 0, 0);
        appearance: none;
        width: 100%;
        position: relative;
        border-radius: 3px;
        padding: 9px 12px;
        line-height: 1.4;
        color: rgb(0, 0, 0);
        font-size: 16px;
        font-weight: 400;
        height: 40px;
        transition: all .2s ease;
        }
    /* #memberName,#accountNumber:hover{
        box-shadow: 0 0 0 0 #fff inset, #171986 0 0 0 2px;
        }
    #memberName, #accountNumber:focus{
        background: #fff;
        outline: 0;
        box-shadow: 0 0 0 0 #fff inset, #171986 0 0 0 3px;
        } */
                

    @media (max-width: 430px) {
        h2 {
            font-size: 1.5rem;
            text-align: center;
        }

        #rubyText h5 {
            text-align: left;
        }

        #search {
            font-size: 12px;
            font-style: italic;
        }

        /* th,
        td {
            font-size: 0.55rem;

        } */

        table {
        table-layout: auto;
        width: 100%;
    }

    th, td {
        word-wrap: break-word;
        white-space: normal;
        font-size: 0.8rem;
        width:35em;
    }

        th {
            /* width: 2.00rem; */
            text-align: left;
            
        }

        a {
            font-size: 0.75rem;
            text-decoration: none;
        }

        table {
            width: 100%;
        }

        #sample {
            font-size: 0.50rem;
        }

        #accountNo {
            font-size: 0.90rem;
        }
        #customModal {
        width: 90%; /* or 95% or even 100% if needed */
        top: -15em; /* adjust as needed to avoid vertical clipping */
    }
     #customModal .d-flex {
        flex-direction: column;
    }
    }
</style>