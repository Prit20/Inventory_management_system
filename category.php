<?php
include '../config/db.php';
$conn = connectDB('Inventory_System');

$categories = [];
$category_id = isset($_GET['id']) ? trim($_GET['id']) : null;
$category_name = '';
$category_type = '';
$srno_required = '';
$detail_required = '';

$showToast = false;
if (isset($_GET['success'])) {
    $showToast = true;
    $toastMessage = $_GET['success'] === 'edited' ? 'Category updated successfully!'
        : ($_GET['success'] === 'added' ? 'Category added successfully!' : 'Category deleted successfully!');
}

if ($category_id) {
    $query = 'SELECT * FROM DeviceCategory WHERE Id = ?';
    $params = array($category_id);
    $stmt = sqlsrv_query($conn, $query, $params);
    if ($stmt && $category_data = sqlsrv_fetch_array($stmt)) {
        $category_name = $category_data['Device_Category'];
        $category_type = $category_data['Type'];
        $srno_required = $category_data['SrNo_Required'];
        $detail_required = $category_data['Detail_Required'];
    }
}

$cat_query = 'SELECT * FROM DeviceCategory WHERE Is_Deleted = 0 ORDER BY Type DESC';
$cat_run_query = sqlsrv_query($conn, $cat_query);
if ($cat_run_query) {
    while ($row = sqlsrv_fetch_array($cat_run_query)) {
        $categories[] = $row;
    }
}
?>
<?php include '../includes/header.php'; ?>

<?php include '../includes/sidebar.php'; ?>

<div class="main-content p-6 transition-all duration-300 dark:bg-gray-900 dark:text-gray-100">

    <!-- Toast Notification -->
    <!-- <?php if ($showToast): ?>
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 2000)"
        class="fixed top-6 right-6 z-50 px-5 py-3 bg-green-500 text-white rounded shadow-lg transition ease-in-out duration-300"
        x-cloak>
        <?php echo htmlspecialchars($toastMessage); ?>
    </div>
    <?php endif; ?> -->
    <?php if ($showToast): ?>
    <div x-data="{ show: true }"
         x-show="show"
         x-init="setTimeout(() => show = false, 2000)"
         x-transition:enter="transition ease-out duration-300"
         x-transition:leave="transition ease-in duration-300"
         class="fixed top-6 right-6 z-50 px-5 py-3 bg-green-500 text-white rounded shadow-lg"
         x-cloak>
        <?php echo htmlspecialchars($toastMessage); ?>
    </div>
<?php endif; ?>


    <!-- Breadcrumb -->
    <nav class="text-sm text-gray-600 dark:text-gray-400 mb-4">
        <ol class="list-reset flex items-center space-x-2">
            <li><a href="dashboard.php" class="hover:text-primary-600">Dashboard</a></li>
            <li>/</li>
            <li class="text-gray-500"><?php echo $category_id ? 'Edit Category' : 'Add Category'; ?></li>
        </ol>
    </nav>

    <!-- Category Form Card -->
    <div class="bg-white dark:bg-gray-800 shadow rounded-xl p-6 card-lift">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-bold flex items-center text-gray-800 dark:text-gray-200">
                <i class="fas fa-layer-group mr-3 text-blue-500"></i>
                <?php echo $category_id ? 'Edit Category' : 'Add Category'; ?>
            </h2>
        </div>

        <form method="POST" action="../backend/db_category.php" id="categoryForm">
            <input type="hidden" name="action" value="<?php echo $category_id ? 'edit_category' : 'add_category'; ?>">
            <input type="hidden" name="category_id" value="<?php echo $category_id; ?>">

            <div class="grid md:grid-cols-6 gap-6">
                <div class="col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Category Name</label>
                    <input type="text" name="category_name" value="<?php echo htmlspecialchars($category_name); ?>"
                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-800 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:text-white"
                        placeholder="Enter category name..." required>
                </div>

                <div class="col-span-1">
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Type</label>
                    <select name="category_type"
                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-800 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:text-white"
                        required>
                        <option value="">Select</option>
                        <option value="User" <?php echo $category_type === 'User' ? 'selected' : ''; ?>>User</option>
                        <option value="General" <?php echo $category_type === 'General' ? 'selected' : ''; ?>>General</option>
                    </select>
                </div>

                <div class="col-span-1">
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Serial No. Required</label>
                    <select name="srno_required"
                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-800 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:text-white"
                        required>
                        <option value="1" <?php echo $srno_required == '1' ? 'selected' : ''; ?>>Yes</option>
                        <option value="0" <?php echo $srno_required == '0' ? 'selected' : ''; ?>>No</option>
                    </select>
                </div>

                <div class="col-span-1">
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Details Required</label>
                    <select name="detail_required"
                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-800 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:text-white"
                        required>
                        <option value="1" <?php echo $detail_required == '1' ? 'selected' : ''; ?>>Yes</option>
                        <option value="0" <?php echo $detail_required == '0' ? 'selected' : ''; ?>>No</option>
                    </select>
                </div>

                <div class="flex items-end">
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-md transition duration-200 w-full">
                        <?php echo $category_id ? 'Update' : 'Add'; ?>
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Category List -->
    <div class="mt-10 bg-white dark:bg-gray-800 shadow rounded-xl p-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-bold text-gray-800 dark:text-gray-200">
                <i class="fas fa-list-ul text-blue-500 mr-2"></i> Categories List
            </h2>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 table-lift">
                <thead class="bg-gray-100 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">ID</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">Category Name</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">Type</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">Serial No. Required</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">Details Required</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    <?php foreach ($categories as $category): ?>
                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                        <td class="px-6 py-3 text-sm text-gray-900 dark:text-gray-100"><?php echo $category['Id']; ?></td>
                        <td class="px-6 py-3 text-sm text-gray-900 dark:text-gray-100"><?php echo htmlspecialchars($category['Device_Category']); ?></td>
                        <td class="px-6 py-3 text-sm text-gray-900 dark:text-gray-100"><?php echo htmlspecialchars($category['Type']); ?></td>
                        <td class="px-6 py-3 text-sm text-gray-900 dark:text-gray-100"><?php echo $category['SrNo_Required'] ? 'Yes' : 'No'; ?></td>
                        <td class="px-6 py-3 text-sm text-gray-900 dark:text-gray-100"><?php echo $category['Detail_Required'] ? 'Yes' : 'No'; ?></td>
                        <td class="px-6 py-3 text-sm text-gray-900 dark:text-gray-100">
                            <div class="flex items-center space-x-4">
                                <a href="category.php?id=<?php echo $category['Id']; ?>" class="text-blue-600 hover:text-blue-800 transition">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form method="POST" action="../backend/db_category.php" onsubmit="return confirm('Are you sure you want to delete this category?');">
                                    <input type="hidden" name="category_id" value="<?php echo $category['Id']; ?>">
                                    <input type="hidden" name="action" value="delete_category">
                                    <button type="submit" class="text-red-600 hover:text-red-800 transition">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if (empty($categories)): ?>
                    <tr>
                        <td colspan="6" class="text-center py-4 text-gray-500">No categories found.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

<?php include '../includes/footer.php'; ?>

<script>
document.querySelector('#categoryForm').addEventListener('submit', function(event) {
    const name = document.querySelector('input[name="category_name"]').value.trim();
    if (!name) {
        alert('Category name is required!');
        event.preventDefault();
    }
});
</script>
