<?php
session_start();
if (isset($_SESSION['user'])) {
    header("Location: ../frontend/dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login - Inventory System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
    tailwind.config = {
        theme: {
            extend: {
                fontFamily: {
                    inter: ['Inter', 'sans-serif'],
                },
            }
        }
    }
    </script>
</head>
<!-- <body class="bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 min-h-screen flex items-center justify-center font-inter"> -->

<body class="bg-gray-100 min-h-screen flex items-center justify-center font-inter">

    <div class="bg-white rounded-xl shadow-2xl p-8 w-full max-w-md">
        <div class="text-center mb-6">
            <div class="mb-4 text-center">
                <img src="../assets/css/images/suyog-logo.jpg" alt="Suyog Electrical Pvt Ltd"
                    class="mx-auto h-20 w-auto mb-2">
            </div>
            <h2 class="text-2xl font-semibold text-gray-800">Inventory System Login</h2>
        </div>

        <form action="validate.php" method="POST" class="space-y-5">
            <!-- Employee ID -->
            <div>
                <label for="employee_id" class="block text-sm font-medium text-gray-700">Employee ID</label>
                <div class="mt-1 relative">
                    <input type="text" id="employee_id" name="employee_id" required
                        class="w-full px-4 py-2 pl-10 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M5.121 17.804A9.953 9.953 0 0112 15c2.485 0 4.747.91 6.879 2.404M15 10a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <div class="mt-1 relative">
                    <input type="password" id="password" name="password" required
                        class="w-full px-4 py-2 pl-10 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 11c0-1.104.896-2 2-2s2 .896 2 2-2 3-2 3-2-1.896-2-3zm-2 3v1a3 3 0 003 3h2a3 3 0 003-3v-1M9 19h6" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Submit -->
            <button type="submit"
                class="w-full py-2 px-4 bg-indigo-600 text-white rounded-lg font-semibold hover:bg-indigo-700 transition duration-200">
                Login
            </button>
        </form>

        <p class="mt-6 text-center text-sm text-gray-500">&copy; 2025 Inventory System. All rights reserved.</p>
    </div>

</body>

</html>