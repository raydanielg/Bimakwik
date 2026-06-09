<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('market_analytics', function (Blueprint $table) {
            $table->id();
            $table->string('metric_name'); // e.g., 'premium_volume', 'claims_ratio', 'market_growth'
            $table->decimal('metric_value', 15, 2)->nullable();
            $table->string('category')->nullable(); // e.g., 'insurer', 'product', 'region'
            $table->string('period')->nullable(); // e.g., 'monthly', 'quarterly', 'yearly'
            $table->json('data')->nullable(); // additional detailed data
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('market_analytics');
    }
};
