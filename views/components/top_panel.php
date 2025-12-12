<?php 
require_once '../../vendor/autoload.php';
use App\Controllers\AreaTownController;
use App\Controllers\TownsController;
$towns =  ( new TownsController )->getTowns();
$getAreas =  ( new AreaTownController )->getAllAreas();
?>



<div id="topPanel">
    <span>ILECO III AGMA Management App</span>
    <div class="dropdown">
        <i class="fa-solid fa-gear" id="gearIcon"></i>
        <div class="dropdown-menu">
            <a href="#" onclick="event.preventDefault(); showSettings();">
                <i class="fa-solid fa-sliders"></i> Settings
            </a>
            <a href="#"><i class="fa-solid fa-user"></i> Profile</a>
            <a href="../scripts/logout.php?userid=<?= $userid ?>"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
        </div>
    </div>
</div>

<!-- Settings Modal -->
<div id="settingsModal" class="card" style="display:none;">

    <div class="d-inline-flex justify-content-between w-100">
        <h3><i class="fa fa-cogs me-1"></i> Settings</h3>
        <button class="btn" onclick="closeSettings()"><i class="fa fa-times"></i></button>
    </div>

    <hr>

    <div class="card-body">
        <div class="accordion" id="settingsAccordion">

            <!-- Manage Area Offices -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingZero">
                    <button class="accordion-button active" type="button" data-bs-toggle="collapse" data-bs-target="#collapseZero">
                        Manage Area Offices
                    </button>
                </h2>

                <div id="collapseZero" class="accordion-collapse collapse show" data-bs-parent="#settingsAccordion">
                    <div class="accordion-body">

                        <div class="settings-flex-container">

                            <!-- Left Card -->
                            <div class="card settings-card">
                                <form id="setAreadata">
                                    <h5>Select Area Office</h5>
                                    <hr>

                                    <!-- <label class="badge text-dark">Area Office</label> -->
                                    <select name="area_office" class="form-select">
                                        <option hidden>-- Select Area Office --</option>
                                        <option value="PAO">Panian Area Office</option>
                                        <option value="SAO">Sara Area Office</option>
                                        <option value="NAO">Natividad Area Office</option>
                                    </select>

                                    <hr>

                                    <h5>Towns</h5>

                                    <select 
                                        class="js-example-basic-multiple-limit form-select"
                                        id="mySelect2" multiple>
                                    </select>

                                    <div class="mt-3">
                                        <button class="btn btn-secondary">Submit</button>
                                    </div>
                                </form>
                            </div>

                            <!-- Right Card -->
                            <div class="card settings-card-large">
                                <h4>Area List</h4>
                                <div>
                                    <table id="table" class="table table-bordered table-striped">
                                        <thead>
                                            <th>Area Office</th>
                                            <th>Town Routes</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody id="here">
                                            <?php foreach ($getAreas as $areas) : ?>
                                            <tr>
                                                <td><?= $areas['area_name'] ?></td>
                                                <td><?= $areas['town_ids'] ?></td>
                                                <td>
                                                    <button class="delete-btn btn btn-danger btn-sm" data-id=<?= $areas['id'] ?> >Delete</button>
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
            </div>

            <!-- General Settings -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                        General Settings
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse">
                    <div class="accordion-body">General settings content goes here...</div>
                </div>
            </div>

            <!-- Account Settings -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                        Account Settings
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse">
                    <div class="accordion-body">Account settings content goes here...</div>
                </div>
            </div>

            <!-- Privacy Settings -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree">
                        Privacy Settings
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse">
                    <div class="accordion-body">Privacy settings content goes here...</div>
                </div>
            </div>

        </div>
    </div>

</div><!-- END MODAL -->


<!-- UPDATED STYLES -->
<style>
#settingsModal {
    background-color: white;
    position: fixed;
    top: 5%;
    left: 50%;
    transform: translateX(-50%);
    width: 70%;
    z-index: 99999;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 1em 2em 100em 100em rgb(0 0 0 / 83%);
}

.settings-flex-container {
    display: flex;
    gap: 20px;
}

.settings-card {
    flex: 0 0 30%;
    padding: 15px;
}

.settings-card-large {
    flex: 1;
    padding: 15px;
}

#mySelect2 {
    width: 100% !important;
}

/* fix dropdown behind modal */
.select2-container,
.select2-dropdown {
    z-index: 999999 !important;
}
.select2-results__options{
    list-style: none;
    margin-left: 20px;
    padding: 5;
}
ul li{
    list-style: none;
    margin-left:0;
    color: black;
}
ul li:hover {
    list-style: none;
    margin-left:0;
    color: black;
}
</style>


<!-- UPDATED SCRIPT -->
<script>
function showSettings() {
    document.getElementById("settingsModal").style.display = "block";
}

function closeSettings() {
    document.getElementById("settingsModal").style.display = "none";
}

$('.js-example-basic-multiple-limit').select2({
    maximumSelectionLength: 10,
    placeholder: "Select town",
    width: '100%',
    dropdownParent: $('#settingsModal'),
    ajax: {
        url: '../components/getTownsAPI.php',
        dataType: 'json',
        delay: 200,
        data: function(params) {
            return {
                search: params.term // send user search term to the API
            };
        },
        processResults: function (data) {
            return {
                results: data.map(item => ({
                    id: item.TownCode,
                    text: item.TownName
                }))
            };
        },
        cache: true
    },
    minimumInputLength: 1 // optional, wait until user types 1+ character
});



$(document).ready(function() {
    $('#setAreadata').submit(function(event){
        event.preventDefault();

        var form = document.getElementById('setAreadata');
        var formData = new FormData(form);

        // Single select
        var areaOffice = $('select[name="area_office"]').val();
        formData.set('area_office', areaOffice);

        // Multiple Select2
        var selectedTowns = $('#mySelect2').val() || [];
        formData.delete('towns[]'); // remove old if any
        selectedTowns.forEach(function(town){
            formData.append('towns[]', town);
        });

        $.ajax({
            type: 'POST',
            url: 'functions/saveAreaSettings.php',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                alert("Area Setting Saved");

                // Reset the form
                $('#setAreadata')[0].reset(); 
                $("#mySelect2").val(null).trigger('change');

                // 🔥 RELOAD TABLE AFTER SAVE
                loadAreas();
            },
            error:function(xhr, status, error){
                console.log('Error:', status, error);
            }
        });
    });
});


//get data from php api
function loadAreas() {
    $.ajax({
        type: 'GET',
        url: 'functions/getAreas.php',
        dataType: "json",
        success: function(data){
            let html = "";

            data.forEach(row => {
                html += `
                    <tr>
                        <td>${row.area_name}</td>
                        <td>${row.town_ids}</td>
                        <td><button class="delete-btn btn btn-danger btn-sm" data-id=${row.id} >Delete </button></td>
                    </tr>
                `;
            });

            $("#here").html(html);
        }
    });
}

$(document).ready(function () {
    loadAreas(); // initial load
});


$(document).on('click', '.delete-btn', function () {
    var id = $(this).data('id');

    if (confirm("Are you sure you want to delete this record?")) {
        $.ajax({
            url: 'functions/delete_area.php',
            type: 'POST',
            dataType: 'json',
            data: { id: id },
            success: function (response) {
                if (response.success) {
                    // Reload table from server
                    loadAreas();
                    alert("Area Deleted!");
                } else {
                    alert("Error deleting record: " + response.message);
                }
            }
        });
    }
});

</script>
