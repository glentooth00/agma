<script>
$(document).ready(function() {
    $(document).on('click', '.edit-button', function() {
        var userId = $(this).data('userid');

        $.ajax({
            url: 'functions/get_user_details.php',
            method: 'GET',
            data: { userid: userId },
            dataType: 'json',
            success: function(user) {
                if(user.error) {
                    alert(user.error);
                } else {
                    // Professional table layout
                    $('#userDetailsContent').html(`
                        <span class="label">Username:</span> <span class="value">${user.username}</span>
                        <span class="label">Firstname:</span> <span class="value">${user.firstname}</span>
                        <span class="label">Middlename:</span> <span class="value">${user.middlename}</span>
                        <span class="label">Lastname:</span> <span class="value">${user.lastname}</span>
                        <span class="label">Role:</span> <span class="value">${user.role}</span>
                        <span class="label">Status:</span> <span class="value">${user.status}</span>
                        <span class="label">Created At:</span> <span class="value">${user.created_at}</span>
                        <span class="label">Updated At:</span> <span class="value">${user.updated_at}</span>
                    `);

                    $('#viewModal').addClass('show');
                }
            },
            error: function() {
                alert('Failed to fetch user details.');
            }
        });
    });

    // Close modal
    $(document).on('click', '#closeViewModal', function() {
        $('#viewModal').removeClass('show');
    });

    // Click outside to close
    $(document).on('click', '#viewModal', function(e) {
        if (e.target.id === 'viewModal') {
            $(this).removeClass('show');
        }
    });
});


</script>