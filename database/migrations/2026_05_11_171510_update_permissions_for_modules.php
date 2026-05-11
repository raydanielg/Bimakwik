<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePermissionsForModules extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('permissions', function (Blueprint $table) {
            if (!Schema::hasColumn('permissions', 'module_id')) {
                $table->foreignId('module_id')->nullable()->after('id')->constrained('modules')->nullOnDelete();
            }

            if (!Schema::hasColumn('permissions', 'permission_code')) {
                $table->string('permission_code', 100)->nullable()->after('module_id');
            }

            if (!Schema::hasColumn('permissions', 'permission_name')) {
                $table->string('permission_name')->nullable()->after('permission_code');
            }

            if (!Schema::hasColumn('permissions', 'permission_type')) {
                $table->string('permission_type', 50)->default('action')->after('permission_name');
            }
        });

        Schema::table('permissions', function (Blueprint $table) {
            $table->unique(['module_id', 'permission_code'], 'permissions_module_code_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('permissions', function (Blueprint $table) {
            if (Schema::hasColumn('permissions', 'module_id')) {
                $table->dropForeign(['module_id']);
            }

            if (Schema::hasColumn('permissions', 'module_id')) {
                $table->dropColumn('module_id');
            }

            if (Schema::hasColumn('permissions', 'permission_code')) {
                $table->dropColumn('permission_code');
            }

            if (Schema::hasColumn('permissions', 'permission_name')) {
                $table->dropColumn('permission_name');
            }

            if (Schema::hasColumn('permissions', 'permission_type')) {
                $table->dropColumn('permission_type');
            }

            $table->dropUnique('permissions_module_code_unique');
        });
    }
}
