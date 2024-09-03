<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex min-h-screen bg-gray-100">

    <!-- Sidebar -->
    <div id="sidebar"
        class="fixed inset-y-0 left-0 w-64 bg-gray-800 text-white transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out lg:static lg:w-64 lg:h-screen">
        <div class="p-4 text-2xl font-bold border-b border-gray-700">
            <?php echo $_SESSION['authUser']->name ?>
        </div>
        <nav class="mt-5">
            <ul>
                <a href="<?php echo ROOT; ?>url=home">
                    <li class="p-4 bg-indigo-500 hover:bg-gray-700">Dashboard</li>
                </a>
                <?php if (checkPermission('User', 'read')): ?>
                <a href="<?php echo ROOT; ?>url=user">
                    <li class="p-4 hover:bg-gray-700">Users</li>
                </a>
                <?php endif; ?>
                <?php if (checkPermission('Role', 'read')): ?>
                <a href="<?php echo ROOT; ?>url=role">
                    <li class="p-4 hover:bg-gray-700">Roles</li>
                </a>
                <?php endif; ?>
                <a href="<?php echo ROOT; ?>url=auth/logout">
                    <li class="p-4 hover:bg-gray-700">Logout</li>
                </a>
            </ul>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col ml-0 ">

        <!-- Mobile Navbar -->
        <div class="lg:hidden bg-white shadow p-4 fixed w-full top-0 z-10 flex justify-between items-center">
            <div class="text-xl font-semibold">MyApp</div>
            <button id="sidebar-toggle" class="text-gray-600 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7">
                    </path>
                </svg>
            </button>
        </div>


        <!-- Desktop Navbar -->
        <div class="hidden lg:block bg-white shadow p-4 fixed w-full top-0 z-10">
            <div class="flex justify-between items-center">
                <div class="text-xl font-semibold">Dashboard</div>
                <div class="flex items-center space-x-4">
                    <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">New Post</button>
                    <div class="relative">
                        <img src="https://via.placeholder.com/40" alt="User" class="rounded-full w-10 h-10">
                        <span
                            class="absolute bottom-0 right-0 block h-3 w-3 rounded-full ring-2 ring-white bg-green-400"></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Page Content -->
        <div class="p-8 mt-16 lg:mt-20">
            <h1 class="text-3xl font-bold">Welcome to the Dashboard</h1>
            <p class="mt-4">This is where your main content goes.</p>
        </div>
    </div>

    <!-- Mobile Sidebar -->
    <div id="mobile-sidebar"
        class="fixed inset-0 bg-gray-800 text-white transform -translate-x-full lg:hidden transition-transform duration-300 ease-in-out">
        <div class="p-4 text-2xl font-bold border-b border-gray-700">MyApp</div>
        <nav class="mt-5">
            <ul>
                <a href="<?php echo ROOT; ?>url=home">
                    <li class="p-4 bg-indigo-500 hover:bg-gray-700">Dashboard</li>
                </a>
                <?php if (checkPermission('User', 'read')): ?>
                <a href="<?php echo ROOT; ?>url=user">
                    <li class="p-4 hover:bg-gray-700">Users</li>
                </a>
                <?php endif; ?>
                <?php if (checkPermission('Role', 'read')): ?>
                <a href="<?php echo ROOT; ?>url=role">
                    <li class="p-4 hover:bg-gray-700">Roles</li>
                </a>
                <?php endif; ?>
                <a href="<?php echo ROOT; ?>url=auth/logout">
                    <li class="p-4 hover:bg-gray-700">Logout</li>
                </a>
            </ul>
        </nav>
    </div>

    <script>
    document.getElementById('sidebar-toggle').addEventListener('click', function() {
        const sidebar = document.getElementById('mobile-sidebar');
        sidebar.classList.toggle('-translate-x-full');
    });
    </script>

</body>

</html>