<?php
$pagetitle = 'Dashboard';
include_once __DIR__ . '../../layouts/header.php';
$currentPage = 'Dashboard';
?>



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
            <h3>Dashboard</h3>
            <hr style="margin-bottom: 2rem; border-color: #e2e8f0;">

            <div class="card-grid">
                <a href="members.php">
                    <div class="card cardDash">
                        <h5>Total Members</h5>
                        <p>12</p>
                    </div>
                </a>
                <div class="card cardDash">
                    <h5>New Members</h5>
                    <p>5</p>
                </div>
                <div class="card cardDash">
                    <h5>Disconnected Accounts</h5>
                    <p>3</p>
                </div>
            </div>
        </div>
    </div>

</div>

<?php include_once __DIR__ . '../../layouts/footer.php'; ?>