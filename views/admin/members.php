<?php
include_once __DIR__ . '../../../vendor/autoload.php';
use App\Controllers\MembersController;
$pagetitle = 'Dashboard';
include_once __DIR__ . '../../layouts/header.php';

$currentPage = 'Members';

$members = (new MembersController)->getAllMembers();

$userid = $_SESSION['data']['id'];
?>
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
    box-shadow: 0 0 10px rgba(0,0,0,0.2);
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



<div id="loaderOverlay">
    <dotlottie-player id="loadGif" src="https://lottie.host/5d12e74c-1f1f-4d67-9c84-5c294fdcb885/BRVkcbZ71H.lottie"
        speed="1" style="width: 300px; height: 300px" loop autoplay>
    </dotlottie-player>
</div>

<div id="pageContent" style="display: none;">

    <div class="app-container">

        <?php include_once __DIR__ . '/../components/top_panel.php'; ?>

        <div class="layout" style="background-color: #F5F5F5;">
            <?php include_once __DIR__ . '../../components/menu/sidebar.php'; ?>
            <div class="content">
                <h3>Members</h3>
                <hr style="margin-bottom: 2rem; border-color: #e2e8f0;">
                <table id="table" class="table table-bordered table-striped display mt-2 hover">
                    <thead>
                        <tr>
                            <th scope="col" style="border: 1px solid #A9A9A9;">Member name</th>
                            <th scope="col" style="text-align: center; border: 1px solid #A9A9A9;">Account No.</th>
                            <th scope="col" style="text-align: center; border: 1px solid #A9A9A9;">Membership type</th>
                            <th scope="col" style="text-align: center; border: 1px solid #A9A9A9;">Member OR #</th>
                            <th style="width:2em;text-align: center; border: 1px solid #A9A9A9;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($members)): ?>
                            <?php foreach ($members as $member): ?>
                                <tr>
                                    <td><?= htmlspecialchars($member['member_name'] ?? '') ?></td>
                                    <td id="tdData"><?= htmlspecialchars($member['account_no'] ?? '') ?></td>
                                    <td id="tdData"><?= htmlspecialchars($member['membership_type'] ?? '') ?></td>
                                    <td id="tdData"><?= htmlspecialchars($member['member_or'] ?? '') ?></td>
                                    <td id="tdData">
                                        <div class="gap-3" style="display: flex; align-items: center; justify-content: center;">
                                            <div>
                                                <button id="btn">View</button>
                                            </div>
                                            <div>
                                                <button data-id="<?= $member['id'] ?>" id="deletebtn"
                                                    onclick="deletePopup(this)">Delete</button>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center">No contracts found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>


<!-- popup notification ---->

<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
    <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
        <path
            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
    </symbol>
    <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
        <path
            d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
    </symbol>
    <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
        <path
            d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
    </symbol>
</svg>


<?php if (isset($_SESSION['notification'])): ?>
    <div id="notification"
        class="alert <?php echo ($_SESSION['notification']['type'] == 'success') ? 'alert-success border-success' : ($_SESSION['notification']['type'] == 'warning' ? 'alert-warning border-warning' : 'alert-danger border-danger'); ?> d-flex align-items-center float-end alert-dismissible fade show"
        role="alert" style="position: fixed; bottom: 1.5em; right: 1em; z-index: 1000;">
        <!-- Icon -->
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img"
            aria-label="<?php echo ($_SESSION['notification']['type'] == 'success') ? 'Success' : ($_SESSION['notification']['type'] == 'warning' ? 'Warning' : 'Error'); ?>:">
            <use
                xlink:href="<?php echo ($_SESSION['notification']['type'] == 'success') ? '#check-circle-fill' : ($_SESSION['notification']['type'] == 'warning' ? '#exclamation-triangle-fill' : '#exclamation-circle-fill'); ?>" />
        </svg>
        <!-- Message -->
        <div>
            <?php echo $_SESSION['notification']['message']; ?>
        </div>
        <!-- Close Button -->
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php unset($_SESSION['notification']); // Clear notification after displaying ?>

    <script>
        // Automatically fade the notification out after 6 seconds
        setTimeout(function () {
            let notification = document.getElementById('notification');
            if (notification) {
                notification.classList.remove('show');
                notification.classList.add('fade');
                notification.style.transition = 'opacity 1s ease';
            }
        }, 7000); // 6 seconds
    </script>
