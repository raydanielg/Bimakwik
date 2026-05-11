<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccessRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('access_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('requester_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('requested_role_id')->nullable()->constrained('roles')->nullOnDelete();
            $table->foreignId('requested_permission_id')->nullable()->constrained('permissions')->nullOnDelete();
            $table->string('request_type', 50);
            $table->text('reason')->nullable();
            $table->string('status', 50)->default('pending');
            $table->foreignId('reviewed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('reviewed_at')->nullable();
            $table->text('approval_notes')->nullable();
            $table->timestamps();

            $table->index(['requester_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('access_requests');
    }
}
