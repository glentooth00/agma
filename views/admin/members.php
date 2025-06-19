<?php
include_once __DIR__ . '../../../vendor/autoload.php';
use App\Controllers\MembersController;
$pagetitle = 'Dashboard';
include_once __DIR__ . '../../layouts/header.php';
$currentPage = 'Members';

$members = (new MembersController)->getAllMembers();


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
            <h3>Members</h3>
            <hr style="margin-bottom: 2rem; border-color: #e2e8f0;">

            <table id="table" class="table table-bordered table-striped display mt-2 hover">
                <thead>
                    <tr>
                        <th scope="col" style="border: 1px solid #A9A9A9;">Member name</span></th>
                        <th scope="col" style="text-align: center; border: 1px solid #A9A9A9;">Membership type</th>
                        <th scope="col" style="text-align: center; border: 1px solid #A9A9A9;">Member OR #</th>
                        <!--<th scope="col" style="text-align: center; border: 1px solid #A9A9A9;">End</th>
                        <th scope="col" style="text-align: center; border: 1px solid #A9A9A9;">Status</th>
                        <th scope="col" style="text-align: center; border: 1px solid #A9A9A9;">Action</th> -->
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($members)): ?>
                        <?php foreach ($members as $contract): ?>
                            <tr>
                                <td>
                                    <?= htmlspecialchars($contract['member_name'] ?? '') ?>
                                </td>
                                <td>
                                    <?= htmlspecialchars($contract['membership_type'] ?? '') ?>
                                </td>
                                <td>
                                    <?= htmlspecialchars($contract['member_or'] ?? '') ?>
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

            <!-- <div class="card-grid">
                <div class="card cardDash">
                    <h5>Total Members</h5>
                    <p>12</p>
                </div>
                <div class="card cardDash">
                    <h5>Active Sessions</h5>
                    <p>5</p>
                </div>
                <div class="card cardDash">
                    <h5>Pending Tasks</h5>
                    <p>3</p>
                </div>
            </div> -->
        </div>
    </div>

</div>

<?php include_once __DIR__ . '../../layouts/footer.php'; ?>