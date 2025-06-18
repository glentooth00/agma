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
