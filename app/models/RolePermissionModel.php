<?php
class RolePermissionModel
{
    use Model;

    protected $table = 'role_permissions';

    protected $allowedColumns = [
        'role_id',
        'permission_id',

    ];

    public function seedRole()
    {
        $data = [
            ['role_id' => '1', 'feature_id' => '1'],
            ['role_id' => '1', 'feature_id' => '2'],
            ['role_id' => '1', 'feature_id' => '3'],
            ['role_id' => '1', 'feature_id' => '4'],
            ['role_id' => '1', 'feature_id' => '5'],
            ['role_id' => '1', 'feature_id' => '6'],
            ['role_id' => '1', 'feature_id' => '7'],
            ['role_id' => '1', 'feature_id' => '8'],
            ['role_id' => '2', 'feature_id' => '1'],
            ['role_id' => '2', 'feature_id' => '2'],
            ['role_id' => '2', 'feature_id' => '3'],
            ['role_id' => '2', 'feature_id' => '5'],
            ['role_id' => '2', 'feature_id' => '6'],
            ['role_id' => '2', 'feature_id' => '7'],
        ];
        createData('RoleModel', $data);
    }
}