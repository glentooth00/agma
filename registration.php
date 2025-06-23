<?php
$pagetitle = 'Registration';
require_once __DIR__ . '/views/layouts/header.php';
?>

<div class="container">
    <div>
        <h2>Registration</h2>
        <hr>
    </div>

    <div id="rubyText">
        <h5>Find your account</h5>
        <form action="views/scripts/search.php" method="post">
            <div class="search-wrapper">
                <input id="search" type="text" name="member_data"
                    placeholder="search your Account Number, Meter Number or Fullname">
                <button type="submit">
                    <i class="fa fa-magnifying-glass"></i>
                </button>
            </div>
        </form>

    </div>
    <div class="resultDiv">

    </div>
</div>


<?php
require_once __DIR__ . '/views/layouts/footer.php';
?>