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


//----------------DAtatables
$(document).ready(function () {
    var rowCount = $('#table tbody tr').length;

    // Check if the table has at least one data row (excluding the "No contracts found" message)
    if (rowCount > 0 && $('#table tbody tr td').first().attr('colspan') !== '6') {
        // Initialize DataTable
        var table = $('#table').DataTable({
            "paging": true,
            "searching": true,
            "lengthChange": true,
            "pageLength": 10,
            "ordering": false,
            "info": true
        });

        // Append the contract type filter next to the search input
        var searchInput = $('#table_filter input'); // DataTables search input field
        var filterDiv = $('#statusFilter').closest('div'); // The contract filter container
        searchInput.closest('div').append(filterDiv); // Move the filter next to the search input

        // Apply filter based on contract type selection
        $('#statusFilter').change(function () {
            var filterValue = $(this).val();
            if (filterValue) {
                table.column(1).search(filterValue).draw(); // Column 1 is for contract type
            } else {
                table.column(1).search('').draw(); // Reset filter
            }
        });
    }
});



//----------------DAtatables

