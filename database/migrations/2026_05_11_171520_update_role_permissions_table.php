<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateRolePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('role_permissions', function (Blueprint $table) {
            if (!Schema::hasColumn('role_permissions', 'role_id')) {
                $table->foreignId('role_id')->after('id')->constrained('roles')->cascadeOnDelete();
            }

            if (!Schema::hasColumn('role_permissions', 'permission_id')) {
                $table->foreignId('permission_id')->after('role_id')->constrained('permissions')->cascadeOnDelete();
            }

            if (!Schema::hasColumn('role_permissions', 'is_allowed')) {
                $table->boolean('is_allowed')->default(true)->after('permission_id');
            }

            if (!Schema::hasColumn('role_permissions', 'constraints')) {
                $table->json('constraints')->nullable()->after('is_allowed');
            }

            if (!Schema::hasColumn('role_permissions', 'granted_by')) {
                $table->foreignId('granted_by')->nullable()->after('constraints')->constrained('users')->nullOnDelete();
            }

            if (!Schema::hasColumn('role_permissions', 'granted_at')) {
                $table->timestamp('granted_at')->nullable()->after('granted_by');
            }

            if (!Schema::hasColumn('role_permissions', 'expires_at')) {
                $table->timestamp('expires_at')->nullable()->after('granted_at');
            }
        });

        Schema::table('role_permissions', function (Blueprint $table) {
            $table->unique(['role_id', 'permission_id'], 'role_permissions_role_permission_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('role_permissions', function (Blueprint $table) {
            $table->dropUnique('role_permissions_role_permission_unique');

            if (Schema::hasColumn('role_permissions', 'granted_by')) {
                $table->dropForeign(['granted_by']);
            }
            if (Schema::hasColumn('role_permissions', 'permission_id')) {
                $table->dropForeign(['permission_id']);
            }
            if (Schema::hasColumn('role_permissions', 'role_id')) {
                $table->dropForeign(['role_id']);
            }

            foreach (['role_id', 'permission_id', 'is_allowed', 'constraints', 'granted_by', 'granted_at', 'expires_at'] as $col) {
                if (Schema::hasColumn('role_permissions', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }
}
