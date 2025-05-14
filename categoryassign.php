<style>
/* Make the 2 rightmost columns sticky */
#categoryTable th:nth-last-child(2),
#categoryTable td:nth-last-child(2),
#categoryTable th:last-child,
#categoryTable td:last-child {
    position: sticky;
    right: 80px;
    background: rgb(243, 244, 246); /* Tailwind gray-100 */
    z-index: 2;
}
#categoryTable th:last-child,
#categoryTable td:last-child {
    right: 0;
    background: rgb(243, 244, 246);
}
</style>

<?php include '../includes/sidebar.php'; ?>
<?php include '../includes/header.php'; ?>

<div class="main-content p-6 transition-all duration-300 dark:bg-gray-900 dark:text-gray-100">
    <h2 class="text-2xl font-bold mb-6 border-b pb-2">Category Assign</h2>

    <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow rounded-lg p-4">
        <table id="categoryTable" class="stripe hover w-full text-sm text-left whitespace-nowrap" style="width: 100%;">
            <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 text-sm uppercase">
                <tr>
                    <th class="px-4 py-2">Sr No</th>
                    <th class="px-4 py-2">Location</th>
                    <th class="px-4 py-2">PO No</th>
                    <th class="px-4 py-2">Invoice No</th>
                    <th class="px-4 py-2">Party Name</th>
                    <th class="px-4 py-2">Item</th>
                    <th class="px-4 py-2">Qty</th>
                    <th class="px-4 py-2">Basic Rate</th>
                    <th class="px-4 py-2">Remarks</th>
                    <th class="px-4 py-2">Category Assign</th>
                    <th class="px-4 py-2">Action</th>
                </tr>
            </thead>
        </table>
    </div>

    <?php include '../includes/footer.php'; ?>
</div>

<!-- Scripts -->
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
$(document).ready(function() {
    const table = $('#categoryTable').DataTable({
        "ajax": "../backend/db_categoryassign.php",
        "columns": [
            { "data": "sr_no" },
            { "data": "location" },
            { "data": "po_no" },
            { "data": "invoice_no" },
            { "data": "party_name" },
            { "data": "item" },
            { "data": "qty" },
            { "data": "basic_rate" },
            { "data": "p_remark" },
            {
                "data": null,
                "render": function(data, type, row) {
                    return `
                        <select class="category-dropdown text-sm rounded-md border border-gray-300 px-2 py-1 text-gray-800 focus:ring-2 focus:ring-blue-500" data-sr="${row.sr_no}">
                            <option value="">Select Category</option>
                        </select>
                    `;
                }
            },
            {
                "data": null,
                "render": function(data, type, row) {
                    return `
                        <button class="save-category-btn bg-blue-600 hover:bg-blue-700 text-white text-sm px-3 py-1 rounded-md" data-sr="${row.sr_no}">
                            Save
                        </button>
                    `;
                }
            }
        ],
        dom: 'Bfrtip',
        buttons: ['copy', 'excel', 'pdf'],
        responsive: true,
        scrollX: true,
        initComplete: function() {
            loadCategoryDropdowns();
        },
        drawCallback: function() {
            loadCategoryDropdowns();
        }
    });

    function loadCategoryDropdowns() {
        $.ajax({
            url: '../backend/db_categoryassign.php',
            method: 'POST',
            data: { action: 'getcategories' },
            dataType: 'json',
            success: function(response) {
                $('.category-dropdown').each(function() {
                    let dropdown = $(this);
                    let currentVal = dropdown.val();
                    dropdown.empty().append('<option value="">Select Category</option>');
                    response.forEach(category => {
                        dropdown.append(`<option value="${category.id}">${category.name}</option>`);
                    });
                    dropdown.val(currentVal);
                });
            }
        });
    }

    $(document).on('click', '.save-category-btn', function() {
        let row1 = $(this).closest('tr');
        let srNo = $(this).data('sr');
        let categoryId = $(`.category-dropdown[data-sr="${srNo}"]`).val();
        let categoryName = $(`.category-dropdown[data-sr="${srNo}"] option:selected`).text();

        if (categoryId === "") {
            alert("Please select a category.");
            return;
        }

        let rowData = table.row(row1).data();

        $.ajax({
            url: '../backend/db_categoryassign.php',
            method: 'POST',
            data: {
                action: 'savecategoryassign',
                sr_no: rowData.sr_no,
                location: rowData.location,
                po_no: rowData.po_no,
                invoice_no: rowData.invoice_no,
                party_name: rowData.party_name,
                item: rowData.item,
                qty: rowData.qty,
                basic_rate: rowData.basic_rate,
                remarks: rowData.p_remark,
                category_id: categoryId,
                category_name: categoryName
            },
            success: function(response) {
                if (response.trim() === 'success') {
                    row1.fadeOut(300, function() {
                        table.row(row1).remove().draw(false);
                    });
                } else {
                    alert("Error saving category assignment.");
                }
            },
            // error: function() {
            //     alert("Error saving category assignment.");
            // }
        });
    });
});
</script>
