<?php
use App\Controllers\MembersController;
use App\Controllers\AttendeesController;
use App\Controllers\AreaController;

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

            <div class="card-grid mb-4">
                <a href="membership.php">
                    <div class="card mint-green cardDash" id="totalMembers">
                        <?php
                        $totalMembers = (new MembersController)->countAllMembers();
                        ?>
                        <h4 style="color:#334443;">Total Members</h4>
                        <i class="fa fa-users" aria-hidden="true"></i>

                        <h1 style="text-align:center;color:black;"><?= $totalMembers ?></h1>
                    </div>
                </a>
                <div class="card baby-blue cardDash" id="newMembers">
                    <?php
                        $totalAttendees = (new AttendeesController)->getAllTheAttendees();
                    ?>
                    <h4 style="color:#334443;">Attendees</h4>
                    <i class="fa fa-users" aria-hidden="true"></i>
                     <h1 style="text-align:center;color:black;"><?= $totalAttendees ?></h1>
                </div>

                <!-- <div class="card red-bloom cardDash">
                    <h5>Disconnected Accounts</h5>
                    <p>3</p>
                </div> -->
            </div>
<hr>
<h3>Panian Area Office</h3>
            <div class="card-grid mb-4">
                <a href="">
                    <div class="card mint-green cardDash" id="totalMembers">
                        <?php
                        $estanciaCount = (new AreaController)->getEstanciaCount();
                        ?>
                        <h4 style="color:#334443;">Estancia</h4>
                        <i class="fa fa-users" aria-hidden="true"></i>

                        <h1 style="text-align:center; color:black;" id="estanciaCount"><?= $estanciaCount ?></h1>
                    </div>
                </a>
                <div class="card baby-blue cardDash" id="newMembers">
                     <?php
                        $balasanCount = (new AreaController)->getBalasanCount();
                        ?>
                    <h4 style="color:#334443;">Balasan</h4>
                    <i class="fa fa-users" aria-hidden="true"></i>
                    <h1 style="text-align:center;color:black;" id="balasanCount"><?= $balasanCount ?></h1>
                </div>
                <div class="card baby-blue cardDash" id="newMembers">
                    <?php
                        $totalAttendees = (new AttendeesController)->getAllTheAttendees();
                    ?>
                    <h4 style="color:#334443;">Batad</h4>
                    <i class="fa fa-users" aria-hidden="true"></i>
                     <h1 style="text-align:center;color:black;" id="batadCount"><?= $batadCount ?></h1>
                </div>
                <div class="card baby-blue cardDash" id="newMembers">
                    <?php
                        $totalAttendees = (new AttendeesController)->getAllTheAttendees();
                    ?>
                    <h4 style="color:#334443;">Carles</h4>
                    <i class="fa fa-users" aria-hidden="true"></i>
                     <h1 style="text-align:center;color:black;" id="carlesCount"><?= $carlesCount ?></h1>
                </div>
                 <div class="card baby-blue cardDash" id="newMembers">
                    <?php
                        $totalAttendees = (new AttendeesController)->getAllTheAttendees();
                    ?>
                    <h4 style="color:#334443;">Gigantes</h4>
                    <i class="fa fa-users" aria-hidden="true"></i>
                     <h1 style="text-align:center;color:black;" id="gigantesCount"><?= $gigantesCount ?></h1>
                </div>
                <!-- <div class="card red-bloom cardDash">
                    <h5>Disconnected Accounts</h5>
                    <p>3</p>
                </div> -->
            </div>
