<?php
class User extends Controller
{
    function __construct()
    {
        auth();
    }
    public function index()
    {
        $user = new UserModel();
        $users = $user->getAllUsersWithRoles();

        $this->view('user/index', ['users' => $users]);
    }

    public function create()
    {
        $role = new RoleModel();
        $roles = $role->all();
        $this->view('user/create', ['roles' => $roles]);
    }
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name'],
                'username' => $_POST['username'],
                'email' => $_POST['email'],
                'phone' => $_POST['phone'],
                'password' => $_POST['password'],
                'address' => $_POST['address'],
                'gender' => $_POST['gender'],
                'role_id' => $_POST['role_id'],
                'is_active' => $_POST['is_active'],
            ];

            $user = new UserModel();
            $user->insert($data);
            header('Location: ' . ROOT . 'url=user');
        }
    }

    public function edit($id)
    {
        $user = new UserModel();
        $role = new RoleModel();
        $roles = $role->all();
        $user = $user->find($id);
        // dd($user);
        $this->view('user/edit', ['user' => $user, 'roles' => $roles]);
    }

    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name'],
                'username' => $_POST['username'],
                'email' => $_POST['email'],
                'phone' => $_POST['phone'],
                'password' => $_POST['password'],
                'address' => $_POST['address'],
                'gender' => $_POST['gender'],
                'role_id' => $_POST['role_id'],
                'is_active' => $_POST['is_active'],
            ];
            $user = new UserModel();
            $user->update($id, $data);
            header('Location: ' . ROOT . 'url=user');
        }
    }
    public function delete($id)
    {
        $user = new UserModel();
        $user->delete($id);
        header('Location: ' . ROOT . 'url=user');
    }
}