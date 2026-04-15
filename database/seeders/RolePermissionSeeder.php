<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'Create Employee','View Employee','Update Employee','Delete Employee','ShowSideBar Employee',
            'Create Attendance','View Attendance','ShowSideBar Attendance',
            'Create OfficialLetters','View OfficialLetters','Update OfficialLetters','Delete OfficialLetters','ShowSideBar OfficialLetters',
            'Create Announcement','View Announcement','Update Announcement','Delete Announcement','ShowSideBar Announcement',
            'Create Notice','View Notice','Update Notice','Delete Notice','ShowSideBar Notice',
            'Create LeaveApplication','View LeaveApplication','Update LeaveApplication','Delete LeaveApplication','ShowSideBar LeaveApplication',
            'Create Shift','View Shift','Update Shift','Delete Shift','ShowSideBar Shift',
            'Create Department','View Department','Update Department','Delete Department','ShowSideBar Department',
            'Create Designation','View Designation','Update Designation','Delete Designation','ShowSideBar Designation',
            'Create LeaveType','View LeaveType','Update LeaveType','Delete LeaveType','ShowSideBar LeaveType',
            'Create Holiday','View Holiday','Update Holiday','Delete Holiday','ShowSideBar Holiday',
            'Create DocumentTemplate','View DocumentTemplate','Update DocumentTemplate','Delete DocumentTemplate','ShowSideBar DocumentTemplate',
            'Create User','View User','Update User','ShowSideBar User',
            'Create Role','View Role','Update Role','Delete Role','ShowSideBar Role',
            'Create Permission','View Permission','Update Permission','Delete Permission','ShowSideBar Permission',
            'Create Branch','View Branch','Update Branch','Delete Branch','ShowSideBar Branch',
            'ShowSideBar AdditionalSetup','ShowSideBar CompanySetup','ShowSideBar Maintenance',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'admin']);
        }

        $roles = [
            'Admin' => ['Create Employee', 'View Employee', 'Update Employee', 'Delete Employee'],
            'Manager' => ['Create Employee', 'View Employee', 'Update Employee', 'Delete Employee'],
            'User' => ['Create Employee']
        ];

        foreach ($roles as $roleName => $rolePermissions) {
            $role = Role::firstOrCreate(['name' => $roleName, 'guard_name' => 'admin']);
            $role->syncPermissions($rolePermissions);
        }
    }
}
