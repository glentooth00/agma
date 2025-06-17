<?php
$pagetitle = 'Dashboard';
include_once __DIR__ . '../../layouts/header.php';
$currentPage = 'Dashboard';


?>

<div class="col-md-12 d-flex gap-2">

    <div class="col-md-2">
        <?php include_once __DIR__ . '../../components/menu/sidebar.php'; ?>
    </div>

    <div class="col-md-10 bg-white p-5">
        <h1>Dashboard</h1>
        <hr>

    </div>



</div>

<?php
include_once __DIR__ . '../../layouts/footer.php';
?>