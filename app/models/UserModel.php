<?php
class UserModel
{
    use Model;

    protected $table = 'users';

    protected $allowedColumns = [
        'name',
        'username',
        'email',
        'password',
        'phone',
        'address',
        'gender',
        'role_id',
        'is_active',
    ];

    public function getAllUsersWithRoles()
    {
        $query = "
        SELECT users.*, roles.name AS role_name
            FROM users
            LEFT JOIN roles ON users.role_id = roles.id
        ";
        return $this->query($query);
    }

    public function getUserWithRole($userId)
    {
        $query = "
        SELECT 
            users.id AS user_id,
            users.name,
            users.email,
            roles.id AS role_id,
            roles.name AS role_name
        FROM users
        INNER JOIN roles ON users.role_id = roles.id
        WHERE users.id = :userId
    ";
        return $this->query($query, ['userId' => $userId]);
    }

    // }
    function userHasPermission($userId, $featureName, $permissionName)
    {
        // Get the role_id for the user
        $roleQuery = "
        SELECT roles.id AS role_id
        FROM users
        JOIN roles ON users.role_id = roles.id
        WHERE users.id = :user_id
    ";
        $roleResult = $this->query($roleQuery, ['user_id' => $userId]);

        if (!$roleResult) {
            return false;
        }

        $roleId = $roleResult[0]->role_id;

        // Get the feature_id for the feature name
        $featureQuery = "
        SELECT id AS feature_id
        FROM features
        WHERE name = :feature_name
    ";
        $featureResult = $this->query($featureQuery, ['feature_name' => $featureName]);

        if (!$featureResult) {
            return false;
        }

        $featureId = $featureResult[0]->feature_id;

        // Get the permission_id for the permission name
        $permissionQuery = "
        SELECT id AS permission_id
        FROM permissions
        WHERE name = :permission_name AND feature_id = :feature_id
    ";
        $permissionResult = $this->query($permissionQuery, [
            'permission_name' => $permissionName,
            'feature_id' => $featureId
        ]);

        if (!$permissionResult) {
            return false;
        }

        $permissionId = $permissionResult[0]->permission_id;

        // Check if the role has the permission
        $checkQuery = "
        SELECT 1
        FROM role_permissions
        WHERE role_id = :role_id AND permission_id = :permission_id
    ";
        $checkResult = $this->query($checkQuery, [
            'role_id' => $roleId,
            'permission_id' => $permissionId
        ]);

        return $checkResult !== false; // Returns true if permission exists, false otherwise
    }

    public function seedUser()
    {
        $data = [
            [
                'name' => 'John Doe',
                'username' => 'johndoe',
                'email' => 'johndoe@example.com',
                'password' => 'password',
                'phone' => '1234567890',
                'address' => '123 Main St',
                'gender' => '1',
                'role_id' => 1,
                'is_active' => 1
            ],
            [
                'name' => 'Jane Doe',
                'username' => 'janedoe',
                'email' => 'janedoe@example.com',
                'password' => 'password',
                'phone' => '0987654321',
                'address' => '456 Elm St',
                'gender' => 0,
                'role_id' => 2,
                'is_active' => 1
            ],
        ];

        createData('UserModel', $data);
    }

}