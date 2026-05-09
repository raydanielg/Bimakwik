<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAggregatorProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aggregator_profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('aggregator_id')->unique();
            $table->integer('monthly_visitors')->nullable();
            $table->integer('social_followers')->nullable();
            $table->integer('whatsapp_members')->nullable();
            $table->json('niches')->nullable();
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
        Schema::dropIfExists('aggregator_profiles');
    }
}
