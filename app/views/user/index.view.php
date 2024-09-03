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
                    <li class="p-4  hover:bg-gray-700">Dashboard</li>
                </a>
                <?php if (checkPermission('User', 'read')): ?>
                <a href="<?php echo ROOT; ?>url=user">
                    <li class="p-4 bg-indigo-500 hover:bg-gray-700">Users</li>
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
    <div class="flex-1 flex flex-col  ">

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
        <div class="lg:mt-10 mt-16 px-8 flex justify-between">
            <div class="text-xl"> Users</div>
            <?php if (checkPermission('User', 'create')): ?>
            <div class="p-2 text-xl bg-indigo-400 rounded">
                <a href="<?php echo ROOT; ?>url=user/create">Create</a>
            </div>
            <?php endif; ?>
        </div>
        <!-- Page Content -->
        <div class="p-8 mt-5 lg:mt-0 relative overflow-x-auto ">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Email
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Phone
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Role
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $index => $user): ?>
                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b
                        dark:border-gray-700">

                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <?php echo $user->name ?>
                        </th>

                        <td class="px-6 py-4">
                            <?php echo $user->email ?>
                        </td>
                        <td class="px-6 py-4">
                            <?php echo $user->phone ?>
                        </td>
                        <td class="px-6 py-4">
                            <?php echo $user->role_name ?>
                        </td>
                        <td class="px-6 py-4">
                            <?php if (checkPermission('User', 'update')): ?>
                            <a href="<?php echo ROOT; ?>url=user/edit/<?php echo $user->id; ?>"
                                class="font-medium me-2 text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                            <?php endif; ?>
                            <?php if (checkPermission('User', 'delete')): ?>
                            <a href="<?php echo ROOT; ?>url=user/delete/<?php echo $user->id; ?>"
                                class="font-medium text-blue-600 dark:text-red-500 hover:underline">Delete</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>

    </div>

    <!-- Mobile Sidebar -->
    <div id="mobile-sidebar"
        class="fixed inset-0 bg-gray-800 text-white transform -translate-x-full lg:hidden transition-transform duration-300 ease-in-out">
        <div class="p-4 text-2xl font-bold border-b border-gray-700">MyApp</div>
        <nav class="mt-5">
            <ul>
                <a href="<?php echo ROOT; ?>url=home">
                    <li class="p-4  hover:bg-gray-700">Dashboard</li>
                </a>
                <?php if (checkPermission('User', 'read')): ?>
                <a href="<?php echo ROOT; ?>url=user">
                    <li class="p-4  bg-indigo-500 hover:bg-gray-700">Users</li>
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