<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //superAdmin------------------
        Role::create(['name' => 'admin']);
        $superAdmin = Role::find(1);


        $permission = Permission::create(['name' => 'admin-permission']);
        $superAdmin->givePermissionTo($permission);
        //--------------------------------------------

        //branch-manager------------------
        Role::create(['name' => 'branch-manager']);
        $branchManger = Role::find(2);

        $permission = Permission::create(['name' => 'branch-manager-permission']);
        $branchManger->givePermissionTo($permission);
        //----------------------------------------------

        //call-center------------------
        Role::create(['name' => 'call-center']);
        $callCenter = Role::find(3);

        $permission = Permission::create(['name' => 'call-center-permission']);
        $callCenter->givePermissionTo($permission);
        //----------------------------------------------

        //account-manager------------------
        Role::create(['name' => 'account-manager']);
        $accountManager = Role::find(4);

        $permission = Permission::create(['name' => 'account-manager-permission']);
        $accountManager->givePermissionTo($permission);
        //----------------------------------------------

        //data-enterer------------------
        Role::create(['name' => 'data-enterer']);
        $dataEnterer = Role::find(5);

        $permission = Permission::create(['name' => 'data-enterer-permission']);
        $dataEnterer->givePermissionTo($permission);
        //----------------------------------------------

        //embassy------------------
        Role::create(['name' => 'embassy']);
        $embassy = Role::find(6);

        $permission = Permission::create(['name' => 'embassy-permission']);
        $embassy->givePermissionTo($permission);
        //----------------------------------------------

        //Normal User------------------
        Role::create(['name' => 'normal-user']);
        $embassy = Role::find(7);

        $permission = Permission::create(['name' => 'normal-user-permission']);
        $embassy->givePermissionTo($permission);
        //----------------------------------------------

        //corporate User------------------
        Role::create(['name' => 'corporate-user']);
        $embassy = Role::find(8);

        $permission = Permission::create(['name' => 'corporate-user-permission']);
        $embassy->givePermissionTo($permission);
        //----------------------------------------------
    }
}
