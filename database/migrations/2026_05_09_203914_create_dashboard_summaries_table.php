<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDashboardSummariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dashboard_summaries', function (Blueprint $table) {
            $table->unsignedBigInteger('customer_id')->primary();
            $table->integer('total_active_policies')->default(0);
            $table->integer('total_policies_ever')->default(0);
            $table->decimal('total_premiums_paid', 15, 2)->default(0.00);
            $table->integer('total_claims_submitted')->default(0);
            $table->decimal('total_claims_paid', 15, 2)->default(0.00);
            $table->decimal('total_claims_pending', 15, 2)->default(0.00);
            $table->date('next_renewal_date')->nullable();
            $table->decimal('next_renewal_amount', 15, 2)->nullable();
            $table->decimal('total_coverage_amount', 15, 2)->default(0.00);
            $table->boolean('has_incomplete_kyc')->default(false);
            $table->boolean('has_expiring_policies')->default(false);
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
        Schema::dropIfExists('dashboard_summaries');
    }
}
