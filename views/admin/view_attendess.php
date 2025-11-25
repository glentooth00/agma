<?php
use App\Controllers\MembersController;
use App\Controllers\AttendeesController;

include_once __DIR__ . '../../../vendor/autoload.php';
$pagetitle = 'Users';
include_once __DIR__ . '../../layouts/header.php';
$currentPage = 'Users';

$userid = $_SESSION['data']['id'];

?>

<div class="app-container">

    <!-- Top Panel -->
    <?php include_once __DIR__ . '/../components/top_panel.php'; ?>


    <!-- Main Layout (Sidebar + Content) -->
    <div class="layout" style="background-color: #F5F5F5;">

        <?php include_once __DIR__ . '../../components/menu/sidebar.php'; ?>

        <div class="content">
            <h3>Users</h3>
            <hr style="margin-bottom: 2rem; border-color: #BCC0C6FF;">

            <div class="card-grid">
               
            </div>
        </div>
    </div>

</div>

<?php include_once __DIR__ . '../../layouts/footer.php'; ?>