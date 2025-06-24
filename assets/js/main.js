document.addEventListener('DOMContentLoaded', () => {
    const gearIcon = document.getElementById('gearIcon');
    const dropdown = gearIcon.closest('.dropdown');

    gearIcon.addEventListener('click', () => {
        dropdown.classList.toggle('active');
    });

    // Optional: Close dropdown when clicking outside
    document.addEventListener('click', (e) => {
        if (!dropdown.contains(e.target)) {
            dropdown.classList.remove('active');
        }
    });
});


$(document).ready(function () {
    // Initialize original #table if it has rows
    var rowCount = $('#table tbody tr').length;
    if (rowCount > 0 && $('#table tbody tr td').first().attr('colspan') !== '6') {
        var table = $('#table').DataTable({
            paging: true,
            searching: true,
            lengthChange: true,
            pageLength: 10,
            ordering: false,
            info: true
        });

        // Attach status filter if available
        var searchInput = $('#table_filter input');
        var filterDiv = $('#statusFilter').closest('div');
        if (filterDiv.length && searchInput.length) {
            searchInput.closest('div').append(filterDiv);

            $('#statusFilter').on('change', function () {
                var filterValue = $(this).val();
                table.column(1).search(filterValue).draw();
            });
        }
    }

    // Initialize #searchTable dynamically after AJAX
    if ($('#searchTable').length) {
        if ($.fn.DataTable.isDataTable('#searchTable')) {
            $('#searchTable').DataTable().destroy();
        }

        $('#searchTable').DataTable({
            paging: true,
            searching: true,
            lengthChange: true,
            pageLength: 10,
            ordering: false,
            info: true
        });
    }
});




//----------------DAtatables

$(document).ready(function () {
    $('.delete-btn').on('click', function () {
        const memberId = $(this).data('id');
        console.log(memberId);

        $.ajax({
            url: 'functions/delete.php', // your PHP script
            type: 'POST',
            data: { id: memberId },
            success: function (response) {
                // Optional: show success message from server
                // Then reload the page or remove the deleted row
                location.reload(); // refresh to reflect deletion
            },
            error: function () {
                alert('Failed to delete the member.');
            }
        });
    });
});
