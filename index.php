<?php
$pagetitle = "Login";
include_once("views/layouts/header.php");
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
?>


<?php include_once __DIR__ . "/views/components/forms/loginForm.php"; ?>

<?php
include_once("views/layouts/footer.php");
?>

<script>
    $("#dialog").dialog({
        closeOnEscape: false
    });
</script>