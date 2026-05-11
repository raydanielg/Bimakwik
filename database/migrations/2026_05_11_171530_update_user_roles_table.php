<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUserRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_roles', function (Blueprint $table) {
            if (!Schema::hasColumn('user_roles', 'user_id')) {
                $table->foreignId('user_id')->after('id')->constrained('users')->cascadeOnDelete();
            }

            if (!Schema::hasColumn('user_roles', 'role_id')) {
                $table->foreignId('role_id')->after('user_id')->constrained('roles')->cascadeOnDelete();
            }

            if (!Schema::hasColumn('user_roles', 'entity_type')) {
                $table->string('entity_type', 50)->nullable()->after('role_id');
            }

            if (!Schema::hasColumn('user_roles', 'entity_id')) {
                $table->unsignedBigInteger('entity_id')->nullable()->after('entity_type');
            }

            if (!Schema::hasColumn('user_roles', 'assigned_by')) {
                $table->foreignId('assigned_by')->nullable()->after('entity_id')->constrained('users')->nullOnDelete();
            }

            if (!Schema::hasColumn('user_roles', 'assigned_at')) {
                $table->timestamp('assigned_at')->nullable()->after('assigned_by');
            }

            if (!Schema::hasColumn('user_roles', 'expires_at')) {
                $table->timestamp('expires_at')->nullable()->after('assigned_at');
            }

            if (!Schema::hasColumn('user_roles', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('expires_at');
            }
        });

        Schema::table('user_roles', function (Blueprint $table) {
            $table->unique(['user_id', 'role_id', 'entity_type', 'entity_id'], 'user_roles_user_role_entity_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_roles', function (Blueprint $table) {
            $table->dropUnique('user_roles_user_role_entity_unique');

            if (Schema::hasColumn('user_roles', 'assigned_by')) {
                $table->dropForeign(['assigned_by']);
            }
            if (Schema::hasColumn('user_roles', 'role_id')) {
                $table->dropForeign(['role_id']);
            }
            if (Schema::hasColumn('user_roles', 'user_id')) {
                $table->dropForeign(['user_id']);
            }

            foreach (['user_id', 'role_id', 'entity_type', 'entity_id', 'assigned_by', 'assigned_at', 'expires_at', 'is_active'] as $col) {
                if (Schema::hasColumn('user_roles', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }
}
