<?php if (isset($_SESSION['popup_message'])): ?>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        let popup = document.getElementById("sidePopup");
        let messageBox = document.getElementById("popupMessage");

        // Set text
        messageBox.textContent = "<?=$_SESSION['popup_message']?>";

        // Set color
        let type = "<?= $_SESSION['popup_type'] ?>";
        popup.style.background = type === "success" ? "#28a745" : "#dc3545";

        // Show popup
        popup.classList.add("show");

        // Hide after 3s
        setTimeout(() => {
            popup.classList.remove("show");
        }, 4000);
    });
</script>
<?php 
    unset($_SESSION['popup_message']);
    unset($_SESSION['popup_type']);
endif; 
?>