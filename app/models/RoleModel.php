<?php
class RoleModel
{
    use Model;

    protected $table = 'roles';
    protected $allowedColumns = [
        'name',
    ];

    public function getRolePermission($roleId)
    {
        $query = "
        SELECT permissions.*
        FROM permissions
        INNER JOIN role_permissions ON permissions.id = role_permissions.permission_id
        INNER JOIN roles ON role_permissions.role_id = roles.id
        WHERE roles.id = ?
    ";

        return $this->query($query, [$roleId]);
    }


    public function getAllRole()
    {
        $query = "SELECT * FROM roles";
        return $this->query($query); // Fetch multiple rows
    }

    public function getRoleWithPermissions($roleId)
    {
        $query = "
        SELECT 
            roles.id AS role_id,
            roles.name AS role_name,
            GROUP_CONCAT(DISTINCT role_permissions.permission_id) AS permission_ids
        FROM roles
        INNER JOIN role_permissions ON roles.id = role_permissions.role_id
        WHERE roles.id = :roleId
        GROUP BY roles.id, roles.name
    ";

        return $this->query($query, ['roleId' => $roleId]);
    }

    public function getAllFeatureWithPermissions()
    {
        $query = "
             SELECT features.id As feature_id,features.name AS feature_name, permissions.id As permission_id, permissions.name AS permission_name
              FROM features
              LEFT JOIN permissions ON features.id = permissions.feature_id 
              ";

        $results = $this->query($query);

        // return $results;
        // Grouping the results by role into stdClass objects
        $groupedData = [];
        foreach ($results as $row) {
            $featureId = $row->feature_id;

            // Create a new stdClass object for each role if it doesn't exist
            if (!isset($groupedData[$featureId])) {
                $feature = new stdClass();
                $feature->feature_id = $row->feature_id;
                $feature->feature_name = $row->feature_name;
                $feature->permissions = [];
                $groupedData[$featureId] = $feature;
            }

            // Add permissions as stdClass objects
            $permission = new stdClass();
            $permission->permission_id = $row->permission_id;
            $permission->permission_name = $row->permission_name;

            $groupedData[$featureId]->permissions[] = $permission;
        }

        // Return the grouped data as an array of stdClass objects
        return array_values($groupedData);
    }

    public function seedRole()
    {
        $data = [
            ['name' => 'admin'],
            ['name' => 'operator'],
        ];
        createData('RoleModel', $data);
    }
}