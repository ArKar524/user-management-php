<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>

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
        <div class="lg:mt-10  mt-16 px-8 flex justify-between">
            <div class="text-xl"> Users</div>
            <div class="p-2 text-xl bg-indigo-400 rounded">
                <a href="<?php echo ROOT; ?>url=user">Back</a>
            </div>
        </div>
        <!-- Page Content -->
        <div class="p-8 mt-5 lg:mt-0 relative overflow-x-auto ">
            <form action="<?php echo ROOT; ?>url=user/update/<?php echo $user->id ?>" method="post"
                class="max-w-md mx-auto">
                <div class="relative z-0 w-full mb-5 group">
                    <input type="text" name="name" id="name" value="<?php echo $user->name; ?>"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-gray-900 dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" " required />
                    <label for="name"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        Name
                    </label>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <input type="text" name="username" id="user_name" value="<?php echo $user->username; ?>"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-gray-900 dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" " required />
                    <label for="user_name"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        User Name
                    </label>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <input type="email" name="email" id="floating_email" value="<?php echo $user->email; ?>"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-gray-900 dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" " required />
                    <label for="floating_email"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        Email
                    </label>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <input type="text" name="phone" id="phone" value="<?php echo $user->phone; ?>"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-gray-900 dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" " required />
                    <label for="phone"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        Phone
                    </label>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <input type="password" name="password" id="floating_password" value="<?php echo $user->password; ?>"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-gray-900 dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" " required />
                    <label for="floating_password"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Password</label>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <input type="text" name="address" id="floating_repeat_password"
                        value="<?php echo $user->address; ?>"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-gray-900 dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" " required />
                    <label for="floating_repeat_password"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        Address
                    </label>
                </div>
                <div class="">
                    <label class="text-normal font-medium text-gray-900 dark:text-gray-900">Select Gender</label>
                    <div class="flex items-center mb-4">
                        <input id="male" type="radio" value="1" name="gender" <?php if ($user->gender == '1')
                            echo 'checked'; ?>
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300  dark:bg-gray-700 dark:border-gray-600">
                        <label for="male" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-900">Male</label>
                    </div>
                    <div class="flex items-center">
                        <input id="female" type="radio" value="0" name="gender" <?php if ($user->gender == '0')
                            echo 'checked'; ?> class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300  dark:bg-gray-700 ">
                        <label for="female"
                            class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-900">Female</label>
                    </div>
                </div>
                <div class="flex items-center my-4">
                    <input type="hidden" name="is_active" value="0">

                    <input id="default-checkbox" name="is_active" type="checkbox" value="1" <?php if ($user->is_active == '1')
                        echo 'checked'; ?>
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="default-checkbox"
                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-900">Active</label>
                </div>



                <!-- Dropdown menu -->
                <div class="relative z-0 w-full mb-5 group">
                    <label for="role" class="block text-sm text-gray-500 dark:text-gray-400 mb-2">
                        Role
                    </label>
                    <select name="role_id" id="role"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-gray-900 dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        required>
                        <option value="" disabled selected>Select a role</option>
                        <?php foreach ($roles as $role): ?>
                            <option value="<?php echo $role->id; ?>" <?php if ($role->id == $user->role_id)
                                   echo 'selected'; ?>><?php echo $role->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>



                <button type="submit" name="create-user"
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

    <script>
        document.getElementById('sidebar-toggle').addEventListener('click', function () {
            const sidebar = document.getElementById('mobile-sidebar');
            sidebar.classList.toggle('-translate-x-full');
        });
    </script>



</body>

</html>