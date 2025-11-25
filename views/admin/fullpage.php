<?php
use App\Controllers\MembersController;
use App\Controllers\AttendeesController;
use App\Controllers\AreaController;
use App\Controllers\UsersController;

include_once __DIR__ . '../../../vendor/autoload.php';
$pagetitle = 'Dashboard';
include_once __DIR__ . '../../layouts/header.php';
$currentPage = 'Dashboard';

$userid = $_SESSION['data']['id'];

$getUserAreas = ( new UsersController )->getAreaListPerUser($userid);

?>
<?php foreach ($getUserAreas as $getUserArea) : ?>
<div class="app-container" id="test">

    <!-- Top Panel -->
    <?php include_once __DIR__ . '/../components/top_panel.php'; ?>

    <!-- Main Layout (Sidebar + Content) -->
    <div class="layout" style="background-color: #F5F5F5;">

        <div class="content">
            <div>
                <a href="index.php">
                    <div class="d-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-box-arrow-left text-secondary" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0z"/>
                            <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708z"/>
                        </svg>
                        <small class="text-secondary fw-bold"> Back</small> 
                    </div>
                </a>
                <a href="#" onclick="event.preventDefault(); openFullscreen();">
                <div class="d-inline-block float-end">
                    <small class="text-secondary"> Enter Fullscreen</small>  
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-fullscreen text-secondary" viewBox="0 0 16 16">
                    <path d="M1.5 1a.5.5 0 0 0-.5.5v4a.5.5 0 0 1-1 0v-4A1.5 1.5 0 0 1 1.5 0h4a.5.5 0 0 1 0 1zM10 .5a.5.5 0 0 1 .5-.5h4A1.5 1.5 0 0 1 16 1.5v4a.5.5 0 0 1-1 0v-4a.5.5 0 0 0-.5-.5h-4a.5.5 0 0 1-.5-.5M.5 10a.5.5 0 0 1 .5.5v4a.5.5 0 0 0 .5.5h4a.5.5 0 0 1 0 1h-4A1.5 1.5 0 0 1 0 14.5v-4a.5.5 0 0 1 .5-.5m15 0a.5.5 0 0 1 .5.5v4a1.5 1.5 0 0 1-1.5 1.5h-4a.5.5 0 0 1 0-1h4a.5.5 0 0 0 .5-.5v-4a.5.5 0 0 1 .5-.5"/>
                    </svg>
                </div>
                </a>

            </div>
            
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
            </div>
            <hr>


            <?php if($getUserArea['area_name'] === 'SAO') : ?>
                <h3>Sara Area Office</h3>
                    <div class="card-grid mb-4">

                            <?php $townIds = is_array($getUserArea['town_ids'])
                                ? $getUserArea['town_ids']
                                : explode(',', $getUserArea['town_ids']); 
                            ?>
                            
                            <?php foreach ($townIds as $id) : ?>
                                <?php $id; ?>
                                
                                <div class="wrapper">
                                    
                                            <?php switch($id) {
                                        case "04":
                                                echo '<div class="card mint-green cardDash mb-3" id="totalMembers">
                                                <h4 style="color:#334443;">Sara</h4>
                                                <i class="fa fa-users" aria-hidden="true"></i>

                                                <h1 style="text-align:center;color:black;" id="saraCount"><?= $totalMembers ?></h1>
                                            </div>';
                                            break;
                                        case "13":
                                                echo '<div class="card mint-green cardDash" id="totalMembers">
                                                <h4 style="color:#334443;">Ajuy</h4>
                                                <i class="fa fa-users" aria-hidden="true"></i>

                                                <h1 style="text-align:center;color:black;" id="ajuyCount"><?= $totalMembers ?></h1>
                                            </div>';
                                            break;
                                        case "08":
                                                echo '<div class="card mint-green cardDash" id="totalMembers">
                                                <h4 style="color:#334443;">San Dionisio</h4>
                                                <i class="fa fa-users" aria-hidden="true"></i>

                                                <h1 style="text-align:center;color:black;" id="sanDionisioCount"><?= $totalMembers ?></h1>
                                            </div>';
                                            break;
                                        case "06":
                                                echo '<div class="card mint-green cardDash" id="totalMembers">
                                                <h4 style="color:#334443;">Lemery</h4>
                                                <i class="fa fa-users" aria-hidden="true"></i>

                                                <h1 style="text-align:center;color:black;" id="lemeryCount"><?= $totalMembers ?></h1>
                                            </div>';
                                            break;
                                        case "07":
                                                echo '<div class="card mint-green cardDash" id="totalMembers">
                                                <h4 style="color:#334443;">Concepcion</h4>
                                                <i class="fa fa-users" aria-hidden="true"></i>

                                                <h1 style="text-align:center;color:black;" id="concepcionCount"><?= $totalMembers ?></h1>
                                            </div>';
                                            break;
                                    }
                                ?> 
                                </div>

                            <?php endforeach; ?>
            <?php endif; ?>

            <?php if($getUserArea['area_name'] === 'PAO') : ?>
                <h3>Panian Area Office</h3>
            <div class="card-grid mb-4">
                            <?php $townIds = is_array($getUserArea['town_ids'])
                                ? $getUserArea['town_ids']
                                : explode(',', $getUserArea['town_ids']); 
                            ?>
                            
                            <?php foreach ($townIds as $id) : ?>
                                <?php $id; ?>
                                
                                <div class="wrapper">
                                    
                                            <?php switch($id) {
                                        case "10":
                                                echo '<div class="card mint-green cardDash mb-3" id="totalMembers">
                                                <h4 style="color:#334443;">Estancia</h4>
                                                <i class="fa fa-users" aria-hidden="true"></i>

                                                <h1 style="text-align:center;color:black;" id="estanciaCount"><?= $totalMembers ?></h1>
                                            </div>';
                                            break;
                                        case "11":
                                                echo '<div class="card mint-green cardDash" id="totalMembers">
                                                <h4 style="color:#334443;">Balasan</h4>
                                                <i class="fa fa-users" aria-hidden="true"></i>

                                                <h1 style="text-align:center;color:black;" id="balasanCount"><?= $totalMembers ?></h1>
                                            </div>';
                                            break;
                                        case "12":
                                                echo '<div class="card mint-green cardDash" id="totalMembers">
                                                <h4 style="color:#334443;">Carles</h4>
                                                <i class="fa fa-users" aria-hidden="true"></i>

                                                <h1 style="text-align:center;color:black;" id="carlesCount"><?= $totalMembers ?></h1>
                                            </div>';
                                            break;
                                        case "09":
                                                echo '<div class="card mint-green cardDash" id="totalMembers">
                                                <h4 style="color:#334443;">Batad</h4>
                                                <i class="fa fa-users" aria-hidden="true"></i>

                                                <h1 style="text-align:center;color:black;" id="batadCount"><?= $totalMembers ?></h1>
                                            </div>';
                                            break;
                                        case "15":
                                                echo '<div class="card mint-green cardDash" id="totalMembers">
                                                <h4 style="color:#334443;">Gigantes</h4>
                                                <i class="fa fa-users" aria-hidden="true"></i>

                                                <h1 style="text-align:center;color:black;" id="gigantesCount"><?= $totalMembers ?></h1>
                                            </div>';
                                            break;
                                    }
                                ?> 
                                </div>

                            <?php endforeach; ?>
            <?php endif; ?>

            <?php if($getUserArea['area_name'] === 'NAO') : ?>
                <h3>Natividad Area Office</h3>
                    <div class="card-grid mb-4">
                            <?php $townIds = is_array($getUserArea['town_ids'])
                                ? $getUserArea['town_ids']
                                : explode(',', $getUserArea['town_ids']); 
                            ?>
                            
                            <?php foreach ($townIds as $id) : ?>
                                <?php $id; ?>
                                
                                <div class="wrapper">
                                    
                                    <?php switch($id) {
                                        case "01":
                                                echo '<div class="card mint-green cardDash mb-3" id="totalMembers">
                                                <h4 style="color:#334443;">Anilao</h4>
                                                <i class="fa fa-users" aria-hidden="true"></i>

                                                <h1 style="text-align:center;color:black;" id="anilaoCount"><?= $totalMembers ?></h1>
                                            </div>';
                                            break;
                                        case "02":
                                            echo '<div class="card mint-green cardDash mb-3" id="totalMembers">
                                                <h4 style="color:#334443;">Banate</h4>
                                                <i class="fa fa-users" aria-hidden="true"></i>

                                                <h1 style="text-align:center;color:black;" id="banateCount"><?= $totalMembers ?></h1>
                                            </div>';
                                            break;
                                        case "03":
                                                echo '<div class="card mint-green cardDash" id="totalMembers">
                                                <h4 style="color:#334443;">Barotac Viejo</h4>
                                                <i class="fa fa-users" aria-hidden="true"></i>

                                                <h1 style="text-align:center;color:black;" id="barotacViejoCount"><?= $totalMembers ?></h1>
                                            </div>';
                                            break;
                                        case "05":
                                                echo '<div class="card mint-green cardDash" id="totalMembers">
                                                <h4 style="color:#334443;">San Rafael</h4>
                                                <i class="fa fa-users" aria-hidden="true"></i>

                                                <h1 style="text-align:center;color:black;" id="sanRafaelCount"><?= $totalMembers ?></h1>
                                            </div>';
                                            break;
                                    }
                                ?> 
                                </div>

                            <?php endforeach; ?>
            <?php endif; ?>

            </div>
        </div>
    </div>
</div>

<?php endforeach; ?>

<script>

    var elem = document.getElementById("test");

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


    function openFullscreen(){

        if( elem.requestFullscreen ){
            elem.requestFullscreen();
        } else if ( elem.webkitRequestFullscreen ){
            elem.webkitRequestFullscreen();
        } else if ( elem.msRequestFullscreen ) {
            elem.msRequestFullscreen();
        }

    }


</script>


<?php include_once __DIR__ . '../../layouts/footer.php'; ?>