<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAggregatorPenaltiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aggregator_penalties', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('aggregator_id');
            $table->string('penalty_type', 50);
            $table->text('violation_description')->nullable();
            $table->decimal('amount', 15, 2)->nullable();
            $table->integer('suspension_days')->nullable();
            $table->string('status', 50)->default('active');
            $table->unsignedBigInteger('issued_by')->nullable();
            $table->timestamp('issued_at')->useCurrent();
            $table->timestamps();

            $table->foreign('aggregator_id')->references('id')->on('aggregators')->onDelete('cascade');
            $table->foreign('issued_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aggregator_penalties');
    }
}
