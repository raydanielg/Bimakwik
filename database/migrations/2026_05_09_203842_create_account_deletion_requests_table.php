<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountDeletionRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_deletion_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->timestamp('request_date')->useCurrent();
            $table->text('reason')->nullable();
            $table->string('status', 50)->default('pending');
            $table->timestamp('grace_period_end')->nullable();
            $table->timestamp('deletion_date')->nullable();
            $table->timestamp('cancelled_at')->nullable();
            $table->boolean('data_export_provided')->default(false);
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('account_deletion_requests');
    }
}
