<?php
include_once __DIR__ . '../../../vendor/autoload.php';
use App\Controllers\MembersController;
$pagetitle = 'Dashboard';
include_once __DIR__ . '../../layouts/header.php';
$currentPage = 'Members';

$members = (new MembersController)->getAllMembers();
?>

<!-- ✅ Fullscreen Loader Overlay -->
<div id="loaderOverlay">
    <dotlottie-player id="loadGif" src="https://lottie.host/5d12e74c-1f1f-4d67-9c84-5c294fdcb885/BRVkcbZ71H.lottie"
        speed="1" style="width: 300px; height: 300px" loop autoplay>
    </dotlottie-player>
</div>

<!-- ✅ Page Content (Initially Hidden) -->
<div id="pageContent" style="display: none;">

    <div class="app-container">
        <!-- Top Panel -->
        <div id="topPanel">
            <span>AGMA Management App</span>
            <div class="dropdown">
                <i class="fa-solid fa-gear" id="gearIcon"></i>
                <div class="dropdown-menu">
                    <a href="#">Settings</a>
                    <a href="#">Profile</a>
                    <a href="#">Logout</a>
                </div>
            </div>
        </div>

        <!-- Main Layout (Sidebar + Content) -->
        <div class="layout" style="background-color: #F5F5F5;">
            <?php include_once __DIR__ . '../../components/menu/sidebar.php'; ?>
            <div class="content">
                <h3>Members</h3>
                <hr style="margin-bottom: 2rem; border-color: #e2e8f0;">
                <table id="table" class="table table-bordered table-striped display mt-2 hover">
                    <thead>
                        <tr>
                            <th scope="col" style="border: 1px solid #A9A9A9;">Member name</th>
                            <th scope="col" style="text-align: center; border: 1px solid #A9A9A9;">Membership type</th>
                            <th scope="col" style="text-align: center; border: 1px solid #A9A9A9;">Member OR #</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($members)): ?>
                            <?php foreach ($members as $contract): ?>
                                <tr>
                                    <td><?= htmlspecialchars($contract['member_name'] ?? '') ?></td>
                                    <td><?= htmlspecialchars($contract['membership_type'] ?? '') ?></td>
                                    <td><?= htmlspecialchars($contract['member_or'] ?? '') ?></td>
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

<?php include_once __DIR__ . '../../layouts/footer.php'; ?>

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
</style>

<!-- ✅ Scripts -->
<script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
<script>
    window.onload = function () {
        // Hide the loading overlay
        document.getElementById("loaderOverlay").style.display = "none";

        // Show the main content
        document.getElementById("pageContent").style.display = "block";
    };
</script>