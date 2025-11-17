<?php
use App\Controllers\UsersController;

include_once __DIR__ . '../../../vendor/autoload.php';

include_once __DIR__ . '../../layouts/header.php';

$pagetitle = 'Users';

$currentPage = 'Users';

$userid = $_SESSION['data']['id'];


$users = (new UsersController)->fetchAllUsers();

?>

<?php include '../components/popup/deletepopup.php'; ?>


    <div class="app-container">

        <!-- Top Panel -->
        <?php include_once __DIR__ . '/../components/top_panel.php'; ?>


        <!-- Main Layout (Sidebar + Content) -->
        <div class="layout" style="background-color: #F5F5F5;">

            <?php include_once __DIR__ . '../../components/menu/sidebar.php'; ?>

        <div class="content">
            <h3>Users</h3>
            <hr style="margin-bottom: 2rem; border-color: #BCC0C6FF;">

            <div class="row">

                <!-- LEFT COLUMN (Form) -->
                <div class="col-md-3">
                    <div class="card card-grid-form p-3">
                        <h5 class="mb-3">Add user</h5>

                        <form action="functions/add_user.php" method="post">
                            <div class="mt-3">
                                <label class="form-label">Username</label>
                                <input type="text" class="inputs form-control" name="username" required>
                            </div>

                            <div class="mt-3">
                                <label class="form-label">Password</label>
                                <input type="password" class="inputs form-control" name="password" required>
                            </div>

                            <div class="mt-3">
                                <label class="form-label">Firstname</label>
                                <input type="text" class="inputs form-control" name="firstname" required>
                            </div>

                            <div class="mt-3">
                                <label class="form-label">Middlename</label>
                                <input type="text" class="inputs form-control" name="middlename" required>
                            </div>

                            <div class="mt-3">
                                <label class="form-label">Lastname</label>
                                <input type="text" class="inputs form-control" name="lastname" required>
                            </div>

                            <div class="mt-3 mb-3">
                                <label class="form-label">Role</label>
                                <select class="form-select inputs" name="role" required>
                                    <option value="admin">Admin</option>
                                    <option value="user">User</option>
                                    <option value="member">Member</option>
                                    <option value="attendee">Attendee</option>
                                </select>
                            </div>

                            <button type="submit" class="button-29">Add User</button>
                        </form>
                    </div>
                </div>

                <!-- RIGHT COLUMN (DataTable) -->
                <div class="col-md-9">
                    <div class="card p-3">
                        <h5 class="mb-3">Users List</h5>

                        <table id="table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Username</th>
                                    <th >Full Name</th>
                                    <th>Role</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($users as $i => $user): ?>
                                <tr>
                                    <td><?= $i+1 ?></td>
                                    <td><?= htmlspecialchars($user['username']) ?></td>
                                    <td colspan="1"><?= htmlspecialchars($user['firstname'] . ' ' . $user['middlename'] . ' ' . $user['lastname']) ?></td>
                                    <td><?= htmlspecialchars($user['role']) ?></td>
                                    <td style="text-align: center;">
                                        <button class="edit-button"><i class="fa fa-eye" aria-hidden="true"></i> View</button>
                                        <button class="delete-button btn-delete" data-userid="<?= $user['id'] ?>"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                    </div>
                </div>

            </div>
        </div>
    </div>


    <div id="sidePopup" class="hidden">
        <span id="popupMessage">Message here</span>
    </div>

</div>

<?php include_once __DIR__ . '../../layouts/footer.php'; ?>


<?php include '../components/popup/sidepopup.php'; ?>
