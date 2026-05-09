<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agent_profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('agent_id')->unique();
            $table->integer('years_experience')->nullable();
            $table->json('certifications')->nullable();
            $table->decimal('sales_target_year', 15, 2)->nullable();
            $table->decimal('sales_achieved_year', 15, 2)->nullable();
            $table->timestamps();

            $table->foreign('agent_id')->references('id')->on('agents')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agent_profiles');
    }
}
