<div class="sidebar  vh-100 p-3 shadow-sm">
    <!-- Logo / Brand -->
    <div class="mb-4 text-center">
        <h3 class="fw-bold">LOGO AREA</h3>
    </div>

    <!-- Dashboard -->
    <a href="index.php" class="d-flex align-items-center p-2 rounded <?= $currentPage === 'Dashboard' ? 'bg-primary text-white' : 'text-dark' ?>">
        <i class="fa-solid fa-gauge me-2"></i>
        Dashboard
    </a>

    <!-- Members -->
    <a href="membership.php" class="d-flex align-items-center p-2 rounded <?= $currentPage === 'Membership' ? 'bg-primary text-white' : 'text-dark' ?>">
        <i class="fa-solid fa-user-group me-2"></i>
        Members
    </a>

    <!-- Manage Users -->
    <a href="users.php" class="d-flex align-items-center p-2 rounded <?= $currentPage === 'Users' ? 'bg-primary text-white' : 'text-dark' ?>">
        <i class="fa-solid fa-users-gear me-2"></i>
        Manage Users
    </a>

    <a href="view_attendees.php" class="d-flex align-items-center p-2 rounded <?= $currentPage === 'Users' ? 'bg-primary text-white' : 'text-dark' ?>">
        <i class="fa-solid fa-users-gear me-2"></i>
        View 
    </a>

    <!-- Attendees Accordion -->
    <?php
    $attendeesSubmenu = [
        ['title' => 'All Attendees', 'url' => 'attendees.php'],
        ['title' => 'VIP Attendees', 'url' => 'vip_attendees.php'],
        ['title' => 'Guest List', 'url' => 'guest_list.php'],
    ];
    ?>
<!-- Attendees Accordion -->
<div class="accordion" id="attendeesAccordion">
    <div class="accordion-item border-0">
        <h2 class="accordion-header" id="headingAttendees">
            <button class="accordion-button p-2 text-dark <?= $currentPage === 'Attendees' ? '' : 'collapsed' ?>" 
                    type="button" 
                    data-bs-toggle="collapse" 
                    data-bs-target="#collapseAttendees" 
                    aria-expanded="<?= $currentPage === 'Attendees' ? 'true' : 'false' ?>" 
                    aria-controls="collapseAttendees"
                    style="font-weight:600;">
               <i class="fa fa-globe me-2" aria-hidden="true"></i>

            Venue Attendees
            </button>
        </h2>
        <div id="collapseAttendees" 
             class="accordion-collapse collapse <?= $currentPage === 'Attendees' ? 'show' : '' ?>" 
             aria-labelledby="headingAttendees" 
             data-bs-parent="#attendeesAccordion">
            <div class="accordion-body p-0">
                <ul class="list-group list-group-flush" style="text-align:center;">
                    <?php foreach ($attendeesSubmenu as $item): ?>
                        <li class="list-group-item border-0 <?= $currentPage === $item['title'] ? 'bg-primary text-white' : '' ?>">
                            <a href="<?= $item['url'] ?>" class="text-decoration-none d-block <?= $currentPage === $item['title'] ? 'text-white' : 'text-dark' ?>">
                                <?= htmlspecialchars($item['title']) ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</div>

</div>

<!-- Add Font Awesome CDN if not yet included -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
