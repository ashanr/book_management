<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;


class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');

        DB::table('permissions')->truncate();

        // Enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

        //Staff
        Permission::create(['name' => 'view books', 'guard_name' => 'staff']);
        Permission::create(['name' => 'edit books', 'guard_name' => 'staff']);
        Permission::create(['name' => 'delete books', 'guard_name' => 'staff']);
        Permission::create(['name' => 'manage staff', 'guard_name' => 'staff']);
        Permission::create(['name' => 'assign books', 'guard_name' => 'staff']);

        #Reader
        // Create permission for 'see borrow history'
        Permission::create(['name' => 'see borrow history', 'guard_name' => 'reader']);

    }
}
