<?php
use App\Controllers\AreaController;

include_once __DIR__ . '../../../vendor/autoload.php';
$pagetitle = 'Attendees';
include_once __DIR__ . '../../layouts/header.php';
$currentPage = 'Attendees';

$userid = $_SESSION['data']['id'];


$getAttendeesPerAreas = ( new AreaController )->getAttendees($userid);



?>

<div class="app-container">

    <!-- Top Panel -->
    <?php include_once __DIR__ . '/../components/top_panel.php'; ?>


    <!-- Main Layout (Sidebar + Content) -->
    <div class="layout" style="background-color: #F5F5F5;">

        <?php include_once __DIR__ . '../../components/menu/sidebar.php'; ?>

        <div class="content">
            <h3>Attendees</h3>
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