<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
    
        // Create permissions
        $permissions = [
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
            // Tenant Admin (special)
            'manage tenant users',
        ];
    
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    
        // Create roles and assign permissions
        $tenantAdmin = Role::create(['name' => 'Tenant Admin'])
            ->givePermissionTo(Permission::all());
    
        $inventoryManager = Role::create(['name' => 'Inventory Manager'])
            ->givePermissionTo([
                'view products', 'create products', 'edit products',
                'adjust stock', 'view stock history', 'manage warehouses',
                'view purchases', 'create purchases', 'receive purchases',
            ]);
    
        $salesManager = Role::create(['name' => 'Sales Manager'])
            ->givePermissionTo([
                'view products', 'view sales', 'create sales', 'cancel sales',
                'process refunds', 'manage customers', 'view reports',
            ]);
    
        $cashier = Role::create(['name' => 'Cashier'])
            ->givePermissionTo([
                'view products', 'view sales', 'create sales',
            ]);
    
        $viewer = Role::create(['name' => 'Viewer'])
            ->givePermissionTo([
                'view products', 'view sales', 'view reports',
            ]);
    }
}