<hr>


    <h3>Sara Area Office</h3>
            <div class="card-grid mb-4">
                <a href="">
                    <div class="card mint-green cardDash" id="totalMembers">
                        <?php
                        $totalMembers = (new MembersController)->countAllMembers();
                        ?>
                        <h4 style="color:#334443;">Sara</h4>
                        <i class="fa fa-users" aria-hidden="true"></i>

                        <h1 style="text-align:center;color:black;" id="saraCount"><?= $totalMembers ?></h1>
                    </div>
                </a>
                 <div class="card baby-blue cardDash" id="newMembers">
                    <?php
                       
                    ?>
                    <h4 style="color:#334443;">Ajuy</h4>
                    <i class="fa fa-users" aria-hidden="true"></i>
                     <h1 style="text-align:center;color:black;" id="ajuyCount"><?= $totalAttendees ?></h1>
                </div>
                <div class="card baby-blue cardDash" id="newMembers">
                    <?php
                        $totalAttendees = (new AttendeesController)->getAllTheAttendees();
                    ?>
                    <h4 style="color:#334443;">San Dionisio</h4>
                    <i class="fa fa-users" aria-hidden="true"></i>
                     <h1 style="text-align:center;color:black;" id="sanDionisioCount"><?= $totalAttendees ?></h1>
                </div>
                
                  <div class="card baby-blue cardDash" id="newMembers">
                    <?php
                        $totalAttendees = (new AttendeesController)->getAllTheAttendees();
                    ?>
                    <h4 style="color:#334443;">Lemery</h4>
                    <i class="fa fa-users" aria-hidden="true"></i>
                     <h1 style="text-align:center;color:black;" id="lemeryCount"><?= $totalAttendees ?></h1>
                </div>
                 <div class="card baby-blue cardDash" id="newMembers">
                    <?php
                        $totalAttendees = (new AttendeesController)->getAllTheAttendees();
                    ?>
                    <h4 style="color:#334443;">Concepcion</h4>
                    <i class="fa fa-users" aria-hidden="true"></i>
                     <h1 style="text-align:center;color:black;" id="concepcionCount"><?= $totalAttendees ?></h1>
                </div>
                <!-- <div class="card red-bloom cardDash">
                    <h5>Disconnected Accounts</h5>
                    <p>3</p>
                </div> -->
            </div>
            <hr>
            <h3>Natividad Area Office</h3>
            <div class="card-grid">
                <a href="">
                    <div class="card mint-green cardDash" id="totalMembers">
                        <?php
                        $totalMembers = (new MembersController)->countAllMembers();
                        ?>
                        <h4 style="color:#334443;">Barotac Viejo</h4>
                        <i class="fa fa-users" aria-hidden="true"></i>

                        <h1 style="text-align:center;color:black;" id="barotacViejoCount"><?= $barotacViejoCount ?></h1>
                    </div>
                </a>
                <div class="card baby-blue cardDash" id="newMembers">
                    <?php
                        $totalAttendees = (new AttendeesController)->getAllTheAttendees();
                    ?>
                    <h4 style="color:#334443;">Banate</h4>
                    <i class="fa fa-users" aria-hidden="true"></i>
                     <h1 style="text-align:center;color:black;" id="banateCount"><?= $banateCount ?></h1>
                </div>
                <div class="card baby-blue cardDash" id="newMembers">
                    <?php
                        $totalAttendees = (new AttendeesController)->getAllTheAttendees();
                    ?>
                    <h4 style="color:#334443;">San Rafael</h4>
                    <i class="fa fa-users" aria-hidden="true"></i>
                     <h1 style="text-align:center;color:black;" id="sanRafaelCount"><?= $totalAttendees ?></h1>
                </div>
               
                  <div class="card baby-blue cardDash" id="newMembers">
                    <?php
                        $totalAttendees = (new AttendeesController)->getAllTheAttendees();
                    ?>
                    <h4 style="color:#334443;">Anilao</h4>
                    <i class="fa fa-users" aria-hidden="true"></i>
                     <h1 style="text-align:center;color:black;" id="anilaoCount"><?= $anilaoCount ?></h1>
                </div>
                <!-- <div class="card red-bloom cardDash">
                    <h5>Disconnected Accounts</h5>
                    <p>3</p>
                </div> -->
            </div>
        </div>
    </div>

</div>


<script>
    function loadDashboardData() {
        $.ajax({
            url: "live_data.php",
            type: "GET",
            dataType: "json",
            success: function(data) {
                $("#totalMembersCount").text(data.totalMembers);
                $("#totalAttendeesCount").text(data.totalAttendees);
                $("#estanciaCount").text(data.estancia);
                $("#balasanCount").text(data.balasan);
                $("#batadCount").text(data.batad);
                $("#carlesCount").text(data.carles);
                $("#saraCount").text(data.sara);
                $("#sanDionisioCount").text(data.sanDionisio);
                $("#sanRafaelCount").text(data.sanRafael);
                $("#lemeryCount").text(data.lemery);
                $("#concepcionCount").text(data.concepcion);
                $("#gigantesCount").text(data.gigantes);
                $("#ajuyCount").text(data.ajuy);
                $("#banateCount").text(data.banate);
                $("#barotacViejoCount").text(data.barotacViejo);
                $("#anilaoCount").text(data.anilao);
            }
        });
    }

    // Refresh every 2 seconds
    setInterval(loadDashboardData, 2000);

    // Load immediately
    loadDashboardData();

</script>


<?php include_once __DIR__ . '../../layouts/footer.php'; ?>