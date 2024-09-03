<?php
class Role extends Controller
{
    function __construct()
    {
        auth();
    }
    public function index()
    {
        $roleModel = new RoleModel();
        $roles = $roleModel->getAllRole();
        // dd($roles);

        $this->view('role/index', ['roles' => $roles]);
    }

    public function create()
    {
        $role = new RoleModel();
        $roles = $role->all();
        $features = $role->getAllFeatureWithPermissions();
        // dd($features);
        $this->view('role/create', ['roles' => $roles, 'features' => $features]);
    }
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name'],
                'permissions' => $_POST['permissions'],

            ];
            $roleModel = new RoleModel();
            $role = $roleModel->insert(['name' => $data['name']]);
            $role = $roleModel->find($data['name'], 'name');
            // dd($role);
            $rolePermissions = new RolePermissionModel();

            foreach ($data['permissions'] as $permission) {
                $rolePermissions->insert([
                    'role_id' => $role->id,
                    'permission_id' => $permission
                ]);
            }
            header('Location: ' . ROOT . 'url=role');
        }
    }

    public function edit($id)
    {
        $roleModel = new RoleModel();
        $role = $roleModel->getRoleWithPermissions($id);
        $features = $roleModel->getAllFeatureWithPermissions();
        // dd($role);
        $this->view('role/edit', ['role' => $role, 'features' => $features]);
    }

    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name'],
                'permissions' => $_POST['permissions'],
            ];
            $user = new RoleModel();
            $user->update($id, ['name' => $data['name']]);
            $rolePermissions = new RolePermissionModel();
            $rolePermissions->delete($id, 'role_id');
            foreach ($data['permissions'] as $permission) {
                $rolePermissions->insert([
                    'role_id' => $id,
                    'permission_id' => $permission
                ]);
            }
            header('Location: ' . ROOT . 'url=role');
        }
    }
    public function delete($id)
    {
        $role = new RoleModel();
        $rolePermissions = new RolePermissionModel();
        $rolePermissions->delete($id, 'role_id');
        $role->delete($id);
        header('Location: ' . ROOT . 'url=role');
    }
}