<?php
include '../config/db.php';
$conn = connectDB('Inventory_System');

$company_id = isset($_GET['id']) ? trim($_GET['id']) : null;
$company_name = '';
$message = '';

$showToast = false;
if (isset($_GET['success'])) {
    $showToast = true;
    $toastMessage = $_GET['success'] === 'edited' ? 'Company updated successfully!'
        : ($_GET['success'] === 'added' ? 'Company added successfully!' : 'Company deleted successfully!');
}

if ($company_id) {
    $query = 'SELECT * FROM CompanyName WHERE id = ? AND Is_Deleted = 0';
    $params = array($company_id);
    $stmt = sqlsrv_query($conn, $query, $params);
    if ($stmt && $company_data = sqlsrv_fetch_array($stmt)) {
        $company_name = $company_data['Company_Name'];
    }
}

$companies = [];
$cat_query = 'SELECT * FROM CompanyName WHERE Is_Deleted = 0 ORDER BY CreatedAt ASC';
$cat_run_query = sqlsrv_query($conn, $cat_query);
if ($cat_run_query) {
    while ($row = sqlsrv_fetch_array($cat_run_query)) {
        $companies[] = $row;
    }
}
?>

<?php include '../includes/sidebar.php'; ?>
<?php include '../includes/header.php'; ?>

<div class="main-content p-6 transition-all duration-300 dark:bg-gray-900 dark:text-gray-100">

    <!-- Toast Notification -->
    <?php if ($showToast): ?>
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 2000)"
        class="fixed top-6 right-6 z-50 px-5 py-3 bg-green-500 text-white rounded shadow-lg transition ease-in-out duration-300"
        x-cloak>
        <?php echo htmlspecialchars($toastMessage); ?>
    </div>
    <?php endif; ?>

    <!-- Breadcrumb -->
    <nav class="text-sm text-gray-600 dark:text-gray-400 mb-4">
        <ol class="list-reset flex items-center space-x-2">
            <li><a href="dashboard.php" class="hover:text-primary-600">Dashboard</a></li>
            <li>/</li>
            <li class="text-gray-500"><?php echo $company_id ? 'Edit Company' : 'Add Company'; ?></li>
        </ol>
    </nav>

     <!-- Company Form Card -->
<div class="bg-white dark:bg-gray-800 shadow rounded-xl p-6 card-lift">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-xl font-bold flex items-center text-gray-800 dark:text-gray-200">
            <i class="fas fa-building mr-3 text-blue-500"></i>
            <?php echo $company_id ? 'Edit Company' : 'Add Company'; ?>
        </h2>
    </div>

    <form method="POST" action="../backend/db_company.php" id="companyForm">
        <input type="hidden" name="action" value="<?php echo $company_id ? 'edit_company' : 'add_company'; ?>">
        <input type="hidden" name="company_id" value="<?php echo $company_id; ?>">

        <div class="grid md:grid-cols-5 gap-6">
            <div class="col-span-2">
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Company Name</label>
                <input type="text" name="company_name" value="<?php echo htmlspecialchars($company_name); ?>"
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-800 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:text-white"
                    placeholder="Enter company name..." required>
            </div>
            <div class="flex items-end">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-md transition duration-200 w-full">
                    <?php echo $company_id ? 'Update' : 'Add'; ?>
                </button>
            </div>
        </div>
    </form>
</div>


    <!-- Companies List -->
<div class="mt-10 bg-white dark:bg-gray-800 shadow rounded-xl p-6">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl font-bold text-gray-800 dark:text-gray-200">
            <i class="fas fa-list-alt text-blue-500 mr-2"></i> Companies List
        </h2>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 table-lift">
            <thead class="bg-gray-100 dark:bg-gray-700">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">ID</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">Company Name</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                <?php foreach ($companies as $company): ?>
                <tr class="hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                    <td class="px-6 py-3 text-sm text-gray-900 dark:text-gray-100"><?php echo $company['Id']; ?></td>
                    <td class="px-6 py-3 text-sm text-gray-900 dark:text-gray-100">
                        <?php echo htmlspecialchars($company['Company_Name']); ?>
                    </td>
                    <td class="px-6 py-3 text-sm text-gray-900 dark:text-gray-100">
                        <div class="flex items-center space-x-4">
                            <a href="company.php?id=<?php echo $company['Id']; ?>"
                                class="text-blue-600 hover:text-blue-800 transition">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form method="POST" action="../backend/db_company.php"
                                onsubmit="return confirm('Are you sure you want to delete this company?');">
                                <input type="hidden" name="company_id" value="<?php echo $company['Id']; ?>">
                                <input type="hidden" name="action" value="delete_company">
                                <button type="submit" class="text-red-600 hover:text-red-800 transition">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php if (empty($companies)): ?>
                <tr>
                    <td colspan="3" class="text-center py-4 text-gray-500">No companies found.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>


<?php include '../includes/footer.php'; ?>

<script>
document.querySelector('#companyForm').addEventListener('submit', function(event) {
    const name = document.querySelector('input[name="company_name"]').value.trim();
    if (!name) {
        alert('Company name is required!');
        event.preventDefault();
    }
});
</script>
