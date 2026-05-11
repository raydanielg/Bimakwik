<?php

namespace Database\Seeders;

use App\Models\Module;
use App\Models\Permission;
use App\Models\Role;
use App\Models\RolePermission;
use Illuminate\Database\Seeder;

class AccessControlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modules = [
            ['module_code' => 'dashboard', 'module_name' => 'Dashboard', 'display_order' => 1],
            ['module_code' => 'user_management', 'module_name' => 'User Management', 'display_order' => 2],
            ['module_code' => 'role_management', 'module_name' => 'Role Management', 'display_order' => 3],
            ['module_code' => 'customer_management', 'module_name' => 'Customer Management', 'display_order' => 4],
            ['module_code' => 'broker_management', 'module_name' => 'Broker Management', 'display_order' => 5],
            ['module_code' => 'aggregator_management', 'module_name' => 'Aggregator Management', 'display_order' => 6],
            ['module_code' => 'agent_management', 'module_name' => 'Agent Management', 'display_order' => 7],
            ['module_code' => 'sfe_management', 'module_name' => 'SFE Management', 'display_order' => 8],
            ['module_code' => 'bancassurance_management', 'module_name' => 'Bancassurance Management', 'display_order' => 9],
            ['module_code' => 'insurer_management', 'module_name' => 'Insurer Management', 'display_order' => 10],
            ['module_code' => 'service_provider_management', 'module_name' => 'Service Provider Management', 'display_order' => 11],
            ['module_code' => 'regulator_management', 'module_name' => 'Regulator Management', 'display_order' => 12],
            ['module_code' => 'financing_partner_management', 'module_name' => 'Financing Partner Management', 'display_order' => 13],
            ['module_code' => 'developer_management', 'module_name' => 'Developer Management', 'display_order' => 14],
            ['module_code' => 'product_management', 'module_name' => 'Product Management', 'display_order' => 15],
            ['module_code' => 'policy_management', 'module_name' => 'Policy Management', 'display_order' => 16],
            ['module_code' => 'claims_management', 'module_name' => 'Claims Management', 'display_order' => 17],
            ['module_code' => 'wallet_management', 'module_name' => 'Wallet & Payment Management', 'display_order' => 18],
            ['module_code' => 'commission_management', 'module_name' => 'Commission Management', 'display_order' => 19],
            ['module_code' => 'reporting', 'module_name' => 'Reporting & Analytics', 'display_order' => 20],
            ['module_code' => 'system_config', 'module_name' => 'System Configuration', 'display_order' => 21],
            ['module_code' => 'support', 'module_name' => 'Support & FAQ', 'display_order' => 22],
            ['module_code' => 'api_management', 'module_name' => 'API Management', 'display_order' => 23],
            ['module_code' => 'communication', 'module_name' => 'Communication', 'display_order' => 24],
            ['module_code' => 'workflow', 'module_name' => 'Workflow Automation', 'display_order' => 25],
            ['module_code' => 'audit', 'module_name' => 'Audit & Logs', 'display_order' => 26],
        ];

        foreach ($modules as $m) {
            Module::updateOrCreate(
                ['module_code' => $m['module_code']],
                [
                    'module_name' => $m['module_name'],
                    'display_order' => $m['display_order'],
                    'is_active' => true,
                ]
            );
        }

        $actions = ['view', 'create', 'edit', 'delete', 'approve'];

        $allModules = Module::query()->get();
        foreach ($allModules as $module) {
            foreach ($actions as $action) {
                $slug = $module->module_code . '.' . $action;

                Permission::updateOrCreate(
                    ['slug' => $slug],
                    [
                        'name' => strtoupper($action) . ' ' . $module->module_name,
                        'module_id' => $module->id,
                        'permission_code' => $action,
                        'permission_name' => ucfirst($action),
                        'permission_type' => 'action',
                    ]
                );
            }
        }

        $adminRole = Role::where('name', 'admin')->first();
        if ($adminRole) {
            foreach (Permission::query()->where('permission_code', 'view')->get() as $perm) {
                RolePermission::updateOrCreate(
                    ['role_id' => $adminRole->id, 'permission_id' => $perm->id],
                    ['is_allowed' => true]
                );
            }
        }
    }
}
