<?php
class PermissionModel
{
    use Model;

    protected $table = 'permissions';

    protected $allowedColumns = [
        'name',
        'feature_id'
    ];

    public function getAllUsersWithRoles()
    {
        $query = "SELECT permission.*, roles.name AS role_name
              FROM users
              LEFT JOIN roles ON permission.id = roles.perid";
        return $this->query($query);
    }

    public function seedPermissions()
    {
        $data = [
            ['name' => 'create', 'feature_id' => '1'],
            ['name' => 'read', 'feature_id' => '1'],
            ['name' => 'update', 'feature_id' => '1'],
            ['name' => 'delete', 'feature_id' => '1'],
            ['name' => 'create', 'feature_id' => '2'],
            ['name' => 'read', 'feature_id' => '2'],
            ['name' => 'update', 'feature_id' => '2'],
            ['name' => 'delete', 'feature_id' => '2'],

        ];
        createData('PermissionModel', $data);
    }
}