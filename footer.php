</div> <!-- End of main content -->
</body>


<script>
document.addEventListener('DOMContentLoaded', function () {
    const menuToggle = document.getElementById('menu-toggle');
    const sidebar = document.getElementById('sidebar');
    const header = document.querySelector('header');
    const mainContent = document.querySelector('.main-content');
    const darkToggle = document.getElementById('darkToggle');

    // Restore sidebar state from localStorage
    const isCollapsed = localStorage.getItem('sidebar-collapsed') === 'true';
    if (isCollapsed) {
        sidebar.classList.add('collapsed');
        sidebar.style.width = '0';
        header.style.marginLeft = '3rem';
        mainContent.style.marginLeft = '3rem';
    } else {
        sidebar.classList.remove('collapsed');
        sidebar.style.width = '15rem';
        header.style.marginLeft = '15rem';
        mainContent.style.marginLeft = '15rem';
    }

    // Toggle Sidebar
    menuToggle.addEventListener('click', function () {
        sidebar.classList.toggle('collapsed');

        if (sidebar.classList.contains('collapsed')) {
            sidebar.style.width = '0';
            header.style.marginLeft = '3rem';
            mainContent.style.marginLeft = '3rem';
            localStorage.setItem('sidebar-collapsed', 'true');
        } else {
            sidebar.style.width = '15rem';
            header.style.marginLeft = '15rem';
            mainContent.style.marginLeft = '15rem';
            localStorage.setItem('sidebar-collapsed', 'false');
        }
    });

    // Dark Mode Toggle
    if (darkToggle) {
        darkToggle.addEventListener('click', () => {
            document.documentElement.classList.toggle('dark');
        });
    }

    // Submenu Toggle
    document.querySelectorAll('.submenu-toggle').forEach(button => {
        button.addEventListener('click', () => {
            const target = document.getElementById(button.dataset.target);
            if (target) {
                target.classList.toggle('hidden');
            }
        });
    });

    // Sidebar Active Link
    document.querySelectorAll('.sidebar-link').forEach(link => {
        link.addEventListener('click', (e) => {
            document.querySelectorAll('.sidebar-link').forEach(l => l.classList.remove('active'));
            e.currentTarget.classList.add('active');
        });
    });
});
</script>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

<!-- Toast message -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</html>
