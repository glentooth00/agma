<div id="topPanel">
    <span>AGMA Management App</span>
    <div class="dropdown">
        <i class="fa-solid fa-gear" id="gearIcon"></i>
        <div class="dropdown-menu">
           <a href="#" onclick="event.preventDefault(); showSettings();">
                <i class="fa-solid fa-sliders"></i> Settings
            </a>
            <a href="#"><i class="fa-solid fa-user"></i> Profile</a>
            <a href="../scripts/logout.php?userid=<?= $userid ?>"><i class="fa-solid fa-right-from-bracket"></i>
                Logout</a>
        </div>
    </div>
</div>

<div id="settingsModal" class="card" style="display:none;">
    <div class="d-inline-flex justify-content-between w-100">
        <div>
            <h3><i class="fa fa-cogs me-1" aria-hidden="true"></i>Settings</h3>
        </div>
        <div class="float-end">
           <button class="btn" onclick="closeSettings()">
                <i class="fa fa-times" aria-hidden="true"></i>
            </button>
        </div>
    </div>
    <hr>
    <div class="card-body">
        <div class="accordion" id="settingsAccordion">
             <!-- Accordion Item 1 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingZero">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseZero" aria-expanded="true" aria-controls="collapseZero">
                        Area Office
                    </button>
                </h2>
                <div id="collapseZero" class="accordion-collapse collapse show" aria-labelledby="headingZero" data-bs-parent="#settingsAccordion">
                    <div class="accordion-body">
                        
                    </div>
                </div>
            </div>
            <!-- Accordion Item 1 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        General Settings
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#settingsAccordion">
                    <div class="accordion-body">
                        General settings content goes here...
                    </div>
                </div>
            </div>
            <!-- Accordion Item 2 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Account Settings
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#settingsAccordion">
                    <div class="accordion-body">
                        Account settings content goes here...
                    </div>
                </div>
            </div>
            <!-- Accordion Item 3 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        Privacy Settings
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#settingsAccordion">
                    <div class="accordion-body">
                        Privacy settings content goes here...
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<style>
    #settingsModal{
        background-color: white;
        position: absolute;
        width: 60%;
        margin: 2em 20em 80em 20em;
        z-index:3;
        box-shadow: 0 19px 98em 90em rgb(0 0 0 / 67%), 0 15px 12px rgba(0, 0, 0, 0.22);
    }
</style>


<script>
function showSettings() {
    const modal = document.getElementById("settingsModal");

    if (modal.style.display === "none") {
        modal.style.display = "block";
    } else {
        modal.style.display = "none";
    }
}

function closeSettings() {
    document.getElementById("settingsModal").style.display = "none";
}

</script>