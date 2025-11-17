<?php
use App\Controllers\MembersController;
use App\Controllers\AttendeesController;

include_once __DIR__ . '../../../vendor/autoload.php';
$pagetitle = 'Dashboard';
include_once __DIR__ . '../../layouts/header.php';
$currentPage = 'Dashboard';

$userid = $_SESSION['data']['id'];

?>

<div class="app-container">

    <!-- Top Panel -->
    <?php include_once __DIR__ . '/../components/top_panel.php'; ?>


    <!-- Main Layout (Sidebar + Content) -->
    <div class="layout" style="background-color: #F5F5F5;">

        <?php include_once __DIR__ . '../../components/menu/sidebar.php'; ?>

        <div class="content">
            <h3>Dashboard</h3>
            <hr style="margin-bottom: 2rem; border-color: #e2e8f0;">

            <div class="card-grid">
                <a href="membership.php">
                    <div class="card mint-green cardDash" id="totalMembers">
                        <?php
                        $totalMembers = (new MembersController)->countAllMembers();
                        ?>
                        <h4 style="color:#334443;">Total Members</h4>
                        <i class="fa fa-users" aria-hidden="true"></i>

                        <h1 style="text-align:center;"><?= $totalMembers ?></h1>
                    </div>
                </a>
                <div class="card baby-blue cardDash" id="newMembers">
                    <?php
                        $totalAttendees = (new AttendeesController)->getAllTheAttendees();
                    ?>
                    <h4 style="color:#334443;">Attendees</h4>
                    <i class="fa fa-users" aria-hidden="true"></i>
                     <h1 style="text-align:center;"><?= $totalAttendees ?></h1>
                </div>

                <!-- <div class="card red-bloom cardDash">
                    <h5>Disconnected Accounts</h5>
                    <p>3</p>
                </div> -->
            </div>
        </div>
    </div>

</div>

<?php include_once __DIR__ . '../../layouts/footer.php'; ?>