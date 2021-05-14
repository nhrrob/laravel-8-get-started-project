<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        //Create Roles
        $roleSuperAdmin = Role::create(['name' => 'super-admin']);
        $roleAdmin = Role::create(['name' => 'admin']);
        $userAdmin = Role::create(['name' => 'user']);

        //Create Permissions and Assign Role
        $permissions = $this->getPermissions();

        for ($i = 0; $i < count($permissions); $i++) {
            $permissionGroup = $permissions[$i]['group_name'];
            for ($j = 0; $j < count($permissions[$i]['permissions']); $j++) {
                $permission = Permission::create(['name' => $permissions[$i]['permissions'][$j], 'group_name' => $permissionGroup]);

                //Super Admin: Role 1
                //Using Gate::before() => Super admin has access to all features by default : AuthServiceProvider@boot

                //Admin: Role 2
                $permission->assignRole($roleAdmin);

                //User: Role 3
                if (
                    $permissionGroup == 'dashboard'
                    // || $permissionGroup == 'demogroup' 
                ) {
                    $permission->assignRole($userAdmin);
                }

            }
        }
    }

    public function permissionItem($groupName, $viewOnly=0){
        $permissions = [
            "$groupName list",
            "$groupName create",
            "$groupName view",
            "$groupName edit",
            "$groupName delete",
        ];

        $permissions = $viewOnly ? ["$groupName view"] : $permissions; 
        
        $permissionItem = [
            'group_name'  => "$groupName",
            'permissions' => $permissions
        ];
        
        return $permissionItem;
    }

    //Generate Permission Array
    public function getPermissions(){
        $permissions = [];
        $permissions[] = $this->permissionItem('dashboard',1);
        
        $permissionGroups = ['user', 'admin', 'role', 'permission', 'product', 'project'];

        foreach($permissionGroups as $permissionGroup){
            $permissions[] = $this->permissionItem($permissionGroup);
        }

        return $permissions;
    }
}
