<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;


class StaffRolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');

        // Clear existing roles and permissions
        DB::table('roles')->truncate();

        // Enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

        // Create roles and assign permissions
        $adminRole = Role::create(['name' => 'admin', 'guard_name' => 'staff']);
        $adminRole->syncPermissions(['view books', 'edit books', 'delete books', 'manage staff', 'assign books']);

        $viewerRole = Role::create(['name' => 'viewer', 'guard_name' => 'staff']);
        $viewerRole->givePermissionTo('view books');

        $editorRole = Role::create(['name' => 'editor', 'guard_name' => 'staff']);
        $editorRole->syncPermissions(['view books', 'edit books', 'assign books']);

        // Create 'reader' role and assign permission
        $readerRole = Role::create(['name' => 'reader', 'guard_name' => 'reader']);
        $readerRole->givePermissionTo('see borrow history');

    }
}
