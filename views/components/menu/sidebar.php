<?php $isActive = 'active'; ?>

<nav class="sidebar p-2">
    <div class="p-3 bg-dark mb-5">
        <span>LOGO AREA</span>
    </div>
    <hr>
    <div class="p-2">
        <ul>
            <?php if ($currentPage === 'Dashboard'): ?>
                <?php $backgroundColor = 'background-color:#FA812F;'; ?>
                <li style="<?= $backgroundColor ?>">
                    <a class="text-white" href="index.php">Dashboard</a>
                </li>
            <?php else: ?>
                <li>
                    <a href="index.php">Dashboard</a>
                </li>
            <?php endif; ?>

            <?php if ($currentPage === 'Members'): ?>
                <?php $backgroundColor = 'background-color:#FA812F;'; ?>
                <li style="<?= $backgroundColor ?>">
                    <a class="text-white" href="members.php">Members</a>
                </li>
            <?php else: ?>
                <li>
                    <a href="members.php">Members</a>
                </li>
            <?php endif; ?>
            <li>
                <a href="">Settings</a>
            </li>
            <li>
                <a href="">Members</a>
            </li>
        </ul>
    </div>

</nav>