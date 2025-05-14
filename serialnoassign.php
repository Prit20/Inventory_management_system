<?php include '../includes/sidebar.php'; ?>
<?php include '../includes/header.php'; ?>
<style>
    #assignedTable {
  width: 100% !important;
  table-layout: auto;
}

    </style>

<div class="main-content p-6 transition-all duration-300 dark:bg-gray-900 dark:text-gray-100 min-h-screen">
    <h2 class="mb-6 text-3xl font-extrabold tracking-tight text-gray-800 dark:text-gray-100">Serial No Assign</h2>

    <!-- Tailwind Tabs -->
    <div class="mb-6 border-b border-gray-300 dark:border-gray-700">
        <ul class="flex flex-wrap text-sm font-medium text-center" id="assignTabs" role="tablist">
            <li class="me-2">
            <button id="unassigned-tab" data-tab-target="#unassigned" type="button"
    class="tab-button inline-block px-4 py-2 border-b-2 border-transparent rounded-t-lg text-gray-600 hover:text-blue-600 hover:border-blue-300 dark:text-gray-300 dark:hover:text-blue-400"
    role="tab">Unassigned</button>
            </li>
            <li class="me-2">
                <button id="assigned-tab" data-tab-target="#assigned" type="button"
                    class="tab-button inline-block px-4 py-2 border-b-2 border-transparent rounded-t-lg text-gray-600 hover:text-blue-600 hover:border-blue-300 dark:text-gray-300 dark:hover:text-blue-400"
                    role="tab">Assigned</button>
            </li>
        </ul>
    </div>

    <div class="tab-content">
        <!-- Unassigned Table -->
        <div id="unassigned" class="tab-pane">
            <div class="overflow-auto rounded-lg shadow bg-white dark:bg-gray-800  p-2">
                <table id="unassignedTable"
                    class="w-full text-sm text-left text-gray-700 dark:text-gray-200 whitespace-nowrap">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-300">
                        <tr>
                            <th class="px-4 py-3">Sr No</th>
                            <th class="px-4 py-3">Location</th>
                            <th class="px-4 py-3">PO No</th>
                            <th class="px-4 py-3">Invoice No</th>
                            <th class="px-4 py-3">Party Name</th>
                            <th class="px-4 py-3">Item</th>
                            <th class="px-4 py-3">Qty</th>
                            <th class="px-4 py-3">Basic Rate</th>
                            <th class="px-4 py-3">Remarks</th>
                            <th class="px-4 py-3">Category</th>
                            <th class="px-4 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>

        <!-- Assigned Table -->
        <div id="assigned" class="tab-pane hidden">
            <div class="overflow-auto rounded-lg shadow bg-white dark:bg-gray-800 p-2">
                <table id="assignedTable"
                    class="w-full text-sm text-left text-gray-700 dark:text-gray-200 whitespace-nowrap">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-300">
                        <tr>
                            <th class="px-4 py-3">Id</th>
                            <th class="px-4 py-3">Serial No</th>
                            <th class="px-4 py-3">Location</th>
                            <th class="px-4 py-3">PO No</th>
                            <th class="px-4 py-3">Invoice No</th>
                            <th class="px-4 py-3">Party Name</th>
                            <th class="px-4 py-3">Item</th>
                            <th class="px-4 py-3">Qty</th>
                            <th class="px-4 py-3">Basic Rate</th>
                            <th class="px-4 py-3">Remarks</th>
                            <th class="px-4 py-3">Category</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>

    <?php include '../includes/footer.php'; ?>
</div>

<!-- Scripts (same as before) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

<script>
$(document).ready(function () {
    let unassignedTable = $('#unassignedTable').DataTable({
        ajax: {
            url: '../backend/db_serialnoassign.php?status=unassigned',
            dataSrc: 'data'
        },
        columns: [
            { data: 'Sr_No' },
            { data: 'Location' },
            { data: 'PO_No' },
            { data: 'Invoice_No' },
            { data: 'Party_Name' },
            { data: 'Item' },
            { data: 'Qty' },
            { data: 'Basic_Rate' },
            { data: 'Remarks' },
            { data: 'Category_Name' },
            {
                data: 'Id',
                render: function (data) {
                    return `<a href="serialnoassign_form.php?id=${data}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-3 py-1 rounded text-xs">Assign Serial</a>`;
                }
            }
        ],
        dom: 'Bfrtip',
        buttons: ['copy', 'excel', 'pdf'],
        responsive: true,
        scrollX: true
    });

    let assignedTable = $('#assignedTable').DataTable({
        ajax: {
            url: '../backend/db_serialnoassign.php?status=assigned',
            dataSrc: 'data'
        },
        columns: [
            { data: 'Sr_No' },
            { data: 'Serial_Number' },
            { data: 'Location' },
            { data: 'PO_No' },
            { data: 'Invoice_No' },
            { data: 'Party_Name' },
            { data: 'Item' },
            { data: 'Qty' },
            { data: 'Basic_Rate' },
            { data: 'Remarks' },
            { data: 'Category_Name' }
        ],
        dom: 'Bfrtip',
        buttons: ['copy', 'excel', 'pdf'],
        responsive: true,
        scrollX: true
    });

    // Tab Switch Handler
    document.querySelectorAll('.tab-button').forEach(button => {
    button.addEventListener('click', () => {
        // Remove active classes from all buttons
        document.querySelectorAll('.tab-button').forEach(btn => {
            btn.classList.remove('text-blue-600', 'border-blue-600', 'dark:text-blue-500', 'dark:border-blue-500');
            btn.classList.add('text-gray-500', 'border-transparent');
        });

        // Add active classes to clicked button
        button.classList.remove('text-gray-500', 'border-transparent');
        button.classList.add('text-blue-600', 'border-blue-600', 'dark:text-blue-500', 'dark:border-blue-500');

        // Hide all tab panes
        document.querySelectorAll('.tab-pane').forEach(tab => tab.classList.add('hidden'));

        // Show the target tab pane
        const target = button.getAttribute('data-tab-target');
        document.querySelector(target).classList.remove('hidden');

        // Reload DataTables
        if (target === '#assigned') {
            assignedTable.ajax.reload();
            assignedTable.columns.adjust().draw();
        } else if (target === '#unassigned') {
            unassignedTable.ajax.reload();
            unassignedTable.columns.adjust().draw();
        }
    });
});

});
</script>
