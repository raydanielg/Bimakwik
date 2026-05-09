<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAggregatorAgreementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aggregator_agreements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('aggregator_id');
            $table->string('agreement_number')->unique();
            $table->date('start_date');
            $table->date('end_date');
            $table->string('document_url', 500)->nullable();
            $table->json('terms')->nullable();
            $table->timestamp('signed_at')->nullable();
            $table->timestamps();

            $table->foreign('aggregator_id')->references('id')->on('aggregators')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aggregator_agreements');
    }
}
