<?php
$pagetitle = "Login";
include_once("views/layouts/header.php");
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