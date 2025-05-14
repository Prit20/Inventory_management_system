<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>

<div id="sidebar" class="w-64 h-screen bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 fixed z-20 top-0 left-0 overflow-y-auto transition-all duration-300">
    <!-- Sidebar Header -->
    <div class="py-4 px-6 border-b border-gray-200 dark:border-gray-700">
        <h2 class="text-2xl font-bold text-blue-600 text-center sidebar-label" >Inventory</h2>
    </div>

    <!-- Sidebar Header -->
<!-- <div class="py-4 px-6 border-b border-gray-200 dark:border-gray-700">
    <h2 class="text-xl font-bold text-blue-600 text-center">Inventory</h2>
</div> -->

<nav class="flex flex-col gap-1 px-1 py-4">
    <!-- Dashboard -->
    <!-- <a href="dashboard.php" class="flex items-center gap-3 px-4 py-2 rounded-lg transition-all text-base font-medium
        <?php echo ($current_page == 'dashboard.php') ? 'bg-blue-100 text-blue-600 font-semibold' : 'text-gray-700 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700'; ?>">
        <i class="fas fa-home w-5 text-center"></i> Dashboard
    </a> -->
    <a href="dashboard.php" class="flex items-center gap-3 px-4 py-2 rounded-lg transition-all text-base font-medium <?php echo ($current_page == 'dashboard.php') ? 'bg-blue-100 text-blue-600 font-semibold' : 'text-gray-700 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700'; ?>">
    <i class="fas fa-home w-5 text-center"></i>
    <span class="sidebar-label">Dashboard</span>
</a>


    <!-- Other Items -->
    <a href="categoryassign.php" class="flex items-center gap-3 px-4 py-2 rounded-lg text-base font-medium
        <?php echo ($current_page == 'categoryassign.php') ? 'bg-blue-100 text-blue-600 font-semibold' : 'text-gray-700 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700'; ?>">
        <i class="fas fa-tasks w-5 text-center"></i> 
        <span class="sidebar-label">Category Assign</span>
    </a>

    <a href="serialnoassign.php" class="flex items-center gap-3 px-4 py-2 rounded-lg text-base font-medium
        <?php echo ($current_page == 'serialnoassign.php' || $current_page == 'serialnoassign_form.php') ? 'bg-blue-100 text-blue-600 font-semibold' : 'text-gray-700 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700'; ?>">
        <i class="fas fa-list-ol w-5 text-center"></i> 
       <span class="sidebar-label">Serial No. Assign</span>
    </a>

    <a href="stock.php" class="flex items-center gap-3 px-4 py-2 rounded-lg text-base font-medium
        <?php echo ($current_page == 'stock.php' || $current_page == 'stockdetails.php') ? 'bg-blue-100 text-blue-600 font-semibold' : 'text-gray-700 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700'; ?>">
        <i class="fas fa-box w-5 text-center"></i> 
        <span class="sidebar-label">Stock
    </a>
    

    <a href="assignassets.php" class="flex items-center gap-3 px-4 py-2 rounded-lg text-base font-medium
        <?php echo ($current_page == 'assignassets.php') ? 'bg-blue-100 text-blue-600 font-semibold' : 'text-gray-700 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700'; ?>">
        <i class="fas fa-laptop-house w-5 text-center"></i> 
        <span class="sidebar-label">Assign Assets</span>
    </a>
    
    <!-- Master Toggle -->
    <button type="button" class="submenu-toggle flex items-center justify-between w-full px-4 py-2 rounded-lg text-base font-medium
        <?php echo ($current_page == 'company.php' || $current_page == 'category.php') ? 'bg-blue-100 text-blue-600 font-semibold' : 'text-gray-700 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700'; ?>" 
        data-target="submenu-master" aria-expanded="<?php echo ($current_page == 'company.php' || $current_page == 'category.php') ? 'true' : 'false'; ?>">
        <span class="flex items-center gap-3">
            <i class="fas fa-cogs w-5 text-center"></i> 
            <span class="sidebar-label">Master</span>
        </span>
        <i class="fas fa-chevron-down transition-transform duration-200 <?php echo ($current_page == 'company.php' || $current_page == 'category.php') ? 'rotate-180' : ''; ?>"></i>
    </button>

    <!-- Master Submenu -->
    <div id="submenu-master" class="ml-4 space-y-1 mt-2 transition-all duration-300 overflow-hidden 
        <?php echo ($current_page == 'company.php' || $current_page == 'category.php') ? 'block' : 'hidden'; ?>">
        <a href="company.php" class="flex items-center gap-3 px-4 py-2 rounded-lg text-sm font-medium
            <?php echo ($current_page == 'company.php') ? 'bg-blue-100 text-blue-600 font-semibold' : 'text-gray-700 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700'; ?>">
            <i class="fas fa-building w-5 text-center"></i> 
            <span class="sidebar-label">Company</span>
        </a>
        <a href="category.php" class="flex items-center gap-3 px-4 py-2 rounded-lg text-sm font-medium
            <?php echo ($current_page == 'category.php') ? 'bg-blue-100 text-blue-600 font-semibold' : 'text-gray-700 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700'; ?>">
            <i class="fas fa-tags w-5 text-center"></i> 
            <span class="sidebar-label">Category</span>
        </a>
    </div>

</nav>

</div>

<!-- <script>
// Master menu toggle
document.addEventListener('DOMContentLoaded', function () {
    const toggles = document.querySelectorAll('.submenu-toggle');

    toggles.forEach(toggle => {
        toggle.addEventListener('click', function () {
            const targetId = this.getAttribute('data-target');
            const submenu = document.getElementById(targetId);
            const expanded = this.getAttribute('aria-expanded') === 'true';
            const icon = this.querySelector('i.fas.fa-chevron-down');

            submenu.classList.toggle('hidden');
            this.setAttribute('aria-expanded', !expanded);
            icon.classList.toggle('rotate-180');
        });
    });
});
</script> -->