<?php endif; ?>


<?php include_once '../layouts/footer.php'; ?>

<!-- ✅ Loader Styles -->
<style>
    #loaderOverlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background-color: rgba(0, 0, 0, 0.5);
        /* Dimmed background */
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
    }

    #tdData {
        text-align: center;
    }

    #btn {
        margin-right: 1em;
        display: inline-block;
        outline: 0;
        appearance: none;
        padding: 0px 12px;
        border: 0px solid transparent;
        border-radius: 4px;
        text-decoration: none;
        cursor: pointer;
        background-color: rgb(9, 128, 76);
        box-shadow: rgb(19 170 82 / 40%) 0px 2px 3px;
        color: rgb(255, 255, 255);
        font-size: 14px;
        font-weight: 400;
        height: 36px;
        transition: all 150ms ease-in-out 0s;
    }

    #btn:hover {
        color: rgb(255, 255, 255);
        background-color: rgb(17, 97, 73);
        box-shadow: rgb(19 170 82 / 40%) 0px 2px 3px, rgb(195 231 202) 0px 0px 0px 3px;
    }

    #deletebtn {
        display: inline-block;
        outline: 0;
        appearance: none;
        padding: 0px 12px;
        border: 0px solid transparent;
        border-radius: 4px;
        text-decoration: none;
        cursor: pointer;
        background-color: rgb(180 84 84);
        box-shadow: rgb(19 170 82 / 40%) 0px 2px 3px;
        color: rgb(255, 255, 255);
        font-size: 14px;
        font-weight: 400;
        height: 36px;
        transition: all 150ms ease-in-out 0s;
    }

    #deletebtn:hover {
        color: rgb(255, 255, 255);
        background-color: rgb(228 32 32);
        box-shadow: rgb(19 170 82 / 40%) 0px 2px 3px, rgb(195 231 202) 0px 0px 0px 3px;
    }

    #deletePopup {
        /* display: block; */
        background-color: #fffdfd;
        ;
        width: 25em;
        margin: 0 auto;
        text-align: center;
        box-shadow: rgba(0, 0, 0, 0.56) 0px 22px 70px 100em;
    }

    #deleteTitle {
        text-align: left;
    }

    #cancel {
        display: inline-block;
        outline: none;
        cursor: pointer;
        font-size: 16px;
        line-height: 20px;
        font-weight: 600;
        border-radius: 8px;
        padding: 13px 23px;
        border: 1px solid #222222;
        transition: box-shadow 0.2s ease 0s, -ms-transform 0.1s ease 0s, -webkit-transform 0.1s ease 0s, transform 0.1s ease 0s;
        background: #fff;
        color: #222222;
    }

    #cancel:hover {
        border-color: #000000;
        background: #f7f7f7;
    }

    #delete {
        width: 9em;
        display: inline-block;
        outline: none;
        cursor: pointer;
        font-size: 16px;
        line-height: 20px;
        font-weight: 600;
        border-radius: 8px;
        padding: 14px 24px;
        border: none;
        transition: box-shadow 0.2s ease 0s, -ms-transform 0.1s ease 0s, -webkit-transform 0.1s ease 0s, transform 0.1s ease 0s;
        background: linear-gradient(to right, rgb(230, 30, 77) 0%, rgb(227, 28, 95) 50%, rgb(215, 4, 102) 100%);
        color: #fff;
    }
</style>

<!-- ✅ Scripts -->
<script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
<script>
    function cancelDelete() {
        document.getElementById('deletePopup').style.display = 'none';
    }

    // Handle AJAX form submission
    $(document).ready(function () {
        $('#deleteForm').on('submit', function (e) {
            e.preventDefault();
            const id = $('#deleteIdValue').val();

            $.ajax({
                url: 'functions/delete.php',
                type: 'POST',
                data: { id: id },
                success: function (response) {
                    $('#deletePopup').hide();
                    location.reload(); // or remove the item from DOM
                },
                error: function () {
                    alert('Failed to delete.');
                }
            });
        });
    });

</script>