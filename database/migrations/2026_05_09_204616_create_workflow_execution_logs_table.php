<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkflowExecutionLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workflow_execution_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('workflow_execution_id');
            $table->unsignedBigInteger('workflow_step_id')->nullable();
            $table->string('action', 100)->nullable();
            $table->text('log_message')->nullable();
            $table->json('log_data')->nullable();
            $table->timestamps();

            $table->foreign('workflow_execution_id', 'we_log_exec_fk')->references('id')->on('workflow_executions')->onDelete('cascade');
            $table->foreign('workflow_step_id', 'we_log_step_fk')->references('id')->on('workflow_steps')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('workflow_execution_logs');
    }
}
