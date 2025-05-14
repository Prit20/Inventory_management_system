<?php
// ob_start(); 
// session_start();

// if (!isset($_SESSION['user'])) {
//     header("Location: ../auth/login.php");
//     exit;
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Inventory System</title>
  
  <script src="https://cdn.tailwindcss.com"></script>
  <script>tailwind.config = { darkMode: 'class' };</script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
  <link rel="stylesheet" href="../assets/css/style.css"/>
  <script src="https://unpkg.com/lucide@latest"></script>

  <!-- DataTables CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
</head>
<style>
    /* Make the header sticky at the top */
.sticky-header {
    position: sticky;
    top: 0;
    /* z-index: 1000; Ensure the header stays above other content */
    background-color: #fff; /* Set a solid background to avoid transparency issues */
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Optional: Adds a shadow effect */
    width: 100%;
}
</style>
<!-- HEADER -->
<div class="sticky-header">
<header class="flex items-center justify-between px-6 py-4 bg-white dark:bg-gray-800 shadow-md z-10" style ="width: auto;">
    <button class="text-xl" id="menu-toggle"><i class="fa fa-bars"></i></button>

    <div class="flex items-center gap-4">
        <button id="darkToggle" class="mode-toggle text-xl">
            <i class="fa fa-moon"></i>
        </button>
        <button class="relative">
            <i class="fa fa-bell"></i><span class="notification-dot"></span>
        </button>
        <button class="flex items-center gap-2">
            <i class="fa fa-user-circle"></i> <span><?= $_SESSION['username'] ?? 'User' ?></span>
        </button>
        <a href="../auth/logout.php" class="text-sm text-red-600 font-semibold ml-3">Logout</a>
    </div>
</header>
</div>
