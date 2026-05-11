<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceProviderPerformanceMetricsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_provider_performance_metrics', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('service_provider_id');
            $table->date('metric_date');
            $table->integer('claims_processed')->default(0);
            $table->decimal('avg_processing_time_hours', 10, 2)->nullable();
            $table->decimal('approval_rate', 5, 2)->nullable();
            $table->decimal('customer_rating', 3, 2)->nullable();
            $table->decimal('total_paid_amount', 15, 2)->nullable();
            $table->timestamps();

            $table->foreign('service_provider_id', 'metrics_sp_fk')->references('id')->on('service_providers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_provider_performance_metrics');
    }
}
