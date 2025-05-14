<?php include '../includes/session.php'; ?>
<?php include '../includes/header.php'; ?>
<?php include '../includes/sidebar.php'; ?>

<?php
include '../config/db.php';
$conn = connectDB('Inventory_System');

// Fetch top 5 categories with highest stock
$query = "
    SELECT 
        s.Category_Name, 
        COUNT(s.Category_Name) AS PurchasedQty,
        ISNULL(a.AssignedQty, 0) AS AssignedQty
    FROM SerialNumberAssignment s
    LEFT JOIN (
        SELECT Device_Category, COUNT(*) AS AssignedQty 
        FROM AssignedAssets 
        GROUP BY Device_Category
    ) a ON s.Category_Name = a.Device_Category
    GROUP BY s.Category_Name, a.AssignedQty
";

$result = sqlsrv_query($conn, $query);

$stockData = [];

// if ($result) {
//     while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
//         $category = $row['Category_Name'];
//         $purchased = (int)$row['TotalQty'];
//         $assigned = (int)$row['AssignedQty'];
//         $inStock = $purchased - $assigned;

//         $stockData[] = [
//             'category' => $category,
//             'in_stock' => $inStock
//         ];
//     }

//     // Sort descending by in stock and take top 5
//     usort($stockData, fn($a, $b) => $b['in_stock'] - $a['in_stock']);
//     $stockData = array_slice($stockData, 0, 5);
// }
$now = date("F j, Y, g:i a");

while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
    $category = $row['Category_Name'];
    $purchased = (int)$row['PurchasedQty'];
    $assigned = (int)$row['AssignedQty'];
    $inStock = $purchased - $assigned;

    if ($inStock <= 2) {
        $statusIcon = 'alert-circle';
        $statusColor = 'text-red-500';
        $tooltip = 'Low Stock';
    } elseif ($inStock <= 5) {
        $statusIcon = 'alert-triangle';
        $statusColor = 'text-yellow-500';
        $tooltip = 'Moderate Stock';
    } else {
        $statusIcon = 'check-circle';
        $statusColor = 'text-green-500';
        $tooltip = 'Stock OK';
    }

    $stockData[] = [
        'category' => $category,
        'in_stock' => $inStock,
        'icon' => $statusIcon,
        'icon_color' => $statusColor,
        'tooltip' => $tooltip
    ];
}


?>

<!-- <main class="flex-1 p-6 overflow-y-auto"> -->
<div class="main-content transition-all duration-300">

    <!-- <h1 class="text-2xl font-bold mb-4">Dashboard</h1>
    <p>Welcome, <?= $_SESSION['username'] ?? 'User'; ?>!</p> -->

    <!-- Dashboard Header -->
    <!-- Welcome Card -->
    <div class="bg-white dark:bg-gray-800 shadow-md rounded-xl p-3 m-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
                    Welcome, <span class="font-semibold text-blue-600 dark:text-blue-400"><?= $_SESSION['username'] ?? 'User'; ?></span>!
                </h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                    Here's a quick summary of your stock data.
                </p>
            </div>
        </div>
    </div>




    <!-- Include Lucide and Tooltip styling in your <head> -->
<script src="https://unpkg.com/lucide@latest"></script>

<div class="p-6">
    <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100 mb-4">Available Stock Summary</h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
        <?php foreach ($stockData as $item): ?>
            <div class="flex items-center justify-between bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-4 shadow-sm hover:shadow-md transition">
                <div>
                    <div class="text-md font-medium text-gray-700 dark:text-gray-200"><?= htmlspecialchars($item['category']) ?></div>
                    <div class="text-sm text-gray-500 dark:text-gray-400">In Stock: <strong><?= $item['in_stock'] ?></strong></div>
                </div>
                <div class="<?= $item['icon_color'] ?>" title="<?= $item['tooltip'] ?>">
                    <i data-lucide="<?= $item['icon'] ?>" class="w-6 h-6"></i>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="text-sm text-gray-500 mt-6 dark:text-gray-400 text-right">
        Last updated: <?= $now ?>
    </div>
</div>

<script>
    lucide.createIcons();
</script>


<!-- </div> -->

<!-- </div> -->
<!-- </div> -->
<!-- </body> -->
<!-- </html> -->
<?php include '../includes/footer.php'; ?>