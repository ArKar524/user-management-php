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
                    <li class="p-4 hover:bg-gray-700">Users</li>
                </a>
                <?php endif; ?>
                <?php if (checkPermission('Role', 'read')): ?>
                <a href="<?php echo ROOT; ?>url=role">
                    <li class="p-4 bg-indigo-500 hover:bg-gray-700">Roles</li>
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
        <div class="lg:mt-10  mt-16 px-8 flex justify-between">
            <div class="text-xl"> Roles</div>
            <div class="p-2 text-xl bg-indigo-400 rounded">
                <a href="<?php echo ROOT; ?>url=role">Back</a>
            </div>
        </div>

        <!-- Page Content -->
        <div class="p-8 mt-5 lg:mt-0  overflow-x-auto ">
            <form action="<?php echo ROOT; ?>url=role/update/<?php echo $role[0]->role_id ?>" method="post"
                class="mx-auto">
                <div class="relative z-0 w-full mb-5 group">
                    <input type="text" name="name" id="name" value="<?php echo $role[0]->role_name ?>"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-gray-900 dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" " required />
                    <label for="name"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        Name
                    </label>
                    <div class="mt-5">
                        <label class="text-lg font-bold">Role and Permission</label>
                        <?php foreach ($features as $feature): ?>
                        <div class="grid grid-cols-4 gap-2 p-2 border-t border-gray-600 font-medium">
                            <div class="">
                                <?php echo $feature->feature_name ?>
                            </div>
                            <div class="flex col-span-3">
                                <?php foreach ($feature->permissions as $permission): ?>
                                <?php
                                        $permissionIdsArray = explode(',', $role[0]->permission_ids);
                                        $isChecked = in_array($permission->permission_id, $permissionIdsArray) ? 'checked' : '';
                                        ?>
                                <div class="">
                                    <div class="flex items-center mb-4">
                                        <input id="<?php echo $permission->permission_id ?>"
                                            value="<?php echo $permission->permission_id ?>" <?php echo $isChecked; ?>
                                            name="permissions[]" type="checkbox"
                                            class="w-5 h-5 text-blue-600 bg-gray-100 border-gray-300 rounded dark:bg-gray-700 dark:border-gray-600">
                                        <label for="<?php echo $permission->permission_id ?>"
                                            class="ms-2 me-3 text-normal font-medium text-gray-900 dark:text-gray-800">
                                            <?php echo $permission->permission_name ?>
                                        </label>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <button type="submit" name="update-role"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
            </form>

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
                    <li class="p-4 hover:bg-gray-700">Users</li>
                </a>
                <?php endif; ?>
                <?php if (checkPermission('Role', 'read')): ?>
                <a href="<?php echo ROOT; ?>url=role">
                    <li class="p-4 bg-indigo-500 hover:bg-gray-700">Roles</li>
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