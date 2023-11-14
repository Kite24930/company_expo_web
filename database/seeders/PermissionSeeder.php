<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Permission Create
        $accessToStudent = Permission::create(['name' => 'access to student']);
        $accessToCompany = Permission::create(['name' => 'access to company']);
        $accessToAdmin = Permission::create(['name' => 'access to admin']);

        // Role Create
        $student = Role::create(['name' => 'student']);
        $company = Role::create(['name' => 'company']);
        $admin = Role::create(['name' => 'admin']);

        // Link Permissions and Roles
        $student->givePermissionTo($accessToStudent);
        $company->givePermissionTo($accessToCompany);
        $admin->givePermissionTo($accessToAdmin);

        // Admin User Add
        $adminUser = new User();
        $adminUser->name = 'Project M, Inc.';
        $adminUser->email = 'main@mie-projectm.com';
        $adminUser->password = bcrypt('projectm0701');
        $adminUser->save();

        // Link User and Role
        $adminUser->assignRole($admin);
    }
}
