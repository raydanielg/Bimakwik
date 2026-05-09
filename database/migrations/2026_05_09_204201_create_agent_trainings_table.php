<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentTrainingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agent_trainings', function (Blueprint $table) {
            $table->id();
            $table->string('training_title');
            $table->text('training_description')->nullable();
            $table->string('training_material_url', 500)->nullable();
            $table->integer('duration_hours')->nullable();
            $table->boolean('is_mandatory')->default(false);
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
        Schema::dropIfExists('agent_trainings');
    }
}
