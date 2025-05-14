<?php
include '../config/db.php';
$conn = connectDB('Inventory_System');

$category = isset($_GET['category']) ? $_GET['category'] : '';
if (!$category) {
    echo "No category selected.";
    exit;
}
?>

<?php include '../includes/sidebar.php'; ?>
<?php include '../includes/header.php'; ?>

<div class="main-content p-6 min-h-screen transition-all duration-300 bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-100">

    <!-- Page Header -->
    <div class="mb-6">
        <div class="flex flex-col md:flex-row justify-between md:items-center gap-4">
            <h1 class="text-2xl md:text-3xl font-bold">
                📦 Stock Details: 
                <span class="text-blue-600 dark:text-blue-400">"<?php echo htmlspecialchars($category); ?>"</span>
            </h1>
            <a href="stock.php"
                class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg shadow">
                ← Back to Stock
            </a>
        </div>
    </div>

    <!-- Table Container -->
    <div class="bg-white dark:bg-gray-800 shadow-lg rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left text-gray-700 dark:text-gray-200">
                <thead class="text-xs uppercase bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-300">
                    <tr>
                        <th class="px-6 py-4">Sr No</th>
                        <th class="px-6 py-4">Company Name</th>
                        <th class="px-6 py-4">Serial Number</th>
                        <th class="px-6 py-4">Warranty Type</th>
                        <th class="px-6 py-4">Warranty Period</th>
                        <th class="px-6 py-4">Guarantee Type</th>
                        <th class="px-6 py-4">Guarantee Period</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "
                        SELECT
                            s.Company_Name,
                            s.Serial_Number,
                            ca.Warranty_Type,
                            ca.Warranty_Start,
                            ca.Warranty_End,
                            ca.Guarantee_Type,
                            ca.Guarantee_Start,
                            ca.Guarantee_End
                        FROM SerialNumberAssignment s
                        LEFT JOIN AssignedAssets a ON s.Serial_Number = a.Serial_Number
                        LEFT JOIN CategoryAssign ca ON s.Sr_No = ca.Sr_No
                        WHERE s.Category_Name = '$category'
                        AND a.Serial_Number IS NULL
                    ";

                    $result = sqlsrv_query($conn, $query);
                    if ($result) {
                        $srno = 1;
                        while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                            $warrantyStart = $row['Warranty_Start'] ? $row['Warranty_Start']->format('d-m-Y') : '-';
                            $warrantyEnd = $row['Warranty_End'] ? $row['Warranty_End']->format('d-m-Y') : '-';
                            $guaranteeStart = $row['Guarantee_Start'] ? $row['Guarantee_Start']->format('d-m-Y') : '-';
                            $guaranteeEnd = $row['Guarantee_End'] ? $row['Guarantee_End']->format('d-m-Y') : '-';

                            echo '<tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 hover:scale-104 hover:shadow-lg">';
                            echo '<td class="px-6 py-4">' . $srno++ . '</td>';
                            echo '<td class="px-6 py-4">' . htmlspecialchars($row['Company_Name']) . '</td>';
                            echo '<td class="px-6 py-4">' . htmlspecialchars($row['Serial_Number']) . '</td>';
                            echo '<td class="px-6 py-4">' . htmlspecialchars($row['Warranty_Type']) . '</td>';
                            echo '<td class="px-6 py-4">' . $warrantyStart . ' → ' . $warrantyEnd . '</td>';
                            echo '<td class="px-6 py-4">' . htmlspecialchars($row['Guarantee_Type']) . '</td>';
                            echo '<td class="px-6 py-4">' . $guaranteeStart . ' → ' . $guaranteeEnd . '</td>';
                            echo '</tr>';
                        }
                    }else{
                        echo '<tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 hover:scale-104 hover:shadow-lg">';
                        echo '<td class="px-6 py-4 text-center" colspan="7">All items are already assigned.</td>';
                        echo '</tr>';
                    }
                    
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
