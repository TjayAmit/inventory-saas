<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Clear cached permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Define ALL permissions (will be created for both guards)
        $allPermissions = [
            // Products
            'view products', 'create products', 'edit products', 'delete products',
            // Inventory
            'adjust stock', 'view stock history', 'manage warehouses',
            // Sales
            'view sales', 'create sales', 'cancel sales', 'process refunds',
            // Customers
            'manage customers',
            // Purchases
            'view purchases', 'create purchases', 'receive purchases',
            // Reports
            'view reports',
            // Users
            'view users', 'create users', 'edit users', 'delete users',
            // Roles
            'view roles', 'create roles', 'edit roles', 'delete roles',
            // Permissions
            'view permissions', 'create permissions', 'edit permissions', 'delete permissions',
            // System
            'manage tenant users',
        ];

        // Create permissions for both guards
        foreach ($allPermissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'admin']);
        }

        // ==================== ADMIN GUARD ROLES ====================
        
        // Super Admin - gets ALL admin permissions
        $superAdminRole = Role::firstOrCreate([
            'name' => 'Super Admin',
            'guard_name' => 'admin'
        ]);
        $superAdminRole->syncPermissions(Permission::where('guard_name', 'admin')->get());

        // ==================== WEB GUARD ROLES ====================
        
        // Tenant Admin - gets most permissions except sensitive system ones
        $tenantAdminRole = Role::firstOrCreate([
            'name' => 'Tenant Admin',
            'guard_name' => 'web'
        ]);
        $tenantAdminRole->syncPermissions(
            Permission::where('guard_name', 'web')
                ->whereNotIn('name', [
                    'create roles', 'edit roles', 'delete roles',
                    'create permissions', 'edit permissions', 'delete permissions',
                    'manage tenant users'
                ])
                ->get()
        );

        // Inventory Manager
        $inventoryManager = Role::firstOrCreate([
            'name' => 'Inventory Manager', 
            'guard_name' => 'web'
        ]);
        $inventoryManager->syncPermissions(
            Permission::where('guard_name', 'web')
                ->whereIn('name', [
                    'view products', 'create products', 'edit products',
                    'adjust stock', 'view stock history', 'manage warehouses',
                    'view purchases', 'create purchases', 'receive purchases',
                ])
                ->get()
        );

        // Sales Manager
        $salesManager = Role::firstOrCreate([
            'name' => 'Sales Manager',
            'guard_name' => 'web'
        ]);
        $salesManager->syncPermissions(
            Permission::where('guard_name', 'web')
                ->whereIn('name', [
                    'view products', 'view sales', 'create sales', 'cancel sales',
                    'process refunds', 'manage customers', 'view reports',
                ])
                ->get()
        );

        // Cashier
        $cashier = Role::firstOrCreate([
            'name' => 'Cashier',
            'guard_name' => 'web'
        ]);
        $cashier->syncPermissions(
            Permission::where('guard_name', 'web')
                ->whereIn('name', [
                    'view products', 'view sales', 'create sales',
                ])
                ->get()
        );

        // Viewer (Read-only)
        $viewer = Role::firstOrCreate([
            'name' => 'Viewer',
            'guard_name' => 'web'
        ]);
        $viewer->syncPermissions(
            Permission::where('guard_name', 'web')
                ->whereIn('name', [
                    'view products', 'view sales', 'view reports',
                ])
                ->get()
        );
    }
}