<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentGenerationQueuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_generation_queues', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_policy_id');
            $table->string('document_type', 50);
            $table->string('trigger_event', 50);
            $table->unsignedBigInteger('trigger_id')->nullable();
            $table->string('status', 50)->default('pending');
            $table->integer('retry_count')->default(0);
            $table->text('error_message')->nullable();
            $table->timestamp('processed_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();

            $table->foreign('customer_policy_id', 'dg_queue_policy_fk')->references('id')->on('customer_policies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('document_generation_queues');
    }
}
