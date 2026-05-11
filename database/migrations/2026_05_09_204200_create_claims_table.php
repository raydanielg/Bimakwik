<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClaimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('claims', function (Blueprint $table) {
            $table->id();
            $table->string('claim_number')->unique();
            $table->unsignedBigInteger('customer_policy_id');
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('service_provider_id')->nullable();
            $table->string('claim_type');
            $table->date('accident_date')->nullable();
            $table->timestamp('notification_date')->useCurrent();
            $table->text('description')->nullable();
            $table->decimal('claimed_amount', 15, 2);
            $table->decimal('approved_amount', 15, 2)->nullable();
            $table->string('status', 50)->default('submitted');
            $table->unsignedBigInteger('claim_adjuster_id')->nullable();
            $table->decimal('fraud_score', 5, 2)->nullable();
            $table->boolean('fraud_alert')->default(false);
            $table->timestamp('settled_at')->nullable();
            $table->text('rejection_reason')->nullable();
            $table->timestamps();

            $table->foreign('customer_policy_id')->references('id')->on('customer_policies')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('service_provider_id')->references('id')->on('service_providers')->onDelete('set null');
            $table->foreign('claim_adjuster_id')->references('id')->on('claim_adjusters')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('claims');
    }
}
