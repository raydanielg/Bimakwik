<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentTrainingCompletionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agent_training_completions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('agent_id');
            $table->unsignedBigInteger('agent_training_id');
            $table->timestamp('completed_at')->useCurrent();
            $table->string('certificate_url', 500)->nullable();
            $table->decimal('score', 5, 2)->nullable();
            $table->timestamps();

            $table->foreign('agent_id')->references('id')->on('agents')->onDelete('cascade');
            $table->foreign('agent_training_id', 'atc_training_fk')->references('id')->on('agent_trainings')->onDelete('cascade');
            $table->unique(['agent_id', 'agent_training_id'], 'atc_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agent_training_completions');
    }
}
