<div id="deleteConfirmation" class="card" style="display:none;">
    <div class="mb-10 text-center">
        <span>Are you sure you want to delete this user?</span><hr>
    </div>
    <div class="button-group gap-3 d-flex justify-content-center">
        <form id="deleteForm">
            <input type="hidden" id="deleteUserId" name="user_id" value="">
        </form>
        <button id="cancelDeleteBtn" class="btn btn-secondary">Cancel</button>
        <button id="confirmDeleteBtn" class="btn btn-danger">Yes, Delete</button>
    </div>
</div>

<script>
$(document).ready(function() {
    // Open delete modal
    $('.btn-delete').click(function(){
        var userId = $(this).data('userid');
        $('#deleteUserId').val(userId);
        $('#deleteConfirmation').show();
    });

    // Cancel button
    $('#cancelDeleteBtn').click(function() {
        $('#deleteConfirmation').hide();
    });

    // Confirm delete button
    $('#confirmDeleteBtn').click(function(e) {
        e.preventDefault();
        var userId = $('#deleteUserId').val();

        $.ajax({
            url: 'functions/delete_user.php', // Your server-side delete script
            type: 'POST',
            data: { id: userId },
            success: function(response) {
                // Hide modal
                $('#deleteConfirmation').hide();

                // Remove user row from table
                $('button[data-userid="'+userId+'"]').closest('tr').fadeOut();

                // Show success popup
                showPopup("User deleted successfully!", "success");
            },
            error: function() {
                $('#deleteConfirmation').hide();
                showPopup("Failed to delete user.", "error");
            }
        });
    });

    // Popup function
    function showPopup(message, type = 'success') {
        const popup = document.getElementById("sidePopup");
        const messageBox = document.getElementById("popupMessage");

        messageBox.textContent = message;
        popup.style.background = type === 'success' ? "#28a745" : "#dc3545";

        popup.classList.add("show");

        setTimeout(() => {
            popup.classList.remove("show");
        }, 3000);
    }
});

</script>